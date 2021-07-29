<?php
error_reporting(0);
include"../../../lib/koneksi.php";
include"../../function/convert_number.php";
$cmt = mysqli_fetch_array(mysqli_query($link,"SELECT * FROM cmt WHERE id_cmt = '$_POST[id_cmt]'"));
?>
<!DOCTYPE html>
<html>
<head>
 	<title>Print Laporan Pembayaran CMT</title>
	<style>
		body {
			font-family: Verdana, Geneva, sans-serif;
			font-size: 15px;
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
  	<h2><u>Laporan Pembayaran CMT</u></h2>
    <table>
      <tr>
        <td width="75">CMT</td>
        <td width="1">:</td>
        <td><?= ($cmt['nm_cmt'] != '') ? $cmt['nm_cmt'] : '-';?></td>
      </tr>
     
    </table>
  	<table class="main-content">
      <thead>
        <tr>
          <th width="1">No.</th>
          <th>Tanggal</th>
          <th>Nota CMT</th>
          <th>Nama CMT</th>
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
        // $ids = implode(",", $_POST['ids']);
        $ids = implode(',', array_map('intval', $_POST['ids']));
        $q = mysqli_query($link,"SELECT 
              produksi_pengiriman.id_produksi_pengiriman, 
              produksi_pengiriman.jumlah, 
              produksi_pengiriman.tanggal,
              produksi_pengiriman.lunas,
              produksi.id_produksi, 
              produksi.nota,
              produksi.nota_sablon,
              produksi.harga,
              cmt.nm_cmt
              FROM 
              produksi_pengiriman
              INNER JOIN produksi_detail ON produksi_detail.id_produksi_detail = produksi_pengiriman.id_produksi_detail
              INNER JOIN produksi ON produksi.nota = produksi_detail.nota
              INNER JOIN cmt ON cmt.id_cmt = produksi.id_cmt
              WHERE 
              produksi_pengiriman.id_produksi_pengiriman IN ($ids)
              
              GROUP BY produksi_pengiriman.id_produksi_pengiriman
              ORDER BY produksi_pengiriman.id_produksi_pengiriman DESC
              ") or die (mysqli_error());
              


        while ($r = mysqli_fetch_array($q)) {
          $i++;
          $id_produksi_pengiriman = base64_encode($r['id_produksi_pengiriman']);
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
            <td><?= $r['nota_sablon'];?></td>
            <td><?= $r['nm_cmt'];?></td>
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