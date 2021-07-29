<?php
include"../../lib/koneksi.php";
include"../function/convert_number.php";
$id_potongan_merk = base64_decode($_GET['id']);
$q = mysqli_query($link,"SELECT 
                      *
                      FROM 
                      potongan_merk 
                      Inner Join cmt ON cmt.id_cmt = potongan_merk.id_cmt 
                      WHERE potongan_merk.id_potongan_merk = '$id_potongan_merk'") or die (mysqli_error());
$r = mysqli_fetch_array($q);
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
			font-family: Calibri, Candara, Segoe, "Segoe UI", Optima, Arial, sans-serif;
		}
    table td, table th {
    	font-size: 12px;
      padding: 5px;
    }
  </style>
</head>
<body onload="window.print()">
	<h3>Potongan Merk</h3>
	<hr>
	<table>
		<tr>
			<td>Tanggal</td>
			<td>:</td>
			<td><?= $r['tanggal'];?></td>
		</tr>
		<tr>
			<td>CMT</td>
			<td>:</td>
			<td><?= $r['nm_cmt'];?></td>
		</tr>
	</table>
	<table width="100%" border="1" rules="all">
  	<tr>
      <td width="1">No</td>
      <td>Kode</td>
      <td>Nama</td>
      <td>Jumlah</td>
      <td>Harga</td>
      <td>Total</td>
    </tr>
    <?php
      $i = 0;
      $grandtotal = 0;
      $q = mysqli_query($link,"SELECT 
            potongan_merk_detail.jumlah, 
            potongan_merk_detail.harga,
            (potongan_merk_detail.jumlah*potongan_merk_detail.harga) AS sub_total, 
            aksesoris.kd_aksesoris, 
            aksesoris.nm_aksesoris
            FROM 
            potongan_merk_detail 
            Inner Join aksesoris ON aksesoris.kd_aksesoris = potongan_merk_detail.kd_aksesoris
            WHERE potongan_merk_detail.id_potongan_merk = '$id_potongan_merk'
            ") or die (mysqli_error());
      while ($r = mysqli_fetch_array($q)) {
        $i++;
        $grandtotal += $r['sub_total'];
    ?>
        <tr>
          <tr>
            <td><?= $i;?></td>
            <td><?= $r['kd_aksesoris'];?></td>
            <td><?= $r['nm_aksesoris'];?></td>
            <td><?= $r['jumlah'];?></td>
            <td><?= number_format($r['harga']);?></td>
            <td><?= number_format($r['sub_total']);?></td>
          </tr>
        </tr>
        <tr style="font-weight: bold;">
          <td colspan="5"></td>
          <td><?= number_format($grandtotal);?></td>
        </tr>
    <?php
      }
    ?>
	</table>
</body>
</html>