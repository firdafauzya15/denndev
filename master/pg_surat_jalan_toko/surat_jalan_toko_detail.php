<?php
include "master/function/nota.php";
$id_surat_jalan_toko = base64_decode($_GET['id_surat_jalan_toko']);
$q = mysqli_query($link,"SELECT 
                      surat_jalan_toko.id_surat_jalan_toko, 
                      surat_jalan_toko.tanggal, 
                      surat_jalan_toko.id_toko_tujuan, 
                      toko.nm_toko
                      FROM 
                      surat_jalan_toko 
                      Inner Join toko ON toko.id_toko = surat_jalan_toko.id_toko 
                      WHERE surat_jalan_toko.id_surat_jalan_toko = '$id_surat_jalan_toko'") or die (mysqli_error());
$r = mysqli_fetch_array($q);
$rTT = mysqli_fetch_array(mysqli_query($link,"SELECT nm_toko FROM toko WHERE id_toko = '$r[id_toko_tujuan]'"));
$nota = notaSuratJalan($r['id_surat_jalan_toko']);
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Detail Surat Jalan
    </h1>
    <ol class="breadcrumb">
      <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Surat Jalan</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Data Surat Jalan antar Toko</h3>
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
			          		<td>Toko Awal</td>
			          		<td><?= $r['nm_toko'];?></td>
			          	</tr>
			          	<tr>
			          		<td>Toko Tujuan</td>
			          		<td><?= $rTT['nm_toko'];?></td>
			          	</tr>
			          	<tr>
			          		<td></td>
			          		<td><a class="btn btn-warning" target="blank" href="master/pg_surat_jalan_toko/print_surat_jalan_toko.php?id=<?= $_GET['id_surat_jalan_toko'];?>"><i class="glyphicon glyphicon-print icon-white"></i> Print</a></td>
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
			          		<td>Lusin</td>
			          		<td>Pcs</td>
			          	</tr>
		              <?php
		                $i = 0;
		                $q = mysqli_query($link,"SELECT 
		                      surat_jalan_toko_detail.jumlah, 
		                      produk_size.kd_produk_size, 
		                      produk.nm_produk 
		                      FROM 
		                      surat_jalan_toko_detail 
		                      Inner Join produk_size ON produk_size.kd_produk_size = surat_jalan_toko_detail.kd_produk_size
		                      Inner Join produk ON produk.kd_produk = produk_size.kd_produk
                      		  WHERE surat_jalan_toko_detail.id_surat_jalan_toko = '$id_surat_jalan_toko'
		                      ") or die (mysqli_error());
		                while ($r = mysqli_fetch_array($q)) {
		                	$i++;
		              ?>
					          	<tr>
					          		<td><?= $i;?></td>
					          		<td><?= $r['kd_produk_size'];?></td>
					          		<td><?= $r['nm_produk'];?></td>
					          		<td><?= number_format(lusin($r['jumlah']));?></td>
					          		<td><?= number_format(pcs($r['jumlah']));?></td>
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