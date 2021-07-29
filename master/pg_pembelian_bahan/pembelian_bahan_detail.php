<?php
include "master/function/nota.php";
$id_pembelian_bahan = base64_decode($_GET['id_pembelian_bahan']);
$q = mysqli_query($link,"SELECT 
                      pembelian_bahan.id_pembelian_bahan, 
                      pembelian_bahan.tanggal, 
                      pembelian_bahan.jatuh_tempo, 
                      pembelian_bahan.keterangan, 
                      supplier_bahan.nm_supplier_bahan
                      FROM 
                      pembelian_bahan 
                      INNER JOIN supplier_bahan ON supplier_bahan.id_supplier_bahan = pembelian_bahan.id_supplier_bahan 
                      WHERE pembelian_bahan.id_pembelian_bahan = '$id_pembelian_bahan'") or die (mysqli_error());
$r = mysqli_fetch_array($q);
$nota = notaPembelianBahan($r['id_pembelian_bahan']);
?>
<div class="modal fade in display_none" id="edit" tabindex="-1" role="dialog" aria-hidden="false">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title text-white">Edit Data</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <form action="home.php?act=<?php echo md5('pembelian_bahan_update')?>" method="post" 
                            class="form-horizontal">
                            <input type="hidden" name="id_pembelian_bahan" value="<?= $id_pembelian_bahan;?>">
                            <div class="form-group row">
                                <div class="col-lg-2  text-lg-right">
                                    <label for="required2" class="col-form-label">Keterangan</label>
                                </div>
                                <div class="col-lg-6">
                                	<textarea name="keterangan" class="form-control"><?= $r['keterangan'];?></textarea>
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

<div class="content-wrapper">
  <?
 	$bc[] = array('title' => 'Pembelian Bahan', 'url' => 'home.php?act='.md5('pembelian_bahan'), 'active' => '0');
	$bc[] = array('title' => 'Pembelian Bahan Detail', 'url' => '#', 'active' => '1');
	echo $lib->breadcrumbs("Data Pembelian Bahan",$bc);
?>

  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Data Pembelian Bahan</h3>
          </div>
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
			          	<tr>
			          		<td>Keterangan</td>
			          		<td><?= $r['keterangan'];?> &nbsp; <a class="btn btn-info btn-xs" data-toggle="modal" data-href="#edit" href="#edit" title="edit"><i class="fa fa-pencil"></i></a></td>
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
			          		<td>Harga</td>
			          		<td>Total</td>
			          	</tr>
		              <?php
		                $i = 0;
		                $grandtotal = 0;
		                $q = mysqli_query($link,"SELECT 
		                      pembelian_bahan_detail.jumlah, 
		                      pembelian_bahan_detail.harga,
		                      (pembelian_bahan_detail.jumlah*pembelian_bahan_detail.harga) AS sub_total, 
		                      bahan.kd_bahan, 
		                      bahan.nm_bahan
		                      FROM 
		                      pembelian_bahan_detail 
		                      Inner Join bahan ON bahan.kd_bahan = pembelian_bahan_detail.kd_bahan
                      		WHERE pembelian_bahan_detail.id_pembelian_bahan = '$id_pembelian_bahan'
		                      ") or die (mysqli_error());
		                while ($r = mysqli_fetch_array($q)) {
		                	$i++;
		                	$grandtotal += round($r['sub_total'],0);
		              ?>
					          	<tr>
					          		<td><?= $i;?></td>
					          		<td><?= $r['kd_bahan'];?></td>
					          		<td><?= $r['nm_bahan'];?></td>
					          		<td><?= $r['jumlah'];?></td>
					          		<td><?= number_format($r['harga']);?></td>
					          		<td><?= number_format(round($r['sub_total'],0));?></td>
					          	</tr>
					        <?php
						      	}
						      ?>
						      <tr style="font-weight: bold;">
						      	<td colspan="5"></td>
					          <td><?= number_format($grandtotal);?></td>
						      </tr>
			          </table>
			          <hr>
			          <a class="btn btn-danger" onclick="window.history.back()"> Kembali</a>
		          </div>
	          </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>