<?php
$nota = base64_decode($_GET['nota']);
$q = mysqli_query($link,"SELECT 
                      cmt.nm_cmt, 
                      produksi.id_produksi, 
                      produksi.tanggal, 
                      produksi.jatuh_tempo, 
                      produksi.nota_sablon, 
                      produksi.nota, 
                      produksi.uk_opp, 
                      produksi.notes, 
                      produksi.keterangan, 
                      produksi.harga,
					  produksi.harga_revisi
                      FROM 
                      produksi 
                      INNER JOIN cmt ON cmt.id_cmt = produksi.id_cmt
                      WHERE produksi.nota = '$nota'") or die (mysqli_error());
$r = mysqli_fetch_array($q);

$nota = $r['nota'];
$keterangan = $r['keterangan'];
$notes = $r['notes'];
$nota_sablon = $r['nota_sablon'];
$nota_sablon_enc = base64_encode($nota_sablon);
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Detail Produksi
    </h1>
    <ol class="breadcrumb">
      <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Produksi</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Data Produksi</h3>
          </div><!-- /.box-header -->
          <br>
          <div class="box-body">
	          <div class="row">
		          <div class="col-md-6">
			          <table class="table table-bordered">
			          	<tr>
			          		<td>Nota</td>
			          		<td colspan="2"><?= $r['nota'];?></td>
			          	</tr>
			          	<tr>
			          		<td>Tanggal</td>
			          		<td colspan="2"><?= $r['tanggal'];?></td>
			          	</tr>
			          	<tr>
			          		<td>Jatuh Tempo</td>
			          		<td colspan="2"><?= $r['jatuh_tempo'];?></td>
			          	</tr>
			          	<tr>
			          		<td>Keterangan</td>
			          		<td><?= $r['keterangan'];?></td>
							<td><a class="btn btn-primary btn-md" data-toggle="modal" data-href="#add" href="#add"><i class="fa fa-pencil"></i></a></td>
			          	</tr>
			          	<tr>
						  <td>Keterangan BS</td>
			          		<td><?= $r['notes'];?></td>
							  <td><a class="btn btn-primary btn-md" data-toggle="modal" data-href="#add2" href="#add2"><i class="fa fa-pencil"></i></a></td>
			          	</tr>
			          </table>
		          </div>
		          <div class="col-md-6">
			          <table class="table table-bordered">
			          	<tr>
			          		<td>CMT</td>
			          		<td colspan="2"><?= $r['nm_cmt'];?></td>
			          	</tr>
			          	<tr>
			          		<td>Harga CMT</td>
			          		<td colspan="2"><?= number_format($r['harga']);?></td>
			          	</tr>
						  <tr>
			          		<td>Penyesuaian Harga</td>
			          		<td ><?= number_format($r['harga_revisi']);?></td>
							  <td><a class="btn btn-primary btn-md" data-toggle="modal" data-href="#add3" href="#add3"><i class="fa fa-pencil"></i></a></td>
			          	</tr>
			          	<tr>
			          		<td></td>
			          		<td><a class="btn btn-warning" target="blank" href="master/pg_produksi/print_produksi.php?id=<?= $_GET['nota'];?>"><i class="glyphicon glyphicon-print icon-white"></i> Print</a></td>
			          	</tr>
			          </table>
		          </div>
	          </div>
	          <hr>
	          <a href="?act=<?php echo md5('produksi_add_pengiriman')."&nota=$_GET[nota]&nota_sablon=$nota_sablon_enc"?>" class="btn btn-sm btn-primary"><i class="fa fa-pencil-square-o"></i> Balikan CMT</a>
	          <a href="?act=<?php echo md5('produksi_add_pengiriman_bs')."&nota=$_GET[nota]&nota_sablon=$nota_sablon_enc"?>" class="btn btn-sm btn-danger"><i class="fa fa-pencil-square-o"></i> Tambah Reject</a>
	          <hr>
	          <div class="row">
		          <div class="col-md-12">
			          <table class="table table-bordered">
			          	<tr>
			          		<th rowspan="2" width="1">No</th>
			          		<th rowspan="2">Kode</th>
			          		<th colspan="2" width="200">Jumlah</th>
			          		<th colspan="2" width="200">Terkirim</th>
			          		<th colspan="2" width="1">Reject</th>
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
		                      produksi_detail.id_produksi_detail,
		                      produksi_detail.kd_produk_size, 
		                      produk.kd_produk, 
		                      produk.nm_produk 
		                      FROM 
		                      produksi_detail 
		                      INNER JOIN produk ON produk.kd_produk = produksi_detail.kd_produk
                      		WHERE 
                      		produksi_detail.nota = '$nota'
                      		GROUP BY produksi_detail.kd_produk
		                      ") or die (mysqli_error());

		                while ($r = mysqli_fetch_array($q)) {
		                	$i++;

		                	$rP = mysqli_fetch_array(mysqli_query($link,"SELECT 
	          								sum(produksi_detail.jumlah) AS jumlah_produksi
	          								FROM
	          								produksi_detail
	          								WHERE 
	            							produksi_detail.nota = '$nota'
		                  			AND produksi_detail.kd_produk = '$r[kd_produk]'
	          								GROUP BY produksi_detail.kd_produk 
	          								"));

			                $rK = mysqli_fetch_array(mysqli_query($link,"SELECT 
			                      sum(produksi_pengiriman.jumlah) AS jumlah_kirim
			                      FROM
			                      produksi_pengiriman
			                      INNER JOIN produksi_detail ON produksi_detail.id_produksi_detail = produksi_pengiriman.id_produksi_detail
			                      WHERE 
			                      produksi_detail.nota = '$nota'
		                  			AND produksi_detail.kd_produk = '$r[kd_produk]'
			                      "));

		                  $rB = mysqli_fetch_array(mysqli_query($link,"SELECT 
		                        sum(produksi_pengiriman_bs.jumlah) AS jumlah_bs
		                        FROM
		                        produksi_pengiriman_bs
		                        INNER JOIN produksi_detail ON produksi_detail.id_produksi_detail = produksi_pengiriman_bs.id_produksi_detail
		                        WHERE 
		                        produksi_detail.nota = '$nota'
		                  			AND produksi_detail.kd_produk = '$r[kd_produk]'
		                        "));

		              ?>
					          	<tr>
					          		<th><?= $i;?></th>
					          		<th><?= $r['kd_produk'];?> - <?= $r['nm_produk'];?></th>
					          		<th><?= number_format(lusin($rP['jumlah_produksi']));?></th>
					          		<th><?= number_format(pcs($rP['jumlah_produksi']));?></th>
					          		<th><?= number_format(lusin($rK['jumlah_kirim']));?></th>
					          		<th><?= number_format(pcs($rK['jumlah_kirim']));?></th>
					          		<th><?= number_format(lusin($rB['jumlah_bs']));?></th>
					          		<th><?= number_format(pcs($rB['jumlah_bs']));?></th>
					          	</tr>
				              <?php
				                $qD = mysqli_query($link,"SELECT 
				                      produksi_detail.id_produksi_detail,
				                      produksi_detail.jumlah,
				                      produksi_detail.kd_produk_size
				                      FROM 
				                      produksi_detail 
		                      		WHERE 
		                      		produksi_detail.nota = '$nota'
		                      		AND produksi_detail.kd_produk = '$r[kd_produk]'
				                      ") or die (mysqli_error());

				                while ($rD = mysqli_fetch_array($qD)) {
				                	$id_produksi_detail = base64_encode($rD['id_produksi_detail']);

				                	$rPD = mysqli_fetch_array(mysqli_query($link,"SELECT 
				          								sum(produksi_detail.jumlah) AS produksi
				          								FROM
				                      		produksi_detail 
				          								WHERE 
				            							produksi_detail.nota = '$nota'
		                      				AND produksi_detail.kd_produk_size = '$rD[kd_produk_size]'
				          								GROUP BY produksi_detail.kd_produk 
				          								"));

$rKD = mysqli_fetch_array(mysqli_query($link,"SELECT 
						                      sum(produksi_pengiriman.jumlah) AS terkirim
						                      FROM
						                      produksi_pengiriman
						                      INNER JOIN produksi_detail ON produksi_detail.id_produksi_detail = produksi_pengiriman.id_produksi_detail
						                      WHERE 
                    							produksi_pengiriman.id_produksi_detail = '$rD[id_produksi_detail]'
						                      "));

$rBD = mysqli_fetch_array(mysqli_query($link,"SELECT 
						                      sum(produksi_pengiriman_bs.jumlah) AS bs
						                      FROM
						                      produksi_pengiriman_bs
						                      INNER JOIN produksi_detail ON produksi_detail.id_produksi_detail = produksi_pengiriman_bs.id_produksi_detail
						                      WHERE 
                    							produksi_pengiriman_bs.id_produksi_detail = '$rD[id_produksi_detail]'
						                      "));
				              ?>
							          	<tr>
							          		<td></td>
							          		<td><?= $rD['kd_produk_size'];?></td>
				          					<td><?= number_format(lusin($rPD['produksi']));?></td>
				          					<td><?= number_format(pcs($rPD['produksi']));?></td>
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
					  <a class="btn btn-danger" href="?act=<?= md5('produksi')?>"> Kembali</a>
			          <!-- <a class="btn btn-danger" onclick="window.history.back()"> Kembali</a> -->
		          </div>
	          </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<div class="modal fade in display_none" id="add" tabindex="-1" role="dialog" aria-hidden="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title text-white">Edit Data</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <form action="home.php?act=<?php echo md5('produksi_update')?>&mode=keterangan" method="post" 
                            class="form-horizontal">
                            <input type="hidden" name="nota" value="<?= $nota;?>">
                            <div class="form-group row">
                                <div class="col-lg-2  text-lg-right">
                                    <label for="required2" class="col-form-label">Keterangan</label>
                                </div>
                                <div class="col-lg-4">
                                    <textarea name="keterangan" class="form-control"><?= $keterangan;?></textarea>
									<input type='hidden' name='notes' value=''>
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
<div class="modal fade in display_none" id="add2" tabindex="-1" role="dialog" aria-hidden="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title text-white">Edit Data</h4>
            </div>
			
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <form action="home.php?act=<?= md5('produksi_update')?>&mode=notes" method="post" 
                            class="form-horizontal">
                            <input type="hidden" name="nota" value="<?= $nota;?>">
                            <div class="form-group row">
                                <div class="col-lg-2  text-lg-right">
                                    <label for="required2" class="col-form-label">Keterangan BS</label>
                                </div>
                                <div class="col-lg-4">
                                    <textarea name="notes" class="form-control"><?= $notes;?></textarea>
									<input type='hidden' name='keterangan' value=''>
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
<div class="modal fade in display_none" id="add3" tabindex="-1" role="dialog" aria-hidden="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title text-white">Edit Data</h4>
            </div>
			
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <form action="home.php?act=<?= md5('produksi_update')?>&mode=harga" method="post" 
                            class="form-horizontal">
                            <input type="hidden" name="nota" value="<?= $nota;?>">
                            <div class="form-group row">
                                <div class="col-lg-2  text-lg-right">
                                    <label for="required2" class="col-form-label">Penyesuaian Harga</label>
                                </div>
                                <div class="col-lg-4">
									<input type="number" name="harga" class="form-control" value="<?= $r['harga_revisi']??'0'?>">
									<input type='hidden' name='keterangan' value=''>
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