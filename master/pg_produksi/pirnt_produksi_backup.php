<?php
include"../../lib/koneksi.php";
$nota = base64_decode($_GET['id']);
$q = mysqli_query($link,"SELECT 
                      cmt.nm_cmt, 
                      produksi.id_produksi, 
                      produksi.tanggal, 
                      produksi.nota_sablon, 
                      produksi.nota, 
                      produksi.harga
                      FROM 
                      produksi 
                      INNER JOIN cmt ON cmt.id_cmt = produksi.id_cmt
                      WHERE produksi.nota = '$nota'") or die (mysqli_error());
$r = mysqli_fetch_array($q);

$rP = mysqli_fetch_array(mysqli_query($link,"SELECT 
      sum(sablon_pengiriman.jumlah) AS jumlah_produksi
      FROM
      sablon_pengiriman
      Inner Join sablon_detail ON sablon_detail.id_sablon_detail = sablon_pengiriman.id_sablon_detail
      WHERE 
      sablon_detail.nota = '$r[nota_sablon]'
      "));
$nota_sablon = $r['nota_sablon'];
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
    h3 {
      padding: 0px;
      margin: 0px;
    }
    table td, table th {
      font-size: 12px;
      padding: 1px;
    }
  </style>
</head>
<body onload="window.print()">
	<h3>Surat Jalan Produksi</h3>
	<hr>
	<table>
		<tr>
			<td>Tanggal</td>
			<td>:</td>
			<td><?= $r['tanggal'];?></td>
		</tr>
		<tr>
			<td>Nota</td>
			<td>:</td>
			<td><?= $r['nota'];?></td>
		</tr>
    <tr>
      <td>Jumlah</td>
      <td>:</td>
      <td><?= number_format($rP['jumlah_produksi']);?> pcs</td>
    </tr>
    <tr>
      <td>CMT</td>
      <td>:</td>
      <td><?= $r['nm_cmt'];?></td>
    </tr>
	</table>
	<table width="100%" border="1" rules="all">
  	<tr>
      <th width="1">No</th>
      <th>Kode</th>
      <th width="100">Jumlah</th>
      <th rowspan="">Gambar</th>
    </tr>
    <?php
      $i = 0;
      $q = mysqli_query($link,"SELECT 
          sablon_detail.id_sablon_detail,
          sablon_detail.kd_produk_size, 
          produk.file, 
          produk.kd_produk, 
          produk.nm_produk 
          FROM 
          sablon_detail 
          Inner Join produk ON produk.kd_produk = sablon_detail.kd_produk
          WHERE 
          sablon_detail.nota = '$nota_sablon'
          GROUP BY sablon_detail.kd_produk
          ") or die (mysqli_error());

      while ($r = mysqli_fetch_array($q)) {
        $i++;

        $rP = mysqli_fetch_array(mysqli_query($link,"SELECT 
              sum(sablon_pengiriman.jumlah) AS jumlah_produksi
              FROM
              sablon_pengiriman
              Inner Join sablon_detail ON sablon_detail.id_sablon_detail = sablon_pengiriman.id_sablon_detail
              WHERE 
              sablon_detail.nota = '$nota_sablon'
              AND sablon_detail.kd_produk = '$r[kd_produk]'
              GROUP BY sablon_detail.kd_produk 
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
        <tr>
          <th><?= $i;?></th>
          <th><?= $r['kd_produk'];?> - <?= $r['nm_produk'];?></th>
          <th><?= number_format($rP['jumlah_produksi']);?></th>
          <th rowspan="<?= $rows;?>"><img src="../../upload/<?= $r['file'];?>" height="150" width="150"></th>
        </tr>
        <?php
          $qD = mysqli_query($link,"SELECT 
                sablon_detail.id_sablon_detail,
                sablon_detail.jumlah,
                sablon_detail.kd_produk_size
                FROM 
                sablon_detail 
                WHERE 
                sablon_detail.nota = '$nota_sablon'
                AND sablon_detail.kd_produk = '$r[kd_produk]'
                ") or die (mysqli_error());
          while ($rD = mysqli_fetch_array($qD)) {
            $id_sablon_detail = base64_encode($rD['id_sablon_detail']);

            $rPD = mysqli_fetch_array(mysqli_query($link,"SELECT 
                    sum(sablon_pengiriman.jumlah) AS produksi
                    FROM
                    sablon_pengiriman
                    Inner Join sablon_detail ON sablon_detail.id_sablon_detail = sablon_pengiriman.id_sablon_detail
                    WHERE 
                    sablon_detail.nota = '$nota_sablon'
                    AND sablon_detail.kd_produk_size = '$rD[kd_produk_size]'
                    GROUP BY sablon_detail.kd_produk 
                    "));

        ?>
            <tr>
              <td></td>
              <td><?= $rD['kd_produk_size'];?></td>
              <td><?= number_format($rPD['produksi']);?></td>
            </tr>
        <?php
          }
        ?>
        <tr>
          <td colspan="5">
            <div class="progress progress-xs">
              <div class="progress-bar progress-bar-blue" style="width: 100%; height: 1px;"></div>
            </div>
          </td>
        </tr>
    <?php
      }
    ?>
	</table>
</body>
</html>