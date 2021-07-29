<?php
$nota = base64_decode($_GET['nota']);
$q = mysqli_query($link,"SELECT 
                      potong.nm_potong, 
                      spk_cutting.id_spk_cutting, 
                      spk_cutting.tanggal, 
                      spk_cutting.nota, 
                      spk_cutting.harga
                      FROM 
                      spk_cutting 
                      INNER JOIN potong ON potong.id_potong = spk_cutting.id_potong
                      WHERE spk_cutting.nota = '$nota'") or die (mysqli_error());
$r = mysqli_fetch_array($q);
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Detail SPK Cutting
    </h1>
    <ol class="breadcrumb">
      <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">SPK Cutting</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Data SPK Cutting</h3>
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
			          		<td><?= $r['nota'];?></td>
			          	</tr>
			          	<tr>
			          		<td>Tukang Potong</td>
			          		<td><?= $r['nm_potong'];?></td>
			          	</tr>
			          	<tr>
			          		<td>Harga</td>
			          		<td><?= number_format($r['harga']);?></td>
			          	</tr>
			          	<tr>
			          		<td></td>
			          		<td><a class="btn btn-warning" target="blank" href="master/pg_spk_cutting/print_spk_cutting.php?id=<?= $_GET['nota'];?>"><i class="glyphicon glyphicon-print icon-white"></i> Print</a></td>
			          	</tr>
			          </table>
		          </div>
	          </div>
	          <hr>
	          <div class="row">
		          <div class="col-md-6">
			          <table class="table table-bordered">
			          	<tr>
			          		<td colspan="4"><b>Bahan</b></td>
			          	</tr>
			          	<tr>
			          		<td width="1">No</td>
			          		<td>Kode</td>
			          		<td>Nama</td>
			          		<td>Jumlah</td>
			          	</tr>
		              <?php
		                $i = 0;
		                $total = 0;
		                $q = mysqli_query($link,"SELECT 
		                      spk_cutting_detail.jumlah,
		                      bahan.kd_bahan, 
		                      bahan.nm_bahan 
		                      FROM 
		                      spk_cutting_detail 
		                      Inner Join bahan ON bahan.kd_bahan = spk_cutting_detail.kd_bahan
                      		WHERE 
                      		spk_cutting_detail.nota = '$r[nota]'
		                      ") or die (mysqli_error());
		                while ($r = mysqli_fetch_array($q)) {
		                	$i++;
		                	$total += $r['jumlah'];
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
						      <tr>
						      	<td colspan="3"></td>
					          <td><?= $total;?></td>
						      </tr>
			          </table>
		          </div>
		          <div class="col-md-6">
			          <table class="table table-bordered">
			          	<tr>
			          		<td colspan="4"><b>Pola</b></td>
			          	</tr>
			          	<tr>
			          		<td width="1">No</td>
			          		<td>Kode</td>
			          		<td>Nama</td>
			          	</tr>
		              <?php
		                $i = 0;
		                $q = mysqli_query($link,"SELECT 
		                      pola.kd_pola, 
		                      pola.nm_pola 
		                      FROM 
		                      spk_cutting_pola 
		                      Inner Join pola ON pola.id_pola = spk_cutting_pola.id_pola
                      		WHERE 
                      		spk_cutting_pola.nota = '$nota'
		                      ") or die (mysqli_error());
		                while ($r = mysqli_fetch_array($q)) {
		                	$i++;
		              ?>
					          	<tr>
					          		<td><?= $i;?></td>
					          		<td><?= $r['kd_pola'];?></td>
					          		<td><?= $r['nm_pola'];?></td>
					          	</tr>
					        <?php
						      	}
						      ?>
			          </table>
		          </div>
	          </div>
	          <hr>
	          <a href="?act=<?php echo md5('spk_cutting_add_pengiriman')."&nota=$_GET[nota]"?>" class="btn btn-sm btn-primary"><i class="fa fa-pencil-square-o"></i> Tambah Pengiriman</a>
	          <br><br>
	          <div class="row">
		          <div class="col-md-12">
			          <table class="table table-bordered">
			          	<tr>
			          		<td colspan="4"><b>Pengiriman Produk</b></td>
			          	</tr>
			          	<tr>
			          		<td width="1">No</td>
			          		<td>Tanggal</td>
			          		<td>Kode</td>
							<td>Model</td>
			          		<td>Nama</td>
			          		<td>Lusin</td>
			          		<td>Pcs</td>
			          		<td width="1"></td>
			          	</tr>
		              <?php
		                $i = 0;
		                $q = mysqli_query($link,"SELECT 
		                			produk.nm_produk,
		                      spk_cutting_pengiriman.id_spk_cutting_pengiriman, 
		                      spk_cutting_pengiriman.tanggal, 
		                      spk_cutting_pengiriman.kd_produk,
							  model.nm_model,
		                      spk_cutting_pengiriman.kd_produk_size, 
		                      spk_cutting_pengiriman.jumlah 
		                      FROM 
		                      spk_cutting_pengiriman 
		                      INNER JOIN produk ON produk.kd_produk = spk_cutting_pengiriman.kd_produk
							  INNER JOIN model on produk.id_model = model.id_model
                      		WHERE 
                      		spk_cutting_pengiriman.nota = '$nota'
		                      ") or die (mysqli_error());
		                while ($r = mysqli_fetch_array($q)) {
		                	$i++;
		                	$id_spk_cutting_pengiriman = base64_encode($r['id_spk_cutting_pengiriman']);
		              ?>
					          	<tr>
					          		<td><?= $i;?></td>
					          		<td><?= $r['tanggal'];?></td>
					          		<td><?= $r['kd_produk'];?> - <?= $r['kd_produk_size'];?></td>
									  <td><?= $r['nm_model'];?></td>
					          		<td><?= $r['nm_produk'];?></td>
					          		<td><?= number_format(lusin($r['jumlah']));?></td>
					          		<td><?= number_format(pcs($r['jumlah']));?></td>
					          		<td>
				          			<?php
		                            if ($_SESSION['id_level'] == 1) {
		                            ?>
                          				<a href="?act=<?php echo md5('spk_cutting_delete_item')."&id_spk_cutting_pengiriman=$id_spk_cutting_pengiriman"?>" class="btn btn-xs btn-danger" title="Hapus Item"  onclick="return confirm('Apakah anda yakin ?')"><i class="fa fa-trash"></i></a>
                          			<?php
	                          		}
	                          		?>
					          		</td>
					          	</tr>
					        <?php
						      	}
						      ?>
			          </table>
		          </div>
		        </div>
	          <hr>
	          <a class="btn btn-danger" onclick="window.history.back()"> Kembali</a>
          </div>
        </div><!-- /.box -->
      </div>
    </div><!-- /.row -->
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->