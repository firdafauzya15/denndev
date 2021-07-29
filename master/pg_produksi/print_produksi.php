<?php
session_start();
date_default_timezone_set("Asia/Jakarta");
include"../../lib/koneksi.php";
include"../function/convert_number.php";
$nota = base64_decode($_GET['id']);
$q = mysqli_query($link,"SELECT 
    cmt.nm_cmt, 
    produksi.keterangan, 
    produksi.id_produksi, 
    produksi.tanggal, 
    produksi.jatuh_tempo,
    produksi.nota_sablon, 
    produksi.nota, 
    produksi.harga
    FROM 
    produksi 
    INNER JOIN cmt ON cmt.id_cmt = produksi.id_cmt
    WHERE produksi.nota = '$nota'
  ") or die (mysqli_error());
$r = mysqli_fetch_array($q);
$keterangan = $r['keterangan'];

$rP = mysqli_fetch_array(mysqli_query($link,"SELECT 
    SUM(sablon_pengiriman.jumlah) AS jumlah_produksi
    FROM
    sablon_pengiriman
    INNER JOIN sablon_detail ON sablon_detail.id_sablon_detail = sablon_pengiriman.id_sablon_detail
    WHERE 
    sablon_detail.nota = '$r[nota_sablon]'
  "));
$nota_sablon = $r['nota_sablon'];
$nota = $r['nota'];
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
      font-size: 14px;
      font-family: Arial, Helvetica, sans-serif; 
    }

    h6 {
      font-size: 12px;
      margin: 0;
      padding: 0;
    }

    table.content {
      width: 100%;
      font-size: 18px;
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
            <td width="80">Nota</td>
            <td>: <?= $r['nota'];?></td>
          </tr>
          <tr>
            <td>Tanggal</td>
            <td>: <?= $r['tanggal'];?></td>
          </tr>
          <tr>
            <td>Jatuh Tempo</td>
            <td>: <?= $r['jatuh_tempo'];?></td>
          </tr>
          <tr>
            <td>CMT</td>
            <td>: <?= $r['nm_cmt'];?></td>
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
      <th align="left">Brand</th>
      <th align="left">Model</th>
      <th align="left">Nama Item</th>
      <th align="center" width="80">Lusin</th>
      <th align="center" width="80">Pcs</th>
    </tr>
    <?php
    $i = 0;
    $q = mysqli_query($link,"SELECT 
        sablon_detail.id_sablon_detail,
        sablon_detail.kd_produk_size, 
        produk.file, 
        produk.kd_produk, 
        produk.nm_produk,
        model.nm_model,
        brand.nm_brand
        FROM 
        sablon_detail 
        INNER JOIN produk ON produk.kd_produk = sablon_detail.kd_produk
        INNER JOIN brand on brand.id_brand = produk.id_brand
        INNER JOIN model on model.id_model = produk.id_model
        WHERE 
        sablon_detail.nota = '$nota_sablon'
        GROUP BY sablon_detail.kd_produk
      ") or die (mysqli_error());

    while ($r = mysqli_fetch_array($q)) {
      $i++;

      // $rP = mysqli_fetch_array(mysqli_query($link,"SELECT 
      //     SUM(sablon_pengiriman.jumlah) AS jumlah_produksi
      //     FROM
      //     sablon_pengiriman
      //     INNER JOIN sablon_detail ON sablon_detail.id_sablon_detail = sablon_pengiriman.id_sablon_detail
      //     WHERE 
      //     sablon_detail.nota = '$nota_sablon'
      //     AND sablon_detail.kd_produk = '$r[kd_produk]'
      //     GROUP BY sablon_detail.kd_produk 
      //   "));

      $rP = mysqli_fetch_array(mysqli_query($link,"SELECT 
        SUM(produksi_detail.jumlah) AS jumlah_produksi
        FROM
        produksi_detail
        WHERE 
        produksi_detail.nota = '$nota'
        GROUP BY produksi_detail.kd_produk 
        "));

      $c = mysqli_num_rows(mysqli_query($link,"SELECT 
          sablon_detail.id_sablon_detail
          FROM 
          sablon_detail 
          WHERE 
          sablon_detail.nota = '$nota_sablon'
          AND sablon_detail.kd_produk = '$r[kd_produk]'
        "));
      $rows = $c + 1;
    ?>
      <tr class="no-border">
        <td align="center"><?= $i;?></td>
        <td align="left"><?= $r['kd_produk'];?></td>
        <td align="left"><?= $r['nm_brand'];?></td>
        <td align="left"><?= $r['nm_model'];?></td>
        <td align="left"><?= $r['nm_produk'];?></td>
        <td align="center"><?= number_format(lusin($rP['jumlah_produksi']));?></td>
        <td align="center"><?= number_format(pcs($rP['jumlah_produksi']));?></td>
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
            <td valign="top" height="100"><?= $keterangan;?></td>
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