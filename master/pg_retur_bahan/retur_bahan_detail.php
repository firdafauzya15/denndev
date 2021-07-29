<?php
include "master/function/nota.php";
$id_retur_bahan = base64_decode($_GET['id_retur_bahan']);
$q = mysqli_query($link,"SELECT 
                      retur_bahan.id_retur_bahan, 
                      retur_bahan.tanggal, 
                      retur_bahan.jatuh_tempo, 
                      supplier_bahan.nm_supplier_bahan
                      FROM 
                      retur_bahan 
                      INNER JOIN supplier_bahan ON supplier_bahan.id_supplier_bahan = retur_bahan.id_supplier_bahan 
                      WHERE retur_bahan.id_retur_bahan = '$id_retur_bahan'") or die (mysqli_error());
$r = mysqli_fetch_array($q);
$nota = notaReturBahan($r['id_retur_bahan']);
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Detail Retur Bahan
    </h1>
    <ol class="breadcrumb">
      <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Retur Bahan</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Data Retur Bahan</h3>
          </div><!-- /.box-header -->
          <br>
          <div class="box-body">
	          <div class="row">
		          <div class="col-md-6">
			          <table class="table table-bordered">
			          	<tr>
			          		<td>Tanggal</td>
			          		<td><?= $r['tanggal'];?></td>
			          	</tr>
			          	<tr>
			          		<td>Nota</td>
			          		<td><?= $nota;?></td>
			          	</tr>
			          	<tr>
			          		<td>Jatuh Tempo</td>
			          		<td><?= $r['jatuh_tempo'];?></td>
			          	</tr>
			          	<tr>
			          		<td>Supplier Bahan</td>
			          		<td><?= $r['nm_supplier_bahan'];?></td>
			          	</tr>
			          </table>
		          </div>
	          </div>
	          <hr>
	          <div class="row">
		          <div class="col-md-12">
			          <table class="table table-bordered">
			          	<tr>
			          		<td width="1">No</td>
			          		<td>Kode</td>
			          		<td>Nama</td>
			          		<td>Jumlah</td>
			          	</tr>
		              <?php
		                $i = 0;
		                $grandtotal = 0;
		                $q = mysqli_query($link,"SELECT 
		                      retur_bahan_detail.jumlah,
		                      bahan.kd_bahan,
		                      bahan.nm_bahan
		                      FROM 
		                      retur_bahan_detail 
		                      Inner Join bahan ON bahan.kd_bahan = retur_bahan_detail.kd_bahan
                      		WHERE retur_bahan_detail.id_retur_bahan = '$id_retur_bahan'
		                      ") or die (mysqli_error());
		                while ($r = mysqli_fetch_array($q)) {
		                	$i++;
		              ?>
					          	<tr>
					          		<td><?= $i;?></td>
					          		<td><?= $r['kd_bahan'];?></td>
					          		<td><?= $r['nm_bahan'];?></td>
					          		<td><?= $r['jumlah'];?></td>
					          	</tr>
					        <?php
						      	}
						      ?>
			          </table>
			          <hr>
			          <a class="btn btn-danger" onclick="window.history.back()"> Kembali</a>
		          </div>
	          </div>
          </div>
        </div><!-- /.box -->
      </div>
    </div><!-- /.row -->
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->