<?php
$file = $_FILES['file']['tmp_name'];
$handle = fopen($file, "r");
$c = 0;

while(($filesop = fgetcsv($handle, 1000, ",")) !== false)
{
  if ($_POST['status'] == 'penjualan') 
  {
    $nota = $filesop[1];
    $tanggal = $filesop[2];
    $id_toko = $filesop[3];
    $diskon = $filesop[4];
    $pajak = $filesop[5];
    $bayar = $filesop[7];
    $created_by = $filesop[17];
    $post_time = $filesop[18];

    $i = mysqli_query($link,"INSERT INTO penjualan (
                                          nota,
                                          tanggal,
                                          id_toko,
                                          diskon,
                                          pajak,
                                          bayar,
                                          created_by,
                                          post_time
                                          )
                                  VALUES (
                                          '$nota',
                                          '$tanggal',
                                          '$id_toko',
                                          '$diskon',
                                          '$pajak',
                                          '$bayar',
                                          '$created_by',
                                          '$post_time'
                                          )
                    ") or die (mysqli_error());
  }
  else if ($_POST['status'] == 'detail_penjualan') 
  {
    $nota = $filesop[1];
    $kd_produk_size = $filesop[2];
    $jumlah = $filesop[3];
    $harga_jual = $filesop[4];

    $rB = mysqli_fetch_array(mysqli_query($link,"SELECT 
          id_toko 
          FROM 
          penjualan 
          WHERE 
          nota = '$nota'
          "));

    $i = mysqli_query($link,"INSERT INTO penjualan_detail (
                                          nota,
                                          kd_produk_size,
                                          jumlah,
                                          harga_jual
                                          )
                                  VALUES (
                                          '$nota',
                                          '$kd_produk_size',
                                          '$jumlah',
                                          '$harga_jual'
                                          )
                    ") or die (mysqli_error());

    $Ustock = mysqli_query($link,"UPDATE stok SET
              jumlah = jumlah-'$jumlah'
              WHERE
              id_toko = '$rB[id_toko]'
              AND kd_produk_size = '$kd_produk_size'
              ") or die (mysqli_error());  
  }

  $c = $c + 1;

}

if ($i)
{
  echo "<script>alert('Berhasil Mengimport Data');
        window.location.href='home.php?act=".md5('import')."';</script>";
}
else
{
  echo "Sorry! There is some problem.";
}

?>