<?php
include "../lib/koneksi.php";
date_default_timezone_set("Asia/jakarta");
$_POST = json_decode(file_get_contents('php://input'),true); 

$id_user = $_POST['id_user'];
//$id_user = 9;
$nm_customer = $_POST['nama_customer'];
$id_customer = $_POST['id_customer'];
$pajak = $_POST['pajak'];
$diskon = $_POST['discount'];
$keterangan = $_POST['keterangan'];
$id_metode = 1;
$tanggal = date("Y-m-d");
$created_by = $id_user;
$post_time = date("Y-m-d H:i:s");

$user = mysqli_fetch_array(mysqli_query($link,"SELECT id_toko FROM user WHERE id_user = '$id_user'"));

if ($id_customer == "-") {

    $customerInsert = mysqli_query($link,"INSERT INTO customer(nm_customer) VALUES ('$nm_customer')") or die(mysqli_error());
    $customer = mysqli_fetch_array(mysqli_query($link,"SELECT id_customer FROM customer WHERE nm_customer = '$nm_customer' ORDER BY id_customer DESC limit 1"));
    $id_customer = $customer['id_customer'];

}

$penjualanInsert = mysqli_query($link,"INSERT INTO penjualan (
    tanggal,
    id_metode,
    id_toko,
    id_customer,
    pajak,
    diskon,
    keterangan,
    created_by,
    post_time
    )
    VALUES (
    '$tanggal',
    '$id_metode',
    '$user[id_toko]',
    '$id_customer',
    '$pajak',
    '$diskon',
    '$keterangan',
    '$created_by',
    '$post_time'
    )
    ") or die (mysqli_error());

$penjualan = mysqli_fetch_array(mysqli_query($link,"SELECT 
            id_penjualan 
            FROM 
            penjualan 
            WHERE 
            id_toko = '$user[id_toko]' 
            AND id_customer = '$id_customer' 
            AND tanggal = '$tanggal' 
            AND created_by = '$created_by' 
            AND post_time = '$post_time' 
            Order By id_penjualan DESC"));

$pecah = explode("-", $tanggal);
$tahun = $pecah[0];
$bulan = $pecah[1];
$hari = $pecah[2];
$tahun = substr($tahun, -2);
$nota = "SO".$hari.$bulan.$tahun.$penjualan['id_penjualan'];
$Unota = mysqli_query($link,"UPDATE penjualan SET
                    nota = '$nota'
                    WHERE
                    id_penjualan = '$penjualan[id_penjualan]'
                    ") or die (mysqli_error()); 

foreach ($_POST['order'] as $k) {

    $stoks = mysqli_query($link,"SELECT
        produk_size.harga_jual,
        stok.jumlah
        FROM
        stok
        INNER JOIN produk_size ON produk_size.kd_produk_size = stok.kd_produk_size
        INNER JOIN produk ON produk.kd_produk = produk_size.kd_produk
        WHERE
        stok.kd_produk_size = '$k[kode_seri]'
        AND stok.id_toko = '$user[id_toko]'
        ") or die (mysqli_error()); 
    $stok = mysqli_fetch_array($stoks); 


    $iD = mysqli_query($link,"INSERT INTO penjualan_detail (
        nota,
        kd_produk_size,
        jumlah,
        harga_jual
        )
        VALUES (
        '$nota',
        '$k[kode_seri]',
        '$k[quantity]',
        '$stok[harga_jual]'
        )
        ") or die (mysqlierror());

    $Ustock = mysqli_query($link,"UPDATE stok SET
                        jumlah = jumlah-'$k[quantity]'
                        WHERE
                        id_toko = '$user[id_toko]'
                        AND kd_produk_size = '$k[kode_seri]'
                        ") or die (mysqli_error());   


}

if ($Ustock) {

    $response["isSuccess"] = 1;
    $response["message"] = "Berhasil.";
    echo json_encode($response);

} else {

    $response["isSuccess"] = 0;
    $response["message"] = "Oops! An error occurred.";
    echo json_encode($response);

}

?>