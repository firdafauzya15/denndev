<?php
error_reporting(0);
include"../../../lib/koneksi.php";
?>
<!DOCTYPE html>
<html>
<head>
 	<title>Print Laporan Pembelian Bahan</title>
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
<body onload="window.print()">
	<h2><u>Laporan Pembelian Bahan</u></h2>
	<table class="main-content">
		<thead>
			<tr>
			  <th width="1">No.</th>
			  <th>Tanggal</th>
			  <th>Supplier</th>
			  <th>Harga</th>
			</tr>
			</thead>
			<tbody>
			<?php
			$i = 0;
			$total_harga = 0;
			$where = "";
			$limit = "LIMIT 100";

			if ($_GET['cari']) {

			  $where = "WHERE";
			  if ($_GET['dari'] != '' AND $_GET['sampai'] != '') {
			    $where.= "(date(pembelian_bahan.tanggal) >= '$_GET[dari]') AND (date(pembelian_bahan.tanggal) <= '$_GET[sampai]')";
			  } else {
			    $where.= "pembelian_bahan.tanggal != ''";
			  }
			  if ($_GET['id_supplier_bahan'] != '') {
			    $where.= "AND pembelian_bahan.id_supplier_bahan = '$_GET[id_supplier_bahan]'";
			  } else {
			    $where.= "AND pembelian_bahan.id_supplier_bahan != ''";
			  }
			  $limit = "";

			}

			$q = mysqli_query($link,"SELECT 
			      pembelian_bahan.id_pembelian_bahan, 
			      pembelian_bahan.tanggal, 
			      sum(pembelian_bahan_detail.jumlah*pembelian_bahan_detail.harga) AS sub_total, 
			      supplier_bahan.nm_supplier_bahan
			      FROM 
			      pembelian_bahan 
			      INNER JOIN pembelian_bahan_detail ON pembelian_bahan_detail.id_pembelian_bahan = pembelian_bahan.id_pembelian_bahan 
			      INNER JOIN supplier_bahan ON supplier_bahan.id_supplier_bahan = pembelian_bahan.id_supplier_bahan 
			      $where
			      GROUP BY pembelian_bahan.id_pembelian_bahan
			      ORDER BY pembelian_bahan.id_pembelian_bahan DESC
			      $limit
			      ") or die (mysqli_error());
			while ($r = mysqli_fetch_array($q)) {
			  $i++;
			  $id_pembelian_bahan = base64_encode($r['id_pembelian_bahan']);
			  $total_harga += $r['sub_total'];
			?>
			  <tr>
			    <td><?= $i;?></td>
			    <td><?= $r['tanggal'];?></td>
			    <td><?= $r['nm_supplier_bahan'];?></td>
			    <td><?= number_format($r['sub_total']);?></td>
			  </tr>
			<?php
			}
			?>
			<tr style="font-weight: bold;">
			  <td colspan="3" align="right">Total</td>
			  <td><?= number_format($total_harga);?></td>  
			</tr>
		</tbody>
	</table>
</body>
</html>