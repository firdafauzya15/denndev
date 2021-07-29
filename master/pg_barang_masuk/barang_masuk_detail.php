<?php
include "master/function/nota.php";
$id_barang_masuk = base64_decode($_GET['id_barang_masuk']);
$q = mysqli_query($link,"SELECT 
                      barang_masuk.id_barang_masuk, 
                      barang_masuk.tanggal
                      FROM 
                      barang_masuk 
                      WHERE barang_masuk.id_barang_masuk = '$id_barang_masuk'") or die (mysqli_error());
$r = mysqli_fetch_array($q);
$nota = notaBarangMasuk($r['id_barang_masuk']);
?>

<div class="content-wrapper">
<?
 	$bc[] = array('title' => 'Barang Masuk', 'url' => 'home.php?act='.md5('barang_masuk'), 'active' => '0');
	$bc[] = array('title' => 'Barang Masuk Detail', 'url' => '#', 'active' => '1');
	echo $lib->breadcrumbs("Data Barang Masuk",$bc);
?>

  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Data Barang Masuk</h3>
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
		                      barang_masuk_detail.jumlah, 
		                      produk_size.kd_produk_size, 
		                      produk.nm_produk 
		                      FROM 
		                      barang_masuk_detail 
		                      Inner Join produk_size ON produk_size.kd_produk_size = barang_masuk_detail.kd_produk_size
		                      Inner Join produk ON produk.kd_produk = produk_size.kd_produk
                      		  WHERE barang_masuk_detail.id_barang_masuk = '$id_barang_masuk'
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
        </div>
      </div>
    </div>
  </section>
</div>