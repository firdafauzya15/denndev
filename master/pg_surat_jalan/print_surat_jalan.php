<?php
session_start();
date_default_timezone_set("Asia/Jakarta");
include "../function/nota.php";
include"../../lib/koneksi.php";
include"../function/convert_number.php";
$id_surat_jalan = base64_decode($_GET['id']);
$result = mysqli_query($link,"SELECT 
      user.username, 
	    surat_jalan.id_surat_jalan, 
      surat_jalan.tanggal, 
	    surat_jalan.keterangan, 
	    toko.nm_toko
	    FROM 
	    surat_jalan 
      Inner Join toko ON toko.id_toko = surat_jalan.id_toko 
	    Inner Join user ON user.id_user = surat_jalan.created_by 
	    WHERE surat_jalan.id_surat_jalan = '$id_surat_jalan'") or die (mysqli_error());
$row = mysqli_fetch_array($result);
$username = $row['username'];
$nota = notaSuratJalan($row['id_surat_jalan']);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title></title>
  <link rel="stylesheet" href="">
  <style>
    body {
      font-size: 11px;
      font-family: Arial, Helvetica, sans-serif; 
    }

    h6 {
      font-size: 12px;
      margin: 0;
      padding: 0;
    }

    table.content {
      width: 100%;
      font-size: 12px;
      border-top: 1px solid #000;
      border-bottom: 1px solid #000;
      border-collapse: collapse;
    }

    table tr.border-bottom th {
      border-bottom: 1px solid #000;
    }

    table tr.no-border td { 
      border: none;
    }

    table.content th, table.content td {
      padding: 2px;
    }
  </style>
</head>
<body onload="window.print()">
<!-- <body onload="window.print()"> -->
  <table>
    <tr>
      <td width="86"><img src="../../dist/img/logo-denndev.jpg" width="86" height="86"></td>
      <td width="300">
        <h6>SURAT JALAN <br> DEN N DEV CLOTING <br> COMPANY</h6>
        JL.UTAMA SAKTI 2 NO 42 H I <br>
        02129541614 <br>
        021295541614
      </td>
      <td width="300" valign="top">
        <table class="header">
          <tr>
            <td width="50">Nota</td>
            <td>: <?= $nota;?></td>
          </tr>
          <tr>
            <td>Tanggal</td>
            <td>: <?= $row['tanggal'];?></td>
          </tr>
          <tr>
            <td>Toko</td>
            <td>: <?= $row['nm_toko'];?></td>
          </tr>
        </table>
      </td>
      <td width="300" valign="top">
        <table class="header">
          <tr>
            <td width="50">User</td>
            <td>: <?= $_SESSION['username'];?></td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
  <table class="content">
    <tr class="border-bottom">
      <th width="30">No</th>
      <th align="left">Kode Item</th>
      <th align="left">Nama Brand</th>
      <th align="left">Nama Model</th>
      <th align="left">Nama Produk</th>
      <th align="center" width="100">Lusin</th>
      <th align="center" width="100">Pcs</th>
    </tr>
    <?php
    $i = 0;
    $q = mysqli_query($link,"SELECT 
          surat_jalan_detail.jumlah, 
          produk_size.kd_produk_size, 
          produk.nm_produk,
          brand.nm_brand,
          model.nm_model
          FROM 
          surat_jalan_detail 
          Inner Join produk_size ON produk_size.kd_produk_size = surat_jalan_detail.kd_produk_size
          Inner Join produk ON produk.kd_produk = produk_size.kd_produk
          INNER JOIN brand on brand.id_brand = produk.id_brand
          INNER JOIN model on model.id_model = produk.id_model
      		  WHERE surat_jalan_detail.id_surat_jalan = '$id_surat_jalan'
          ") or die (mysqli_error());
    while ($r = mysqli_fetch_array($q)) {
    	$i++;
    ?>
      <tr class="no-border">
        <td align="center"><?= $i;?></td>
        <td align="left"><?= $r['kd_produk_size'];?></td>
        <td align="left"><?= $r['nm_brand'];?></td>
        <td align="left"><?= $r['nm_model'];?></td>
        <td align="left"><?= $r['nm_produk'];?></td>
        <td align="center"><?= number_format(lusin($r['jumlah']));?></td>
        <td align="center"><?= number_format(pcs($r['jumlah']));?></td>
      </tr>
    <?php
    }
    ?>
    <tr>
      <td colspan="5"><br><br><br><br></td>
    </tr>
  </table>
  <table>
    <tr>
      <td width="400" valign="top">
        <table>
          <tr>
            <td width="60" valign="top">Keterangan</td>
            <td width="10" valign="top">:</td>
            <td valign="top" height="100"><?= $row['keterangan']; ?></td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
  <table width="100%">
    <tr>
      <td width="33%" align="center" valign="top">
        Hormat Kami
        <br><br><br><br>
        (....................)
      </td>
      <td width="33%"></td>
      <td width="33%" align="center" valign="top">
        Penerima
        <br><br><br><br>
        (....................)
      </td>
    </tr>
  </table>
  <table width="100%">
    <tr>
      <td width="50%" align="left"><?= date("d/m/Y H:i");?></td>
      <td width="50%" align="right"><?= $_SESSION['username'];?></td>
    </tr>
  </table>
</body>
</html>