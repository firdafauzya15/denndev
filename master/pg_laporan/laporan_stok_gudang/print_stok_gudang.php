<?php
session_start();
date_default_timezone_set("Asia/Jakarta");
include"../../../lib/koneksi.php";
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title></title>
  <link rel="stylesheet" href="">
  <style type="text/css">
    body {
      font-size: 11px;
      font-family: Verdana, Geneva, sans-serif;
    }
    table td, table th {
      padding: 5px;
    }
  </style>
</head>
<body onload="window.print()">
  <table width="100%" border="0">
    <tr>
      <td width="25%">
          <h3>Stok Gudang</h3>
          Tanggal : <?= date("d-m-Y");?><br>
      </td>
    </tr>    
  </table>
  <hr>
  <table width="100%" rules="all" border="1">
    <thead>
      <tr>
        <th width="1">No.</th>
        <th>Kode</th>
        <th>Nama</th>
        <?php
        $sizes = mysqli_query($link,"SELECT nm_size FROM size ORDER BY id_size ASC") or die (mysqli_error());
        while ($size = mysqli_fetch_array($sizes)) {
          echo "<th width='1'>$size[nm_size]</th>";
        }
        ?>
        <th width="1">Total</th>
      </tr>
    </thead>
    <tbody>
    <?php
      $i = 0;
      $q = mysqli_query($link,"SELECT 
            produk.kd_produk,
            produk.nm_produk
            FROM 
            stok_gudang 
            Inner Join produk_size ON produk_size.kd_produk_size = stok_gudang.kd_produk_size
            Inner Join produk ON produk.kd_produk = produk_size.kd_produk
            GROUP BY produk.kd_produk
            ORDER BY produk.kd_produk ASC
            ") or die (mysqli_error());
      while ($r = mysqli_fetch_array($q)) {
        $i++;
    ?>
        <tr>
          <td><?= $i;?></td>
          <td><?= $r['kd_produk'];?></td>
          <td><?= $r['nm_produk'];?></td>
          <?php
          $total = 0;
          $sizes = mysqli_query($link,"SELECT id_size FROM size ORDER BY id_size ASC") or die (mysqli_error());
          while ($size = mysqli_fetch_array($sizes)) {
            $stokGudang = mysqli_fetch_array(mysqli_query($link,"SELECT
              stok_gudang.jumlah
              FROM 
              stok_gudang
              INNER JOIN produk_size ON produk_size.kd_produk_size = stok_gudang.kd_produk_size
              WHERE 
              produk_size.id_size = '$size[id_size]'
              AND produk_size.kd_produk = '$r[kd_produk]'
              "));
            $jumlah = $stokGudang['jumlah'];
            if ($stokGudang == null) { 
              $jumlah = 0;
            }
            $total += $jumlah;
            echo "<td align=center>$jumlah</td>";
          }
          ?>
          <td><?= $total;?></td>
        </tr>
    <?php
      }
    ?>
    </tbody>
  </table>
</body>
</html>