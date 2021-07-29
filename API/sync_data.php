<?php
include "../lib/koneksi.php";
$_POST = json_decode(file_get_contents('php://input'),true); 

$id_user = $_POST['id_user'];
//$id_user = 9;

$stoks = mysqli_query($link,"SELECT 
    stok.kd_produk_size,
    stok.jumlah,
    stok.id_toko,
    produk.id_produk,
    produk.kd_produk,
    produk_size.harga_jual,
    produk.nm_produk,
    produk.file
    FROM
    stok
    INNER JOIN user ON user.id_toko = stok.id_toko
    INNER JOIN produk_size ON produk_size.kd_produk_size = stok.kd_produk_size
    INNER JOIN produk ON produk.kd_produk = produk_size.kd_produk
    WHERE 
    stok.jumlah > 0
    AND user.id_user = '$id_user'
    ORDER BY produk.kd_produk ASC
    ") or die (mysqli_error());

if (mysqli_num_rows($stoks) > 0) {

    $response["produk"] = array(); 
    while ($stok = mysqli_fetch_array($stoks)) {
        $taskProduk = array();
        $taskProduk["id_seri"] = $stok["id_produk"];
        $taskProduk["kode_seri"] = $stok["kd_produk_size"];
        $taskProduk["nama_seri"] = $stok["nm_produk"];
        $taskProduk["harga"] = $stok["harga_jual"];
        $taskProduk["stock"] = $stok["jumlah"];
        $taskProduk["gambar"] = "http://retailsistem.com/denndev/upload/".$stok['file'];
        array_push($response["produk"], $taskProduk);
    }

    $customers = mysqli_query($link,"SELECT * FROM customer ORDER BY nm_customer ASC") or die (mysqli_error());
    $response["customer"] = array(); 
    while ($customer = mysqli_fetch_array($customers)) {
        $taskCustomer = array();
        $taskCustomer["id"] = $customer["id_customer"];
        $taskCustomer["nama"] = $customer["nm_customer"];
        array_push($response["customer"], $taskCustomer);
    }

    $response["isSuccess"] = 1; 
    echo json_encode($response);

} else {

    $response["isSuccess"] = 0;
    $response["message"] = "Not  found";
    echo json_encode($response);

}
?>