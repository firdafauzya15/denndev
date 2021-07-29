<?php
include"../../lib/koneksi.php";
$id_produk = base64_decode($_GET['p']);
$q = mysqli_query($link,"SELECT * FROM produk
      Inner Join kategori On kategori.id_kategori = produk.id_kategori 
      Inner Join brand On brand.id_brand = produk.id_brand
      WHERE 
      id_produk = '$id_produk'
      ") or die (mysqli_error());
$r = mysqli_fetch_array($q);

$tipe = "Barang Produksi";
if ( $r['id_tipe_produk'] == '2' ) {
  $tipe = "Barang Jadi";
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= $r['kd_produk'];?> - <?= $r['nm_produk'];?></title>
  <link rel="stylesheet" href="">
	<style>
		body {
			font-family: Calibri, Candara, Segoe, "Segoe UI", Optima, Arial, sans-serif;
		}
    table td, table th, h3 {
    	font-size: 24px;
      padding: 5px;
    }
  </style>
</head>
<body onload="window.print()">
  <center>
	<h3><u>Daftar Produk</u></h3>
  <table>
    <tr>
      <td colspan="3" align="center"><img src="../../upload/<?= $r['file'];?>" height="400" width="400"></td>
    </tr>
    <tr>
      <td valign="top">Tipe</td>
      <td valign="top">:</td>
      <td><?= $tipe;?></td>
    </tr>
    <tr>
      <td valign="top">Brand</td>
      <td valign="top">:</td>
      <td><?= $r['nm_brand'];?></td>
    </tr>
    <tr>
      <td valign="top">Kategori</td>
      <td valign="top">:</td>
      <td><?= $r['nm_kategori'];?></td>
    </tr>
    <tr>
      <td valign="top">Kode Produk</td>
      <td valign="top">:</td>
      <td><?= $r['kd_produk'];?></td>
    </tr>
    <tr>
      <td valign="top">Nama Produk</td>
      <td valign="top">:</td>
      <td><?= $r['nm_produk'];?></td>
    </tr>
  </table>
  </center>
</body>
</html>