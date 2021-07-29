<?php
error_reporting(0);
include"../../../lib/koneksi.php";
include"../../function/convert_number.php";
?>
<!DOCTYPE html>
<html>
<head>
 	<title>Print Laporan Settlement Harian</title>
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
	<h2><u>Laporan Settlement Harian</u></h2>
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
        penjualan.nota, 
        penjualan.diskon, 
        penjualan.total_retur, 
        penjualan.ongkir, 
        sum(penjualan_detail.jumlah) AS total 
        FROM 
        penjualan 
        Inner Join penjualan_detail ON penjualan_detail.nota = penjualan.nota 
        $where 
        GROUP BY penjualan.id_penjualan
        LIMIT $limit
        ") or die (mysqli_error());
      while ($penjualan = mysqli_fetch_array($penjualans)) {
        $omset = 0;
	      $qp = mysqli_query($link,"SELECT 
	            penjualan_detail.harga_jual,
	            penjualan_detail.jumlah
	            FROM 
	            penjualan_detail 
	            WHERE penjualan_detail.nota = '$penjualan[nota]'
	            ") or die (mysqli_error());
	      while ($rp = mysqli_fetch_array($qp)) {
	        $subtotal = (lusin($rp['jumlah']) * $rp['harga_jual']) + (pcs($rp['jumlah']) * ($rp['harga_jual']/12));
	        $omset += $subtotal;
	      }

        $diskon = $penjualan['diskon'];
        $ongkir = $penjualan['ongkir'];
        $retur = $penjualan['total_retur'];
        $omset_bersih = $omset + $ongkir - $diskon - $retur;

        $total_jumlah += $penjualan['total'];
        $total_omset_kotor += $omset;
        $total_diskon += $diskon;
        $total_ongkir += $ongkir;
        $total_retur += $retur;
        $total_omset += $omset_bersih;
	    }

			$wherePiutang = "WHERE ";
      $wherePiutang .= "penjualan_piutang.id_metode = '$metode[id_metode]'";
      if ($_GET['dari'] != '' AND $_GET['sampai'] != '') {
        $wherePiutang .= "AND (date(penjualan_piutang.tanggal) >= '$_GET[dari]') AND (date(penjualan_piutang.tanggal) <= '$_GET[sampai]') ";
      } else {
        $wherePiutang .= "AND penjualan_piutang.tanggal != '' ";
      }
      if ($_GET['id_customer'] != '') {
        $wherePiutang .= "AND penjualan.id_customer = '$_GET[id_customer]' ";
      } else {
        $wherePiutang .= "AND penjualan.id_customer != '' ";
      }
      if ($_GET['id_toko'] != '') {
        $wherePiutang .= "AND penjualan.id_toko = '$_GET[id_toko]' ";
      } else {
        $wherePiutang .= "AND penjualan.id_toko != '' ";
      }

      $totalNominal = 0;
      $penjualanPiutangs = mysqli_query($link,"SELECT 
        penjualan_piutang.nominal
        FROM 
        penjualan_piutang
        INNER JOIN penjualan ON penjualan.nota = penjualan_piutang.nota
        $wherePiutang
        LIMIT $limit
        ") or die (mysqli_error());
      while ($penjualanPiutang = mysqli_fetch_array($penjualanPiutangs)) { 
        $totalNominal += $penjualanPiutang['nominal'];
      }
      $grandTotalMetode = $total_omset + $totalNominal;

	    $rows = "<tr>";
	    $rows .= "<td width='10%'>$metode[nm_metode]</td>";
	    $rows .= "<td width='90%'>: <b>".number_format($grandTotalMetode,0,',','.')."</b></span></td>";
	    $rows .= "</tr>";
	    echo "$rows";
	  }
	  ?>
	</table>
	<table class="main-content">
    <thead>
      <tr>
        <th colspan="13">Daftar Penjualan</th>
      </tr>
      <tr>
        <th width="1">No.</th>
        <th>Tanggal</th>
        <th>Nota</th>
        <th>Toko</th>
        <th>Customer</th>
        <th>Pembayaran</th>
        <th>Lusin</th>
        <th>Pcs</th>
        <th>Total</th>
        <th>Ongkir</th>
        <th>Diskon</th>
        <th>Retur</th>
        <th>Omset</th>
      </tr>
    </thead>
    <tbody>
    <?php
      $i = 0;
      $total_omset_kotor = 0;
      $total_omset = 0;
      $total_diskon = 0;
      $total_ongkir = 0;
      $total_retur = 0;
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
            penjualan.diskon, 
            penjualan.ongkir, 
            penjualan.total_retur, 
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
              penjualan_detail.harga_jual,
              penjualan_detail.jumlah
              FROM 
              penjualan_detail 
              WHERE penjualan_detail.nota = '$r[nota]'
              ") or die (mysqli_error());
        while ($rp = mysqli_fetch_array($qp)) {
          $subtotal = (lusin($rp['jumlah']) * $rp['harga_jual']) + (pcs($rp['jumlah']) * ($rp['harga_jual']/12));
          $omset += $subtotal;
        }

        $diskon = $r['diskon'];
        $ongkir = $r['ongkir'];
        $retur = $r['total_retur'];
        $omset_bersih = $omset + $ongkir - $diskon - $retur;

        $total_jumlah += $r['total'];
        $total_omset_kotor += $omset;
        $total_diskon += $diskon;
        $total_ongkir += $ongkir;
        $total_retur += $retur;
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
          <td><?= number_format(lusin($r['total']));?></td>
          <td><?= number_format(pcs($r['total']));?></td>
          <td><?= number_format($omset);?></td>
          <td><?= number_format($ongkir);?></td>
          <td><?= number_format($r['diskon']);?></td>
          <td><?= number_format($retur);?></td>
          <td><?= number_format($omset_bersih);?></td>
        </tr>
    <?php
      }
    ?>
      <tr style="font-weight: bold;">
        <td colspan="6" align="right">Total</td>
        <td><?= number_format(lusin($total_jumlah));?></td>  
        <td><?= number_format(pcs($total_jumlah));?></td>  
        <td><?= number_format($total_omset_kotor);?></td>  
        <td><?= number_format($total_ongkir);?></td>  
        <td><?= number_format($total_diskon);?></td>  
        <td><?= number_format($total_retur);?></td>  
        <td><?= number_format($total_omset);?></td>  
      </tr>
    </tbody>
	</table>
	<br>
	<table class="main-content">
	  <thead>
      <tr>
        <th colspan="12">Daftar Pembayaran Hutang</th>
      </tr>
      <tr>
        <th width="1">No.</th>
        <th>Tanggal</th>
        <th>Nota</th>
        <th>Customer</th>
        <th>Metode</th>
        <th>Nominal</th>
      </tr>
	  </thead>
	  <tbody>
	  <?php
	    $i = 0;
      $totalNominal = 0;

      $limit = 100;
      $where = "WHERE ";

      if ($_GET['dari'] != '' AND $_GET['sampai'] != '') {
        $where .= "(date(penjualan_piutang.tanggal) >= '$_GET[dari]') AND (date(penjualan_piutang.tanggal) <= '$_GET[sampai]') ";
      } else {
        $where .= "penjualan_piutang.tanggal != '' ";
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

      $penjualanPiutangs = mysqli_query($link,"SELECT 
        customer.nm_customer,
        _metode.nm_metode,
        penjualan_piutang.tanggal,
        penjualan_piutang.nota,
        penjualan_piutang.nominal
        FROM 
        penjualan_piutang
        INNER JOIN _metode ON _metode.id_metode = penjualan_piutang.id_metode
        INNER JOIN penjualan ON penjualan.nota = penjualan_piutang.nota
        INNER JOIN customer ON customer.id_customer = penjualan.id_customer
        $where
        LIMIT $limit
        ") or die (mysqli_error());
      while ($penjualanPiutang = mysqli_fetch_array($penjualanPiutangs)) { 
        $i++;
        $totalNominal += $penjualanPiutang['nominal'];
	  ?>
      <tr>
        <td><?= $i;?></td>
        <td><?= $penjualanPiutang['tanggal'];?></td>
        <td><?= $penjualanPiutang['nota'];?></td>
        <td><?= $penjualanPiutang['nm_customer'];?></td>
        <td><?= $penjualanPiutang['nm_metode'];?></td>
        <td><?= number_format($penjualanPiutang['nominal']);?></td>
      </tr>
	  <?php
	    }
	  ?>
	    <tr style="font-weight: bold;">
        <td colspan="5" align="right">Total</td>
        <td><?= number_format($totalNominal);?></td>
      </tr>
	  </tbody>
	</table>
</body>
</html>