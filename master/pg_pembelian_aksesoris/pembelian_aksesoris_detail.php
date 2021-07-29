<?php
$id_pembelian_aksesoris = base64_decode($_GET['id_pembelian_aksesoris']);
$q = mysqli_query($link,"SELECT 
                      pembelian_aksesoris.id_pembelian_aksesoris, 
                      pembelian_aksesoris.tanggal, 
                      supplier_aksesoris.nm_supplier_aksesoris
                      FROM 
                      pembelian_aksesoris 
                      Inner Join supplier_aksesoris ON supplier_aksesoris.id_supplier_aksesoris = pembelian_aksesoris.id_supplier_aksesoris 
                      WHERE pembelian_aksesoris.id_pembelian_aksesoris = '$id_pembelian_aksesoris'") or die (mysqli_error());
$r = mysqli_fetch_array($q);
?>
<div class="content-wrapper">
<?
 	$bc[] = array('title' => 'Pembelian Aksesoris', 'url' => 'home.php?act='.md5('pembelian_aksesoris'), 'active' => '0');
	$bc[] = array('title' => 'Pembelian Aksesoris Detail', 'url' => '#', 'active' => '1');
	echo $lib->breadcrumbs("Data Pembelian Aksesoris",$bc);
?>

  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-info">
          <div class="box-header with-border"><h3 class="box-title">Data Pembelian aksesoris</h3></div><br>
          <div class="box-body table-responsive">
	          <div class="row">
		          <div class="col-md-6">
			          <table class="table table-bordered">
			          	<tr>
			          		<td>Tanggal</td>
			          		<td><?= $r['tanggal'];?></td>
			          	</tr>
			          	<tr>
			          		<td>Supplier aksesoris</td>
			          		<td><?= $r['nm_supplier_aksesoris'];?></td>
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
							<td>Satuan</td>
			          		<td>Harga</td>
			          		<td>Total</td>
			          	</tr>
		              <?php
		                $i = 0;
		                $grandtotal = 0;
		                $q = mysqli_query($link,"SELECT 
		                      pembelian_aksesoris_detail.jumlah,
							  pembelian_aksesoris_detail.uom, 
		                      pembelian_aksesoris_detail.harga,
		                      (pembelian_aksesoris_detail.jumlah*pembelian_aksesoris_detail.harga) AS sub_total, 
		                      aksesoris.kd_aksesoris, 
		                      aksesoris.nm_aksesoris
		                      FROM 
		                      pembelian_aksesoris_detail 
		                      Inner Join aksesoris ON aksesoris.kd_aksesoris = pembelian_aksesoris_detail.kd_aksesoris
                      		WHERE pembelian_aksesoris_detail.id_pembelian_aksesoris = '$id_pembelian_aksesoris'
		                      ") or die (mysqli_error());
		                while ($r = mysqli_fetch_array($q)) {
		                	$i++;
		                	$grandtotal += $r['sub_total'];
		              ?>
					          	<tr>
					          		<td><?= $i;?></td>
					          		<td><?= $r['kd_aksesoris'];?></td>
					          		<td><?= $r['nm_aksesoris'];?></td>
					          		<td><?= $r['jumlah'];?></td>
									<td><?= $r['uom'];?></td>
					          		<td><?= number_format($r['harga']);?></td>
					          		<td><?= number_format($r['sub_total']);?></td>
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
        </div><!-- /.box -->
      </div>
    </div><!-- /.row -->
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->