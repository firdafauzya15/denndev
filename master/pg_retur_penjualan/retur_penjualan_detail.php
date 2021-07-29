<?php

$nota = base64_decode($_GET['nota']);
$q = mysqli_query($link,"SELECT 
                      toko.nm_toko, 
                      customer.nm_customer, 
                      retur_penjualan.nota, 
                      retur_penjualan.id_toko, 
                      retur_penjualan.tanggal
                      FROM 
                      retur_penjualan 
                      Inner Join toko ON toko.id_toko = retur_penjualan.id_toko 
                      Inner Join customer ON customer.id_customer = retur_penjualan.id_customer 
                      WHERE retur_penjualan.nota = '$nota'") or die (mysqli_error());
$r = mysqli_fetch_array($q);

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Detail Retur Penjualan
    </h1>
    <ol class="breadcrumb">
      <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Retur Penjualan</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Data Retur Penjualan</h3>
          </div><!-- /.box-header -->
          <br>
          <div class="box-body">
	          <div class="row">
		          <div class="col-md-6">
			          <table class="table table-bordered">
			          	<tr>
			          		<td>Nota</td>
			          		<td><?= $r['nota'];?></td>
			          	</tr>
			          	<tr>
			          		<td>Toko</td>
			          		<td><?= $r['nm_toko'];?></td>
			          	</tr>
			          	<tr>
			          		<td>Customer</td>
			          		<td><?= $r['nm_customer'];?></td>
			          	</tr>
			          	<tr>
			          		<td>Tanggal</td>
			          		<td><?= $r['tanggal'];?></td>
			          	</tr>
			          	<tr>
			          		<td></td>
			          		<td><a class="btn btn-warning" target="blank" href="master/pg_retur_penjualan/print_retur_penjualan.php?id=<?= $_GET['nota'];?>"><i class="glyphicon glyphicon-print icon-white"></i> Print</a></td>
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
			          		<td>Harga</td>
			          		<td>Lusin</td>
			          		<td>Pcs</td>
			          		<td>Sub Total</td>
			          	</tr>
		              <?php
		                $i = 0;
		                $total = 0;
		                $q = mysqli_query($link,"SELECT 
		                      retur_penjualan_detail.jumlah, 
		                      produk_size.kd_produk_size, 
                          retur_penjualan_detail.id_retur_penjualan_detail, 
		                      retur_penjualan_detail.harga_jual, 
		                      produk.nm_produk 
		                      FROM 
		                      retur_penjualan_detail 
		                      Inner Join produk_size ON produk_size.kd_produk_size = retur_penjualan_detail.kd_produk_size
      										Inner Join produk ON produk.kd_produk = produk_size.kd_produk
                     			WHERE retur_penjualan_detail.nota = '$nota'
		                      ") or die (mysqli_error());
		                while ($r = mysqli_fetch_array($q)) {
		                	$i++;
                      		$subtotal = (lusin($r['jumlah']) * $r['harga_jual']) + (pcs($r['jumlah']) * ($r['harga_jual']/12));
		                	$total += $subtotal;
		              ?>
					          	<tr>
					          		<td><?= $i;?></td>
					          		<td><?= $r['kd_produk_size'];?></td>
					          		<td><?= $r['nm_produk'];?></td>
					          		<td><?= number_format($r['harga_jual']);?></td>
					          		<td><?= number_format(lusin($r['jumlah']));?></td>
					          		<td><?= number_format(pcs($r['jumlah']));?></td>
					          		<td><?= number_format($subtotal);?></td>
					          	</tr>
					        <?php
						      	}
						      ?>
                    <tr>
                      <td colspan="5"></td>
                      <td>Total</td>
                      <td><?= number_format($total);?></td>
                    </tr>
			          </table>
			          <hr>
			          <a href="?act=<?php echo md5('retur_penjualan')?>" class="btn btn-danger"> Kembali</a>
		          </div>
	          </div>
          </div>
        </div><!-- /.box -->
      </div>
    </div><!-- /.row -->
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->