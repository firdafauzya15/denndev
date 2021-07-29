<?php
error_reporting(0);
include"../../../lib/koneksi.php";
include"../../function/convert_number.php";
$potong = mysqli_fetch_array(mysqli_query($link,"SELECT * FROM potong WHERE id_potong = '$_GET[id_potong]'"));
?>
<!DOCTYPE html>
<html>
<head>
 	<title>Print Laporan Pembayaran Cutting</title>
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
	<h2><u>Laporan Pembayaran Cutting</u></h2>
  <table>
    <tr>
      <td width="75">Tukang Potong</td>
      <td width="1">:</td>
      <td><?= $potong['nm_potong'];?></td>
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
        <th>Nota</th>
        <th>Tukang Potong</th>
        <th>Lusin</th>
        <th>Pcs</th>
        <th>Harga</th>
        <th>Total</th>
        <th width="1">Lunas</th>
      </tr>
    </thead>
    <tbody>
    <?php
      $i = 0;
      $total_harga = 0;
      $q_where = "";
      $q_date = "";
      $limit = "LIMIT 100";

      if ($_GET['cari']) {

        $q_where = "WHERE";

        if ($_GET['id_potong'] == '') {
          $q_potong = "spk_cutting.id_potong != '' AND";
        } else {
          $q_potong = "spk_cutting.id_potong = '$_GET[id_potong]' AND";
        }

        if ($_GET['dari'] == '' OR $_GET['sampai'] == '') {
          $q_date = "spk_cutting_pengiriman.tanggal != '' AND spk_cutting_pengiriman.tanggal != ''";
        } else {
          $q_date = "(date(spk_cutting_pengiriman.tanggal) >= '$_GET[dari]') AND (date(spk_cutting_pengiriman.tanggal) <= '$_GET[sampai]')";
        }
        
        $limit = "";

      }

      $q = mysqli_query($link,"SELECT 
            potong.nm_potong, 
            spk_cutting_pengiriman.id_spk_cutting_pengiriman,
            spk_cutting_pengiriman.tanggal,
            spk_cutting_pengiriman.jumlah,
            spk_cutting_pengiriman.lunas,
            spk_cutting.nota, 
            spk_cutting.harga
            FROM 
            spk_cutting_pengiriman
            INNER JOIN spk_cutting ON spk_cutting.nota = spk_cutting_pengiriman.nota 
            INNER JOIN potong ON potong.id_potong = spk_cutting.id_potong
            $q_where
            $q_potong
            $q_date
            Group By spk_cutting_pengiriman.id_spk_cutting_pengiriman
            Order By spk_cutting_pengiriman.id_spk_cutting_pengiriman DESC
            $limit
            ") or die (mysqli_error());
      while ($r = mysqli_fetch_array($q)) {
        $i++;
        $id_spk_cutting_pengiriman = base64_encode($r['id_spk_cutting_pengiriman']);
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
          <td><?= $r['nota'];?></td>
          <td><?= $r['nm_potong'];?></td>
          <td><?= number_format(lusin($r['jumlah']));?></td>
          <td><?= number_format(pcs($r['jumlah']));?></td>
          <td><?= number_format($r['harga']);?></td>
          <td><?= number_format($subtotal);?></td>
          <td><?= $lunas;?></td>
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
</body>
</html>
