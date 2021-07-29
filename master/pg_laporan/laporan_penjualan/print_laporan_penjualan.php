<?php
error_reporting(0);
include"../../../lib/koneksi.php";
?>
<!DOCTYPE html>
<html>
<head>
 	<title>Print Laporan Penjualan</title>
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
	<h2><u>Laporan Penjulan</u></h2>
	<table class="header">
	  <?php
	  $metodes = mysqli_query($link,"SELECT * FROM _metode ORDER BY id_metode ASC");
	  while ($metode = mysqli_fetch_array($metodes)) {
	    $limit = 100;
	    $where = "WHERE ";
	    $where .= "penjualan.id_metode = '$metode[id_metode]'";
	    if ($_GET['dari'] != '' AND $_GET['sampai'] != '') {
	      $where .= "AND (date(penjualan.tanggal) >= '$_GET[dari]') AND (date(penjualan.tanggal) <= '$_GET[sampai]') ";
	    } else {
	      $where .= "AND penjualan.tanggal != '' ";
	    }
	    if ($_GET['id_customer'] != '') {
	      $where .= "AND penjualan.id_customer = '$_GET[id_customer]' ";
	    } else {
	      $where .= "AND penjualan.id_customer != '' ";
	    }
	    if ($_GET['id_toko'] != '') {
	      $where .= "AND penjualan.id_toko = '$_GET[id_toko]' ";
	    } else {
	      $where .= "AND penjualan.id_toko != '' ";
	    }

	    $total_omset = 0;
	    $penjualans = mysqli_query($link,"SELECT 
	      _metode.potongan, 
	      penjualan.nota, 
	      penjualan.pajak, 
	      penjualan.diskon, 
	      sum(penjualan_detail.jumlah) AS total 
	      FROM 
	      penjualan 
	      Inner Join _metode ON _metode.id_metode = penjualan.id_metode 
	      Inner Join penjualan_detail ON penjualan_detail.nota = penjualan.nota 
	      $where 
	      GROUP BY penjualan.nota
	      LIMIT $limit
	      ") or die (mysqli_error());
	    while ($penjualan = mysqli_fetch_array($penjualans)) {
	      $omset = 0;
	      $qp = mysqli_query($link,"SELECT 
	            penjualan_detail.harga_jual*penjualan_detail.jumlah AS subtotal
	            FROM 
	            penjualan_detail 
	            WHERE penjualan_detail.nota = '$penjualan[nota]'
	            ") or die (mysqli_error());
	      while ($rp = mysqli_fetch_array($qp)) {
	        $omset += $rp['subtotal'];
	      }

	      $pajak = ($omset*$penjualan['pajak'])/100;
	      $diskon = ($omset*$penjualan['diskon'])/100;
	      $potongan = ($omset*$penjualan['potongan'])/100;
	      $omset_bersih = $omset + $pajak - $diskon;

	      $total_jumlah += $penjualan['total'];
	      $total_omset_kotor += $omset;
	      $total_diskon += $diskon;
	      $total_pajak += $pajak;
	      $total_potongan += $potongan;
	      $total_omset += $omset_bersih;
	    }

	    $rows = "<tr>";
	    $rows .= "<td width='10%'>$metode[nm_metode]</td>";
	    $rows .= "<td width='90%'>: <b>".number_format($total_omset,0,',','.')."</b></span></td>";
	    $rows .= "</tr>";
	    echo "$rows";
	  }
	  ?>
	</table>
	<table class="main-content">
	  <thead>
	    <tr>
	      <th width="1">No.</th>
	      <th>Tanggal</th>
	      <th>Nota</th>
	      <th>Toko</th>
	      <th>Customer</th>
	      <th>Pembayaran</th>
	      <th>Jumlah</th>
	      <th>Total</th>
	      <th>Pajak (%)</th>
	      <th>Diskon (%)</th>
	      <th>Potongan (%)</th>
	      <th>Omset</th>
	    </tr>
	  </thead>
	  <tbody>
	  <?php
	    $i = 0;
	    $total_omset_kotor = 0;
	    $total_omset = 0;
	    $total_diskon = 0;
	    $total_pajak = 0;
	    $total_potongan = 0;
	    $total_jumlah = 0;
	    
	    $limit = 100;
	    $where = "WHERE ";

	    if ($_GET['dari'] != '' AND $_GET['sampai'] != '') {
	      $where .= "(date(penjualan.tanggal) >= '$_GET[dari]') AND (date(penjualan.tanggal) <= '$_GET[sampai]') ";
	    } else {
	      $where .= "penjualan.tanggal != '' ";
	    }

	    if ($_GET['id_customer'] != '') {
	      $where .= "AND penjualan.id_customer = '$_GET[id_customer]' ";
	    } else {
	      $where .= "AND penjualan.id_customer != '' ";
	    }

	    if ($_GET['id_toko'] != '') {
	      $where .= "AND penjualan.id_toko = '$_GET[id_toko]' ";
	    } else {
	      $where .= "AND penjualan.id_toko != '' ";
	    }

	    $q = mysqli_query($link,"SELECT 
	          penjualan.id_penjualan, 
	          penjualan.nota, 
	          penjualan.id_toko, 
	          penjualan.tanggal, 
	          penjualan.pajak, 
	          penjualan.diskon, 
	          penjualan.online, 
	          customer.nm_customer, 
	          _metode.nm_metode, 
	          _metode.potongan, 
	          sum(penjualan_detail.jumlah) AS total 
	          FROM 
	          penjualan 
	          Inner Join _metode ON _metode.id_metode = penjualan.id_metode 
	          Inner Join customer ON customer.id_customer = penjualan.id_customer 
	          Inner Join penjualan_detail ON penjualan_detail.nota = penjualan.nota 
	          $where
	          Group By penjualan.id_penjualan
	          Order By penjualan.id_penjualan DESC
	          LIMIT $limit
	          ") or die (mysqli_error());
	    while ($r = mysqli_fetch_array($q)) {
	      $i++;
	      $id_penjualan = base64_encode($r['id_penjualan']);
	      $nota = base64_encode($r['nota']);

	      $toko = mysqli_fetch_array(mysqli_query($link,"SELECT * FROM toko WHERE id_toko = '$r[id_toko]'"));
	      $namaToko = $toko['nm_toko'];
	      if ($toko['nm_toko'] == null) {
	        $namaToko = "-";
	      }

	      $omset = 0;
	      $qp = mysqli_query($link,"SELECT 
	            penjualan_detail.harga_jual*penjualan_detail.jumlah AS subtotal
	            FROM 
	            penjualan_detail 
	            WHERE penjualan_detail.nota = '$r[nota]'
	            ") or die (mysqli_error());
	      while ($rp = mysqli_fetch_array($qp)) {
	        $omset += $rp['subtotal'];
	      }

	      $pajak = ($omset*$r['pajak'])/100;
	      $diskon = ($omset*$r['diskon'])/100;
	      $potongan = ($omset*$r['potongan'])/100;
	      $omset_bersih = $omset + $pajak - $diskon;

	      $total_jumlah += $r['total'];
	      $total_omset_kotor += $omset;
	      $total_diskon += $diskon;
	      $total_pajak += $pajak;
	      $total_potongan += $potongan;
	      $total_omset += $omset_bersih;

	      $link = "penjualan_detail";
	      if ($toko['nm_toko'] == null) {
	        $link = "penjualan_kantor_detail";
	      }
	  ?>
	      <tr>
	        <td><?= $i;?></td>
	        <td><?= $r['tanggal'];?></td>
	        <td><?= $r['nota'];?></td>
	        <td><?= $namaToko;?></td>
	        <td><?= $r['nm_customer'];?></td>
	        <td><?= $r['nm_metode'];?></td>
	        <td><?= number_format($r['total']);?> pcs</td>
	        <td><?= number_format($omset);?></td>
	        <td><?= number_format($pajak);?> (<?= $r['pajak'];?>)</td>
	        <td><?= number_format($diskon);?> (<?= $r['diskon'];?>)</td>
	        <td><?= number_format($potongan);?> (<?= $r['potongan'];?>)</td>
	        <td><?= number_format($omset_bersih);?></td>
	      </tr>
	  <?php
	    }
	  ?>
	    <tr style="font-weight: bold;">
	      <td colspan="6" align="right">Total</td>
	      <td><?= number_format($total_jumlah);?> pcs</td>  
	      <td><?= number_format($total_omset_kotor);?></td>  
	      <td><?= number_format($total_pajak);?></td>  
	      <td><?= number_format($total_diskon);?></td>  
	      <td><?= number_format($total_potongan);?></td>  
	      <td><?= number_format($total_omset);?></td>  
	    </tr>
	  </tbody>
	</table>
</body>
</html>