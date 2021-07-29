<?php
error_reporting(0);
include"../../../lib/koneksi.php";
?>
<!DOCTYPE html>
<html>
<head>
 	<title>Print Laporan Retur Penjualan</title>
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
	<h2><u>Laporan Retur Penjulan</u></h2>
	<table class="main-content">
		<thead>
		  <tr>
		    <th width="1">No.</th>
		    <th>Tanggal</th>
		    <th>Nota</th>
		    <th>Toko</th>
		    <th>Customer</th>
		    <th>Nominal</th>
		  </tr>
		</thead>
		<tbody>
		<?php
		  $i = 0;
		  $grandTotal = 0;
		  
		  $limit = 100;
		  $where = "WHERE ";

		  if ($_GET['dari'] != '' AND $_GET['sampai'] != '') {
		    $where .= "(date(retur_penjualan.tanggal) >= '$_GET[dari]') AND (date(retur_penjualan.tanggal) <= '$_GET[sampai]') ";
		  } else {
		    $where .= "retur_penjualan.tanggal != '' ";
		  }

		  if ($_GET['id_customer'] != '') {
		    $where .= "AND retur_penjualan.id_customer = '$_GET[id_customer]' ";
		  } else {
		    $where .= "AND retur_penjualan.id_customer != '' ";
		  }

		  if ($_GET['id_toko'] != '') {
		    $where .= "AND retur_penjualan.id_toko = '$_GET[id_toko]' ";
		  } else {
		    $where .= "AND retur_penjualan.id_toko != '' ";
		  }

		  $q = mysqli_query($link,"SELECT 
		        retur_penjualan.id_retur_penjualan, 
		        retur_penjualan.nota, 
		        retur_penjualan.id_toko, 
		        retur_penjualan.tanggal,
		        customer.nm_customer, 
		        sum(retur_penjualan_detail.jumlah) AS total 
		        FROM 
		        retur_penjualan 
		        Inner Join customer ON customer.id_customer = retur_penjualan.id_customer 
		        Inner Join retur_penjualan_detail ON retur_penjualan_detail.nota = retur_penjualan.nota 
		        $where
		        Group By retur_penjualan.id_retur_penjualan
		        Order By retur_penjualan.id_retur_penjualan DESC
		        LIMIT $limit
		        ") or die (mysqli_error());
		  while ($r = mysqli_fetch_array($q)) {
		    $i++;
		    $id_retur_penjualan = base64_encode($r['id_retur_penjualan']);
		    $nota = base64_encode($r['nota']);

		    $toko = mysqli_fetch_array(mysqli_query($link,"SELECT * FROM toko WHERE id_toko = '$r[id_toko]'"));
		    $namaToko = $toko['nm_toko'];
		    if ($toko['nm_toko'] == null) {
		      $namaToko = "-";
		    }

		    $subTotal = 0;
		    $qp = mysqli_query($link,"SELECT 
		          retur_penjualan_detail.harga_jual*retur_penjualan_detail.jumlah AS subtotal
		          FROM 
		          retur_penjualan_detail 
		          WHERE retur_penjualan_detail.nota = '$r[nota]'
		          ") or die (mysqli_error());
		    while ($rp = mysqli_fetch_array($qp)) {
		      $subTotal += $rp['subtotal'];
		    }

		    $grandTotal += $subTotal;

		    $link = "retur_penjualan_detail";
		?>
		    <tr>
		      <td><?= $i;?></td>
		      <td><?= $r['tanggal'];?></td>
		      <td><?= $r['nota'];?></td>
		      <td><?= $namaToko;?></td>
		      <td><?= $r['nm_customer'];?></td>
		      <td><?= number_format($subTotal);?></td>
		    </tr>
		<?php
		  }
		?>
		  <tr style="font-weight: bold;">
		    <td colspan="5" align="right">Total</td>
		    <td><?= number_format($grandTotal);?></td>  
		  </tr>
		</tbody>
	</table>
</body>
</html>