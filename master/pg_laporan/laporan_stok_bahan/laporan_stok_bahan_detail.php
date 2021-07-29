<?php
$id_bahan_header = base64_decode($_GET['id_bahan_header']);
$q = mysqli_query($link,"SELECT 
	*
	FROM 
	bahan_header 
	WHERE id_bahan_header = '$id_bahan_header'
	") or die (mysqli_error());
$r = mysqli_fetch_array($q);
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Detail Stok Bahan
    </h1>
    <ol class="breadcrumb">
      <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Stok Bahan</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Data Stok Bahan</h3>
          </div><!-- /.box-header -->
          <br>
          <div class="box-body">
	          <div class="row">
		          <div class="col-md-6">
			          <table class="table table-bordered">
			          	<tr>
			          		<td>Kode</td>
			          		<td><?= $r['kd_bahan_header'];?></td>
			          	</tr>
			          	<tr>
			          		<td>Nama</td>
			          		<td><?= $r['nm_bahan_header'];?></td>
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
			          		<td width="1"></td>
			          	</tr>
		              <?php
		                $i = 0;
		                $q = mysqli_query($link,"SELECT sum(stok_bahan.jumlah) as jumlah, bahan.kd_bahan, bahan.nm_bahan FROM stok_bahan Inner Join bahan ON bahan.kd_bahan = stok_bahan.kd_bahan WHERE bahan.id_bahan_header = '$r[id_bahan_header]' group by bahan.kd_bahan, bahan.nm_bahan
		                      ") or die (mysqli_error());
		                while ($r = mysqli_fetch_array($q)) {
		                	$i++;
		                	$id_stok_bahan = base64_encode($r['id_stok_bahan']);
		              ?>
					          	<tr>
					          		<td><?= $i;?></td>
					          		<td><?= $r['kd_bahan'];?></td>
					          		<td><?= $r['nm_bahan'];?></td>
					          		<td><?= $r['jumlah'];?></td>
					          		<td>
                          <a href="?act=<?php echo md5('laporan_stok_bahan_edit')."&id_stok_bahan=$id_stok_bahan"?>" class="btn btn-xs btn-primary" title="Edit">
                          	<i class="fa fa-pencil"></i>
                          </a>
					          		</td>
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