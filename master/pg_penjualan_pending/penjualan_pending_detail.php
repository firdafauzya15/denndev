<?php

$nota = base64_decode($_GET['nota']);
$q = mysqli_query($link,"SELECT 
                      penjualan.nota, 
                      penjualan.tanggal, 
                      penjualan.jatuh_tempo, 
                      penjualan.pajak, 
                      penjualan.diskon, 
                      penjualan.bayar, 
                      penjualan.id_toko, 
                      toko.nm_toko,
                      customer.nm_customer,
                      _metode.nm_metode
                      FROM 
                      penjualan 
                      Inner Join toko ON toko.id_toko = penjualan.id_toko 
                      Inner Join customer ON customer.id_customer = penjualan.id_customer 
                      Inner Join _metode ON _metode.id_metode = penjualan.id_metode 
                      WHERE penjualan.nota = '$nota'") or die (mysqli_error());
$rP = mysqli_fetch_array($q);

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Detail Penjualan Pending
    </h1>
    <ol class="breadcrumb">
      <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Penjualan Pending</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Data Penjualan Pending</h3>
          </div><!-- /.box-header -->
          <br>
          <div class="box-body">
	          <div class="row">
		          <div class="col-md-6">
			          <table class="table table-bordered">
			          	<tr>
			          		<td>Nota</td>
			          		<td><?= $rP['nota'];?></td>
			          	</tr>
                  <tr>
                    <td>Tanggal</td>
                    <td><?= $rP['tanggal'];?></td>
                  </tr>
                  <tr>
                    <td>Jatuh Tempo</td>
                    <td><?= $rP['jatuh_tempo'];?></td>
                  </tr>
			          	<tr>
			          		<td>Toko</td>
			          		<td><?= $rP['nm_toko'];?></td>
			          	</tr>
                  <tr>
                    <td>Customer</td>
                    <td><?= $rP['nm_customer'];?></td>
                  </tr>
                  <tr>
                    <td>Metode Pembayaran</td>
                    <td><?= $rP['nm_metode'];?></td>
                  </tr>
			          	<tr>
                    <td><a class="btn btn-success" href="?act=<?php echo md5('penjualan_pending_update')."&nota=$_GET[nota]"?>"  onclick="return confirm('Apakah anda yakin ingin melunasi transaksi ?')"><i class="glyphicon glyphicon-check icon-white"></i> Lunas</a></td>
			          		<td><a class="btn btn-warning" target="blank" href="master/pg_penjualan_pending/print_penjualan.php?id=<?= $_GET['nota'];?>"><i class="glyphicon glyphicon-print icon-white"></i> Print</a></td>
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
		                      penjualan_detail.jumlah, 
		                      produk_size.kd_produk_size, 
                          penjualan_detail.id_penjualan_detail, 
		                      penjualan_detail.harga_jual, 
		                      produk.nm_produk 
		                      FROM 
		                      penjualan_detail 
		                      INNER JOIN produk_size ON produk_size.kd_produk_size = penjualan_detail.kd_produk_size
      										INNER JOIN produk ON produk.kd_produk = produk_size.kd_produk
                     			WHERE penjualan_detail.nota = '$nota'
		                      ") or die (mysqli_error());
		                while ($r = mysqli_fetch_array($q)) {
		                	$i++;
                      $subtotal = (lusin($r['jumlah']) * $r['harga_jual']) + (pcs($r['jumlah']) * ($r['harga_jual']/12));
                      $total += $subtotal;
                      $id_penjualan_detail = base64_encode($r['id_penjualan_detail']);
                      $id_toko = base64_encode($rP['id_toko']);
		              ?>
					          	<tr>
                        <td><?= $i;?></td>
                        <td><?= $r['kd_produk_size'];?></td>
                        <td><?= $r['nm_produk'];?></td>
                        <td><?= number_format($r['harga_jual']);?></td>
                        <td><?= number_format(lusin($r['jumlah']));?></td>
                        <td><?= number_format(pcs($r['jumlah']));?></td>
					          		<td>
                            <?= number_format($subtotal);?> 
                            <?php
                            if ($_SESSION['id_level'] == '1') {
                            ?>
                              <a href="?act=<?php echo md5('penjualan_pending_delete_item')."&id_penjualan_detail=$id_penjualan_detail&id_toko=$id_toko"?>" class="btn btn-xs btn-danger" title="Hapus Item"  onclick="return confirm('Apakah anda yakin ?')"><i class="fa fa-trash"></i></a>
                            <?php
                            }
                            ?>
                        </td>
					          	</tr>
					        <?php
						      	}
						      	$pajak = ($total*$rP['pajak'])/100;
						      	$diskon = $rP['diskon'];
                    $grandtotal = $total + $pajak - $diskon + $rP['ongkir'];
						      	$kembalian = $rP['bayar']-$grandtotal; 
						      ?>
                    <tr>
                      <td colspan="5"></td>
                      <td>Total</td>
                      <td><?= number_format($total);?></td>
                    </tr>
                    <tr>
                      <td colspan="5"></td>
                      <td>Pajak (%)</td>
                      <td><?= number_format($pajak);?> (<?= number_format($rP['pajak']);?>)</td>
                    </tr>
                    <tr>
                      <td colspan="5"></td>
                      <td>Diskon (%)</td>
                      <td><?= number_format($diskon);?></td>
                    </tr>
                    <tr style="font-weight: bold;">
                      <td colspan="5"></td>
                      <td>Grand Total</td>
                      <td><?= number_format($grandtotal);?></td>
                    </tr>
			          </table>
			          <hr>
			          <a href="?act=<?php echo md5('penjualan_pending')?>" class="btn btn-danger"> Kembali</a>
		          </div>
	          </div>
          </div>
        </div><!-- /.box -->
      </div>
    </div><!-- /.row -->
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->