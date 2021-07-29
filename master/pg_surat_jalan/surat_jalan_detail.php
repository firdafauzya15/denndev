<?php

include "master/function/nota.php";
$id_surat_jalan = base64_decode($_GET['id_surat_jalan']);
$result = mysqli_query($link,"SELECT 
                      surat_jalan.id_surat_jalan, 
                      surat_jalan.tanggal, 
                      surat_jalan.keterangan, 
                      toko.nm_toko
                      FROM 
                      surat_jalan 
                      Inner Join toko ON toko.id_toko = surat_jalan.id_toko 
                      WHERE surat_jalan.id_surat_jalan = '$id_surat_jalan'") or die (mysqli_error());
$row = mysqli_fetch_array($result);
$nota = notaSuratJalan($row['id_surat_jalan']);

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
            <h3 class="box-title">Data Surat Jalan</h3>
          </div><!-- /.box-header -->
          <br>
          <div class="box-body">
	          <div class="row">
		          <div class="col-md-6">
			          <table class="table table-bordered">
			          	<tr>
			          		<td>Tanggal</td>
			          		<td><?= $row['tanggal'];?></td>
			          	</tr>
			          	<tr>
			          		<td>Nota</td>
			          		<td><?= $nota;?></td>
			          	</tr>
			          	<tr>
			          		<td>Toko</td>
			          		<td><?= $row['nm_toko'];?></td>
			          	</tr>
			          	<tr>
			          		<td>Keterangan</td>
			          		<td>
			          			<?= $row['keterangan'];?>
			          			<a class="btn btn-xs btn-primary btn-md" data-toggle="modal" data-href="#add" href="#add"><i class="fa fa-pencil"></i></a>
			          		</td>
			          	</tr>
			          	<tr>
			          		<td></td>
			          		<td><a class="btn btn-warning" target="blank" href="master/pg_surat_jalan/print_surat_jalan.php?id=<?= $_GET['id_surat_jalan'];?>"><i class="glyphicon glyphicon-print icon-white"></i> Print</a></td>
			          	</tr>
			          </table>
		          </div>
		          <div class="col-md-6 text-right">
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
		                      surat_jalan_detail.jumlah, 
		                      produk_size.kd_produk_size, 
		                      produk.nm_produk 
		                      FROM 
		                      surat_jalan_detail 
		                      Inner Join produk_size ON produk_size.kd_produk_size = surat_jalan_detail.kd_produk_size
		                      Inner Join produk ON produk.kd_produk = produk_size.kd_produk
                      		  WHERE surat_jalan_detail.id_surat_jalan = '$id_surat_jalan'
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


<!--- responsive model -->
<div class="modal fade in display_none" id="add" tabindex="-1" role="dialog" aria-hidden="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title text-white">Edit Data</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <form action="home.php?act=<?php echo md5('surat_jalan_update')?>" method="post" 
                            class="form-horizontal">
                            <input type="hidden" name="id_surat_jalan" value="<?= $row['id_surat_jalan'];?>">
                            <div class="form-group row">
                                <div class="col-lg-2  text-lg-right">
                                    <label for="required2" class="col-form-label">Keterangan</label>
                                </div>
                                <div class="col-lg-4">
                                    <textarea name="keterangan" class="form-control"><?= $row['keterangan'];?></textarea>
                                </div>
                            </div>
                            <hr>
                            <div class="form-actions form-group row">
                                <div class="col-lg-2  text-lg-right">
                                </div>
                                <div class="col-lg-4 push-lg-4">
                                    <input type="submit" value="Simpan" class="btn btn-primary" 
                                    onclick="return confirm('Apakah anda yakin?')">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END modal-->