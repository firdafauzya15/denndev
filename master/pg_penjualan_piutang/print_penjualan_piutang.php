<?php
error_reporting(0);
include"../../lib/koneksi.php";
include"../function/convert_number.php";
?>
<!DOCTYPE html>
<html>
<head>
 	<title>Print Penjualan Piutang</title>
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
	<h2><u>Penjualan Piutang</u></h2>
	<table class="main-content">
    <thead>
      <tr>
        <th width="1">No.</th>
        <th>Tanggal</th>
        <th>Nota</th>
        <th>Toko</th>
        <th>Customer</th>
        <th>Total Belanja</th>
        <th width="1">Status</th>
      </tr>
    </thead>
    <tbody>
    <?php
      $i = 0;
      $limit = 100;
      $where = "WHERE ";
      if ($_GET['dari'] != '' AND $_GET['sampai'] != '') {
        $where .= "(date(penjualan.tanggal) >= '$_GET[dari]') AND (date(penjualan.tanggal) <= '$_GET[sampai]') AND ";
      } else {
        $where .= "penjualan.tanggal != '' AND ";
      }

      if ($_GET['id_toko'] != '') {
        $where .= "penjualan.id_toko = '$_GET[id_toko]' AND ";
      } else {
        $where .= "penjualan.id_toko != '' AND ";
      }

      if ($_GET['id_customer'] != '') {
        $where .= "penjualan.id_customer = '$_GET[id_customer]' ";
      } else {
        $where .= "penjualan.id_customer != '' ";
      }
      $q = mysqli_query($link,"SELECT 
            penjualan.nota, 
            penjualan.id_toko, 
            penjualan.tanggal, 
            penjualan.pajak, 
            penjualan.diskon, 
            penjualan.status, 
            toko.nm_toko,
            customer.nm_customer
            FROM 
            penjualan 
            Inner Join toko ON toko.id_toko = penjualan.id_toko 
            Inner Join customer ON customer.id_customer = penjualan.id_customer 
            $where
            AND penjualan.online = '0'
            AND penjualan.id_metode = '5'
            Group By penjualan.id_penjualan
            Order By penjualan.id_penjualan DESC
            ") or die (mysqli_error());
      while ($r = mysqli_fetch_array($q)) {
        $i++;
        $status = "Pending";
        if ($r['status'] == '1') {
          $status = "Done";
        }


        $total = 0;
        $penjualanDetails = mysqli_query($link,"SELECT 
              penjualan_detail.jumlah, 
              penjualan_detail.harga_jual
              FROM 
              penjualan_detail 
              WHERE penjualan_detail.nota = '$r[nota]'
              ") or die (mysqli_error());
        while ($penjualanDetail = mysqli_fetch_array($penjualanDetails)) {
          $subtotal = (lusin($penjualanDetail['jumlah']) * $penjualanDetail['harga_jual']) + (pcs($penjualanDetail['jumlah']) * ($penjualanDetail['harga_jual']/12));
          $total += $subtotal;
        }
        $pajak = ($total*$r['pajak'])/100;
        $diskon = ($total*$r['diskon'])/100;
        $grandtotal = $total + $pajak - $diskon;
    ?>
        <tr>
          <td><?= $i;?></td>
          <td><?= $r['tanggal'];?></td>
          <td><?= $r['nota'];?></td>
          <td><?= $r['nm_toko'];?></td>
          <td><?= $r['nm_customer'];?></td>
          <td><?= number_format($grandtotal);?></td>
          <td><?= $status;?></td>
        </tr>
    <?php
      }
    ?>
    </tbody>
	</table>
</body>
</html>