<?php

error_reporting(0);
include"../../lib/koneksi.php";
include"../../function/convert_number.php";
$cmt = mysqli_fetch_array(mysqli_query($link,"SELECT * FROM cmt WHERE id_cmt = '$_GET[id_cmt]'"));

?>
<!DOCTYPE html>
<html>
<head>
 	<title>Print QC</title>
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
	<h2><u>QC</u></h2>
  <table>
    <tr>
      <td width="75">CMT</td>
      <td width="1">:</td>
      <td><?= $cmt['nm_cmt'];?></td>
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
        <th>CMT</th>
        <th>Kode</th>
        <th>Jumlah Penalty</th>
        <th>Keterangan</th>
        <th>Foto</th>
        <th width="1">Status</th>
      </tr>
    </thead>
    <tbody>
    <?php
      $i = 0;
      $limit = 100;
      $where = "WHERE ";
      if ($_GET['dari'] != '' AND $_GET['sampai'] != '') {
        $where .= "(date(qc.tanggal) >= '$_GET[dari]') AND (date(qc.tanggal) <= '$_GET[sampai]') AND ";
      } else {
        $where .= "qc.tanggal != '' AND ";
      }

      if ($_GET['id_cmt'] != '') {
        $where .= "qc.id_cmt = '$_GET[id_cmt]' ";
      } else {
        $where .= "qc.id_cmt != '' ";
      }
      $q = mysqli_query($link,"SELECT 
        *   
        FROM 
        qc 
        INNER JOIN cmt ON cmt.id_cmt = qc.id_cmt
        $where 
        ORDER BY id_qc DESC 
        LIMIT $limit
        ");
      if (mysqli_num_rows($q) > 0) {
        while ($r = mysqli_fetch_array($q)) {
          $i++;
          $status = "Pending";
          if ($r['status'] == '1') {
            $status = "Done";
          }
    ?>
          <tr>
            <td><?= $i;?></td>
            <td><?= $r['tanggal'];?></td>
            <td><?= $r['nm_cmt'];?></td>
            <td><?= $r['kd_produk'];?></td>
            <td><?= $r['jumlah_penalty'];?></td>
            <td><?= $r['keterangan'];?></td>
            <td><img src="../../upload/<?= $r['file'];?>" height="50" width="50"></td>
            <td><?= $status;?></td>
          </tr>
    <?php
        }
      } else {
    ?>
        <tr>
          <td colspan="8" align="center">Data tidak ada</td>
        </tr>
    <?php
      }
    ?>
    </tbody>
	</table>
</body>
</html>