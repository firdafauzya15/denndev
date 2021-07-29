<?php
error_reporting(0);
include"../../../lib/koneksi.php";
include"../../function/convert_number.php";
$vendor = mysqli_fetch_assoc(mysqli_query($link,"SELECT * FROM vendor WHERE id_vendor = '$_GET[id_vendor]'"));
?>
<!DOCTYPE html>
<html>
<head>
 	<title>Print Laporan Pembayaran Sablon</title>
	<style>
		body {
			font-family: Verdana, Geneva, sans-serif;
			font-size: 8px;
		}

		table {
			width: 100%;
		}

		table.header, table.main-content  {
	    border-collapse: collapse;
		}

		table.header td {
			padding: 3px;
		}

		table.main-content th, table.main-content td {
			padding: 3px;
	    border: 1px solid black;
		}
	</style>
</head>
<?php
if (!empty($_POST['ids'])) {
?>
  <body onload="window.print()">
  	<h2><u>Laporan Pembayaran Sablon</u></h2>
    <table>
      <tr>
        <td width="75">Vendor</td>
        <td width="1">:</td>
        <td><?= ($vendor['nm_vendor'] != '') ? $vendor['nm_vendor'] : '-';?></td>
      </tr>
      <tr>
        <td>Tanggal</td>
        <td>:</td>
        <td><?= $_GET['dari'];?> s.d <?= $_GET['sampai'];?></td>
      </tr>
    </table>
  	<table class="main-content">
      <thead>
        <tr>
          <th width="1">No.</th>
          <th>Tanggal</th>
          <th>Nota SPK</th>
          <th>Nota Sablon</th>
          <th>Vendor</th>
          <th>Harga</th>
          <th width="1">Lusin</th>
          <th width="1">Pcs</th>
          <th>Total</th>
        </tr>
      </thead>
      <tbody>
      <?php
        $i = 0;
        $total_harga = 0;
        $ids = implode(',', array_map('intval', $_POST['ids']));
        $q = mysqli_query($link,"SELECT 
          sablon_pengiriman.id_sablon_pengiriman,
          sablon_pengiriman.jumlah,
          sablon_pengiriman.tanggal,
          vendor.nm_vendor, 
          sablon.id_sablon, 
          sablon.nota_spk,
          sablon.nota,
          sablon.harga,
          sablon_pengiriman.lunas
          FROM 
          sablon_pengiriman 
          INNER JOIN sablon_detail ON sablon_detail.id_sablon_detail = sablon_pengiriman.id_sablon_detail
          INNER JOIN sablon ON sablon.nota = sablon_detail.nota
          INNER JOIN vendor ON vendor.id_vendor = sablon.id_vendor
          WHERE
          sablon_pengiriman.id_sablon_pengiriman IN ($ids)
          GROUP BY sablon_pengiriman.id_sablon_pengiriman
          ORDER BY sablon_pengiriman.id_sablon_pengiriman DESC
        ") or die (mysqli_error());
        while ($r = mysqli_fetch_assoc($q)) {
          $i++;
          $id_sablon_pengiriman = base64_encode($r['id_sablon_pengiriman']);
          $nota = base64_encode($r['nota']);
          $nol = base64_encode("0");
          $satu = base64_encode("1");
          $subtotal = (lusin($r['jumlah']) * $r['harga']) + (pcs($r['jumlah']) * ($r['harga']/12));
          $total_harga += $subtotal;

          $lunas = "<span class='label label-warning'>Pending</span>";
          if ($r['lunas'] == '1') {
            $lunas = "<span class='label label-success'>Done</span>";
          }
      ?>
          <tr>
            <td><?= $i;?></td>
            <td><?= $r['tanggal'];?></td>
            <td><?= $r['nota_spk'];?></td>
            <td><?= $r['nota'];?></td>
            <td><?= $r['nm_vendor'];?></td>
            <td><?= number_format($r['harga']);?></td>
            <td><?= number_format(lusin($r['jumlah']));?></td>
            <td><?= number_format(pcs($r['jumlah']));?></td>
            <td><?= number_format($subtotal);?></td>

          </tr>
      <?php
        }
      ?>
        <tr style="font-weight: bold;">
          <td colspan="7" align="right">Total</td>
          <td><?= number_format($total_harga);?></td>  
          <td></td>
        </tr>
      </tbody>
  	</table>
<?php
} else {
?>
  <body>
    <center><h1>Data belum dipilih</h1></center>
    <script type="text/javascript">setTimeout("window.close();", 500);</script>
<?php
}
?>
</body>
</html>
