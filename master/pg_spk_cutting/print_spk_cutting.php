<?php
session_start();
date_default_timezone_set("Asia/Jakarta");
include"../../lib/koneksi.php";
include"../function/convert_number.php";
$nota = base64_decode($_GET['id']);
$q = mysqli_query($link,"SELECT 
  *
  FROM 
  spk_cutting 
  INNER JOIN potong ON potong.id_potong = spk_cutting.id_potong
  WHERE 
  spk_cutting.nota = '$nota'
") or die (mysqli_error());
$r = mysqli_fetch_assoc($q);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title></title>
	<style>
    body {
      font-size: 11px;
      font-family: Arial, Helvetica, sans-serif; 
    }
    table td, table th {
    	font-size: 12px;
      padding: 2px;
    }
    h6 {
      font-size: 12px;
      margin: 0;
      padding: 0;
    }
  </style>
</head>
<body onload="window.print()">
  <table>
    <tr>
      <td width="86"><img src="../../dist/img/logo-denndev.jpg" width="86" height="86"></td>
      <td width="300">
        <h6>SURAT JALAN <br> DEN N DEV CLOTING <br> COMPANY</h6>
        JL.UTAMA SAKTI 2 NO 42 H I <br>
        02129541614 <br>
        021295541614
      </td>
      <td width="400" valign="top">
        <table class="header">
          <tr>
            <td width="100">Nota</td>
            <td>: <?= $r['nota'];?></td>
          </tr>
          <tr>
            <td>Tanggal</td>
            <td>: <?= $r['tanggal'];?></td>
          </tr>
          <tr>
            <td>Tukang Potong</td>
            <td>: <?= $r['nm_potong'];?></td>
          </tr>
          <tr>
            <td>Harga</td>
            <td>: <?= number_format($r['harga']);?></td>
          </tr>
        </table>
      </td>
      <td width="200" valign="top">
        <table class="header">
          <tr>
            <td width="50">User</td>
            <td>: <?= $_SESSION['username'];?></td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
	<table width="100%" border="1" rules="all">
    <tr>
      <th colspan="4"><b>Bahan</b></th>
    </tr>
    <tr>
      <th width="1">No</th>
      <th>Kode</th>
      <th>Nama</th>
      <th>Jumlah</th>
    </tr>
    <?php
      $i = 0;
      $total = 0;
      $q = mysqli_query($link,"SELECT 
        spk_cutting_detail.jumlah,
        bahan.kd_bahan, 
        bahan.nm_bahan 
        FROM 
        spk_cutting_detail 
        INNER JOIN bahan ON bahan.kd_bahan = spk_cutting_detail.kd_bahan
        WHERE 
        spk_cutting_detail.nota = '$r[nota]'
      ") or die (mysqli_error());
      while ($r = mysqli_fetch_assoc($q)) {
        $i++;
        $total += $r['jumlah'];
    ?>
        <tr>
          <td align="center"><?= $i;?></td>
          <td><?= $r['kd_bahan'];?></td>
          <td><?= $r['nm_bahan'];?></td>
          <td align="center"><?= $r['jumlah'];?></td>
        </tr>
    <?php
      }
    ?>
    <tr>
      <td colspan="3"></td>
      <td align="center"><?= $total;?></td>
    </tr>
	</table>
  <br>
  <table width="100%" border="1" rules="all">
    <tr>
      <th colspan="4"><b>Pola</b></th>
    </tr>
    <tr>
      <th width="1">No</th>
      <th width="1">Gambar</th>
      <th>Kode</th>
      <th>Nama</th>
    </tr>
    <?php
      $i = 0;
      $q = mysqli_query($link,"SELECT 
        pola.file, 
        pola.kd_pola, 
        pola.nm_pola 
        FROM 
        spk_cutting_pola 
        INNER JOIN pola ON pola.id_pola = spk_cutting_pola.id_pola
        WHERE 
        spk_cutting_pola.nota = '$nota'
      ") or die (mysqli_error());
      while ($r = mysqli_fetch_assoc($q)) {
        $i++;
    ?>
        <tr>
          <td align="center"><?= $i;?></td>
          <td><img src="../../upload/<?= $r['file'];?>" height="100" width="100"></td>
          <td><?= $r['kd_pola'];?></td>
          <td><?= $r['nm_pola'];?></td>
        </tr>
    <?php
      }
    ?>
  </table>
  <br>
  <table width="100%" border="1" rules="all">
    <tr>
      <th colspan="5"><b>Produk</b></th>
    </tr>
    <tr>
      <th width="1">No</th>
      <th>Tanggal</th>
      <th>Kode</th>
      <th width="100">Lusin</th>
      <th width="100">Pcs</th>
    </tr>
    <?php
      $i = 0;
      $q = mysqli_query($link,"SELECT 
            *
            FROM 
            spk_cutting_pengiriman 
            WHERE 
            spk_cutting_pengiriman.nota = '$nota'
            ") or die (mysqli_error());
      while ($r = mysqli_fetch_assoc($q)) {
        $i++;
    ?>
        <tr>
          <td align="center"><?= $i;?></td>
          <td align="center"><?= $r['tanggal'];?></td>
          <td><?= $r['kd_produk_size'];?></td>
          <td align="center"><?= number_format(lusin($r['jumlah']));?></td>
          <td align="center"><?= number_format(pcs($r['jumlah']));?></td>
        </tr>
    <?php
      }
    ?>
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