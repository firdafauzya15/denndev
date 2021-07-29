<?php
echo $nota = base64_decode($_GET['nota']);
$q = mysqli_query($link,"SELECT 
                      spk_cutting.qty, 
                      sablon.id_sablon, 
                      sablon.tanggal, 
                      sablon.jatuh_tempo, 
                      sablon.nota_spk, 
                      sablon.nota, 
                      sablon.id_vendor, 
                      sablon.harga,
                      vendor.nm_vendor
                      FROM 
                      sablon 
                      INNER JOIN spk_cutting ON spk_cutting.nota = sablon.nota_spk
                      INNER JOIN vendor ON vendor.id_vendor = sablon.id_vendor
                      WHERE sablon.nota = '$nota'") or die (mysqli_error());
$r = mysqli_fetch_array($q);
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Detail Sablon / Bordir
    </h1>
    <ol class="breadcrumb">
      <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Sablon / Bordir</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Data Sablon / Bordir</h3>
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
			          		<td>Jatuh Tempo</td>
			          		<td><?= $r['jatuh_tempo'];?></td>
			          	</tr>
			          	<tr>
			          		<td>Nota SPK</td>
			          		<td><?= $r['nota_spk'];?></td>
			          	</tr>
			          	<tr>
			          		<td>Nota</td>
			          		<td><?= $r['nota'];?></td>
			          	</tr>
			          </table>
		          </div>
		          <div class="col-md-6">
			          <table class="table table-bordered">
			          	<tr>
			          		<td>Vendor</td>
			          		<td><?= $r['nm_vendor'];?></td>
			          	</tr>
			          	<tr>
			          		<td>Harga Vendor</td>
			          		<td><?= number_format($r['harga']);?></td>
			          	</tr>
			          	<tr>
			          		<td></td>
			          		<td><a class="btn btn-warning" target="blank" href="master/pg_sablon/print_sablon.php?id=<?= $_GET['nota'];?>"><i class="glyphicon glyphicon-print icon-white"></i> Print</a></td>
			          	</tr>
			          </table>
		          </div>
	          </div>
	          <hr>
	          <a href="?act=<?php echo md5('sablon_add_pengiriman')."&nota=$_GET[nota]"?>" class="btn btn-sm btn-primary"><i class="fa fa-pencil-square-o"></i> Balikan Sablon</a>
	          <a href="?act=<?php echo md5('sablon_add_pengiriman_bs')."&nota=$_GET[nota]"?>" class="btn btn-sm btn-danger"><i class="fa fa-pencil-square-o"></i> Tambah Reject</a>
	          <hr>
	          <div class="row">
		          <div class="col-md-12">
			          <table class="table table-bordered">
			          	<tr>
			          		<th rowspan="2" width="1">No</th>
			          		<th rowspan="2">Kode</th>
			          		<th colspan="2">Jumlah</th>
			          		<th colspan="2">Terkirim</th>
			          		<th colspan="2">Reject</th>
			          	</tr>
			          	<tr>
			          		<th width="100">Lusin</th>
			          		<th width="100">Pcs</th>
			          		<th width="100">Lusin</th>
			          		<th width="100">Pcs</th>
			          		<th width="100">Lusin</th>
			          		<th width="100">Pcs</th>
			          	</tr>
		              <?php
		              	$i = 0;
		                $q = mysqli_query($link,"SELECT 
		                      sablon_detail.id_sablon_detail, 
		                      sum(sablon_detail.jumlah) AS jumlah_sablon,
		                      sablon_detail.kd_produk_size, 
		                      produk.kd_produk, 
		                      produk.nm_produk 
		                      FROM 
		                      sablon_detail 
		                      Inner Join produk ON produk.kd_produk = sablon_detail.kd_produk
                      		WHERE 
                      		sablon_detail.nota = '$nota'
                      		GROUP BY sablon_detail.kd_produk
		                      ") or die (mysqli_error());

		                while ($r = mysqli_fetch_array($q)) {
		                	$i++;
		                	$rK = mysqli_fetch_array(mysqli_query($link,"SELECT 
		                								sum(sablon_pengiriman.jumlah) AS jumlah_kirim
		                								FROM
		                								sablon_pengiriman
		                    						Inner Join sablon_detail ON sablon_detail.id_sablon_detail = sablon_pengiriman.id_sablon_detail
		                								WHERE 
		                  							sablon_detail.nota = '$nota'
		                  							AND sablon_detail.kd_produk = '$r[kd_produk]'
		                								"));

		                	$rB = mysqli_fetch_array(mysqli_query($link,"SELECT 
		                								sum(sablon_pengiriman_bs.jumlah) AS jumlah_bs
		                								FROM
		                								sablon_pengiriman_bs
		                    						Inner Join sablon_detail ON sablon_detail.id_sablon_detail = sablon_pengiriman_bs.id_sablon_detail
		                								WHERE 
		                  							sablon_detail.nota = '$nota'
		                  							AND sablon_detail.kd_produk = '$r[kd_produk]'
		                								"));
		              ?>
					          	<tr>
					          		<th><?= $i;?></th>
					          		<th><?= $r['kd_produk'];?> - <?= $r['nm_produk'];?></th>
					          		<th><?= number_format(lusin($r['jumlah_sablon']));?></th>
					          		<th><?= number_format(pcs($r['jumlah_sablon']));?></th>
					          		<th><?= number_format(lusin($rK['jumlah_kirim']));?></th>
					          		<th><?= number_format(pcs($rK['jumlah_kirim']));?></th>
					          		<th><?= number_format(lusin($rB['jumlah_bs']));?></th>
					          		<th><?= number_format(pcs($rB['jumlah_bs']));?></th>
					          	</tr>
				              <?php
				                $qD = mysqli_query($link,"SELECT 
				                      sablon_detail.id_sablon_detail,
				                      sablon_detail.jumlah,
				                      sablon_detail.kd_produk_size
				                      FROM 
				                      sablon_detail 
		                      		WHERE 
		                      		sablon_detail.nota = '$nota'
		                      		AND sablon_detail.kd_produk = '$r[kd_produk]'
				                      ") or die (mysqli_error());
				                while ($rD = mysqli_fetch_array($qD)) {
				                	$id_sablon_detail = base64_encode($rD['id_sablon_detail']);

				                	$rKD = mysqli_fetch_array(mysqli_query($link,"SELECT 
	                								sum(sablon_pengiriman.jumlah) AS terkirim
	                								FROM
	                								sablon_pengiriman
	                								WHERE 
                    							sablon_pengiriman.id_sablon_detail = '$rD[id_sablon_detail]'
	                								"));

				                	$rBD = mysqli_fetch_array(mysqli_query($link,"SELECT 
	                								sum(sablon_pengiriman_bs.jumlah) AS bs
	                								FROM
	                								sablon_pengiriman_bs
	                								WHERE 
                    							sablon_pengiriman_bs.id_sablon_detail = '$rD[id_sablon_detail]'
	                								"));
				              ?>
							          	<tr>
							          		<td></td>
							          		<td><?= $rD['kd_produk_size'];?></td>
				          					<td><?= number_format(lusin($rD['jumlah']));?></td>
				          					<td><?= number_format(pcs($rD['jumlah']));?></td>
				          					<td><?= number_format(lusin($rKD['terkirim']));?></td>
				          					<td><?= number_format(pcs($rKD['terkirim']));?></td>
				          					<td><?= number_format(lusin($rBD['bs']));?></td>
				          					<td><?= number_format(pcs($rBD['bs']));?></td>
							          	</tr>
					        		<?php
						      			}
						    			?>
                      <tr>
                        <td colspan="9">
                          <div class="progress progress-xs">
                            <div class="progress-bar progress-bar-blue" style="width: 100%; height: 1px;"></div>
                          </div>
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