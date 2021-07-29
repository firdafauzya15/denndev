<?php

$nota = base64_decode($_GET['nota']);
$q = mysqli_query($link,"SELECT 
                      penjualan.id_penjualan, 
                      penjualan.nota, 
                      penjualan.tanggal, 
                      penjualan.pajak, 
                      penjualan.diskon, 
                      penjualan.ongkir, 
                      penjualan.bayar,  
                      penjualan.status, 
                      penjualan.nm_pengirim, 
                      penjualan.bank, 
                      penjualan.total_transfer, 
                      penjualan.no_resi, 
                      penjualan.id_toko, 
                      toko.nm_toko
                      customer.nm_customer
                      FROM 
                      penjualan 
                      Inner Join toko ON toko.id_toko = penjualan.id_toko 
                      Inner Join customer ON customer.id_customer = penjualan.id_customer 
                      WHERE penjualan.nota = '$nota'") or die (mysqli_error());
$rP = mysqli_fetch_array($q);

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Detail Penjualan (Online)
    </h1>
    <ol class="breadcrumb">
      <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Penjualan (Online)</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Data Penjualan</h3>
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
			          		<td>Toko</td>
			          		<td><?= $rP['nm_toko'];?></td>
			          	</tr>
                  <tr>
                    <td>Customer</td>
                    <td><?= $rP['nm_customer'];?></td>
                  </tr>
			          	<tr>   
			          		<td><a class="btn btn-warning" target="blank" href="master/pg_penjualan_online/print_penjualan.php?id=<?= $_GET['nota'];?>"><i class="glyphicon glyphicon-print icon-white"></i> Print</a></td>
			          	</tr>
			          </table>
		          </div>
              <div class="col-md-6">
                <form action="home.php?act=<?php echo md5('penjualan_online_update_pengiriman')?>" method="post" class="form-horizontal">
                  <input type="hidden" name="nota" value="<?= $nota;?>">
                  <table class="table table-bordered">
                    <tr>
                      <td>Nama Pengirim</td>
                      <td><input type="text" name="nm_pengirim" class="form-control" id="inputEmail3" <?php if ($rP['status'] != '0') { echo"readonly"; }?> value="<?= $rP['nm_pengirim'];?>"></td>
                    </tr>
                    <tr>
                      <td>Bank</td>
                      <td><input type="text" name="bank" class="form-control" id="inputEmail3" <?php if ($rP['status'] != '0') { echo"readonly"; }?> value="<?= $rP['bank'];?>"></td>
                    </tr>
                    <tr>
                      <td>Jumlah Transfer</td>
                      <td><input type="text" name="total_transfer" class="form-control" id="inputEmail3" <?php if ($rP['status'] != '0') { echo"readonly"; }?> value="<?= $rP['total_transfer'];?>"></td>
                    </tr>
                  </table>
                  <table class="table table-bordered">
                    <tr>
                      <td>No Resi</td>
                      <td><input type="text" name="no_resi" class="form-control" id="inputEmail3" <?php if ($rP['status'] != '1') { echo"readonly"; }?> value="<?= $rP['no_resi'];?>"></td>
                    </tr>
                  </table>
                  <table class="table table-bordered">
                    <tr>
                      <td>Status</td>
                      <td>
                        <div class="radio">
                          <label>
                            <input type="radio" name="status" id="0" value="0" <?php if ($rP['status'] == '0') { echo"checked"; }?>>
                            Menunggu Pembayaran
                          </label>
                        </div>
                        <div class="radio">
                          <label>
                            <input type="radio" name="status" id="1" value="1" <?php if ($rP['status'] == '1') { echo"checked"; }?>>
                            Dalam Persiapan
                          </label>
                        </div>
                        <div class="radio">
                          <label>
                            <input type="radio" name="status" id="2" value="2" <?php if ($rP['status'] == '2') { echo"checked"; }?>>
                            Selesai
                          </label>
                        </div>
                        <div class="radio">
                          <label>
                            <input type="radio" name="status" id="3" value="3" <?php if ($rP['status'] == '3') { echo"checked"; }?>>
                            Dibatalkan
                          </label>
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-primary" onclick="return confirm('Apakah anda yakin ?')">Simpan</button>
                      </td>
                    </tr>
                  </table>
                </form>
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
			          		<td>QTY</td>
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
		                      penjualan_detail.harga_jual*penjualan_detail.jumlah AS subtotal,
		                      produk.nm_produk 
		                      FROM 
		                      penjualan_detail 
		                      INNER JOIN produk_size ON produk_size.kd_produk_size = penjualan_detail.kd_produk_size
      										INNER JOIN produk ON produk.kd_produk = produk_size.kd_produk
                     			WHERE penjualan_detail.nota = '$nota'
		                      ") or die (mysqli_error());
		                while ($r = mysqli_fetch_array($q)) {
		                	$i++;
		                	$total += $r['subtotal'];
                      $id_penjualan_detail = base64_encode($r['id_penjualan_detail']);
                      $id_toko = base64_encode($rP['id_toko']);
		              ?>
					          	<tr>
					          		<td><?= $i;?></td>
					          		<td><?= $r['kd_produk_size'];?></td>
					          		<td><?= $r['nm_produk'];?></td>
					          		<td><?= number_format($r['harga_jual']);?></td>
					          		<td><?= number_format($r['jumlah']);?></td>
                        <td>
                            <?= number_format($r['subtotal']);?> 
                            <?php
                            if ($_SESSION['id_level'] == '1') {
                            ?>
                              <a href="?act=<?php echo md5('penjualan_online_delete_item')."&id_penjualan_detail=$id_penjualan_detail&id_toko=$id_toko"?>" class="btn btn-xs btn-danger" title="Hapus Item"  onclick="return confirm('Apakah anda yakin ?')"><i class="fa fa-trash"></i></a>
                            <?php
                            }
                            ?>
                        </td>
					          	</tr>
					        <?php
						      	}
						      	$pajak = ($total*$rP['pajak'])/100;
						      	$diskon = ($total*$rP['diskon'])/100;
						      	$grandtotal = $total + $pajak - $diskon + $rP['ongkir'];
						      	$kembalian = $rP['bayar']-$grandtotal; 
						      ?>
                    <tr>
                      <td colspan="4"></td>
                      <td>Total</td>
                      <td><?= number_format($total);?></td>
                    </tr>
                    <tr>
                      <td colspan="4"></td>
                      <td>Pajak (%)</td>
                      <td><?= number_format($pajak);?> (<?= number_format($rP['pajak']);?>)</td>
                    </tr>
                    <tr>
                      <td colspan="4"></td>
                      <td>Diskon (%)</td>
                      <td><?= number_format($diskon);?> (<?= number_format($rP['diskon']);?>)</td>
                    </tr>
                    <tr>
                      <td colspan="4"></td>
                      <td>Ongkir</td>
                      <td><?= number_format($rP['ongkir']);?></td>
                    </tr>
                    <tr style="font-weight: bold;">
                      <td colspan="4"></td>
                      <td>Grand Total</td>
                      <td><?= number_format($grandtotal);?></td>
                    </tr>
                    <tr>
                      <td colspan="4"></td>
                      <td>Bayar</td>
                      <td><?= number_format($rP['bayar']);?></td>
                    </tr>
                    <tr style="font-weight: bold;">
                      <td colspan="4"></td>
                      <td>Kembalian</td>
                      <td><?= number_format($kembalian);?></td>
                    </tr>
			          </table>
			          <hr>
			          <a href="?act=<?php echo md5('penjualan_online')?>" class="btn btn-danger"> Kembali</a>
		          </div>
	          </div>
          </div>
        </div><!-- /.box -->
      </div>
    </div><!-- /.row -->
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->