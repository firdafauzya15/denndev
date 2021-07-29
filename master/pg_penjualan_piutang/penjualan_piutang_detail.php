<?php
$nota = base64_decode($_GET['nota']);
$q = mysqli_query($link,"SELECT 
                      penjualan.nota, 
                      penjualan.tanggal, 
                      penjualan.pajak, 
                      penjualan.diskon, 
                      penjualan.bayar, 
                      penjualan.id_toko, 
                      penjualan.status, 
                      toko.nm_toko
                      FROM 
                      penjualan 
                      Inner Join toko ON toko.id_toko = penjualan.id_toko 
                      WHERE penjualan.nota = '$nota'") or die (mysqli_error());
$rP = mysqli_fetch_array($q);
$nol = base64_encode("0");
$satu = base64_encode("1");
$status = "<span class='label label-warning'>Pending</span> <a href='?act=".md5('penjualan_piutang_update')."&nota=$_GET[nota]&lns=$satu' title='Lunasi Pembayaran $r[nota]' onclick='return confirm(\"Apakah anda yakin?\")' class='btn btn-xs btn-info'><i class='fa fa-refresh'></i></a>";
if ($rP['status'] == '1') {
  $status = "<span class='label label-success'>Done</span> <a href='?act=".md5('penjualan_piutang_update')."&nota=$_GET[nota]&lns=$nol' title='Batalkan Pelunasan $r[nota]' onclick='return confirm(\"Apakah anda yakin?\")' class='btn btn-xs btn-info'><i class='fa fa-refresh'></i></a>";
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Detail Piutang
    </h1>
    <ol class="breadcrumb">
      <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Piutang</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Data Piutang</h3>
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
                    <td>Status</td>
                    <td><?= $status;?></td>
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
		                      Inner Join produk_size ON produk_size.kd_produk_size = penjualan_detail.kd_produk_size
      										Inner Join produk ON produk.kd_produk = produk_size.kd_produk
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
					          		<td><?= number_format($subtotal);?></td>
					          	</tr>
					        <?php
						      	}
						      	$pajak = ($total*$rP['pajak'])/100;
						      	$diskon = ($total*$rP['diskon'])/100;
						      	$grandtotal = $total + $pajak - $diskon;
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
                      <td><?= number_format($diskon);?> (<?= number_format($rP['diskon']);?>)</td>
                    </tr>
                    <tr style="font-weight: bold;">
                      <td colspan="5"></td>
                      <td>Grand Total</td>
                      <td><?= number_format($grandtotal);?></td>
                    </tr>
			          </table>
			          <hr>
                <b><u>Daftar Pembayaran</u></b> <br><br>
                <form action="home.php?act=<?php echo md5('penjualan_piutang_insert')?>" method="post">
                  <input type="hidden" name="nota" value="<?= $nota;?>">
                  <div class="row">
                    <div class="col-sm-2">
                      <div class="input-group date">
                        <input type="text" name="tanggal" class="form-control pull-right" id="datepicker" required placeholder="Tanggal">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-2">
                      <input type="number" name="nominal" class="form-control" id="inputEmail3" required placeholder="nominal">
                    </div>
                    <div class="col-sm-2">
                      <select class="form-control select2" name="id_metode" required>
                        <?php
                          $q = mysqli_query($link,"SELECT * FROM _metode WHERE id_metode != '5' Order By nm_metode ASC");
                          while ($r = mysqli_fetch_array($q)) {
                            echo "<option value='$r[id_metode]'>$r[nm_metode]</option>";
                          }
                        ?>
                      </select>
                    </div>
                    <div class="col-sm-2">
                      <button type="submit" class="btn btn-primary" onclick="return confirm('Apakah anda yakin ?')">Simpan</button>
                    </div>
                  </div>
                </form>
                <br>
                <div class="row">
                  <div class="col-md-6">
                    <table class="table table-bordered">
                      <tr>
                        <th width="1">No.</th>
                        <th>Tanggal</th>
                        <th>Nominal</th>
                        <th>metode</th>
                      </tr>
                      <?php
                      $i = 0;
                      $totalNominal = 0;
                      $penjualanPiutangs = mysqli_query($link,"SELECT * FROM penjualan_piutang WHERE nota = '$nota'") or die (mysqli_error());
                      while ($penjualanPiutang = mysqli_fetch_array($penjualanPiutangs)) { 
                        $metode = mysqli_fetch_array(mysqli_query($link,"SELECT * FROM _metode WHERE id_metode = '$penjualanPiutang[id_metode]'"));
                        $i++;
                        $totalNominal += $penjualanPiutang['nominal'];
                      ?>
                        <tr>
                          <td><?= $i;?></td>
                          <td><?= $penjualanPiutang['tanggal'];?></td>
                          <td><?= number_format($penjualanPiutang['nominal']);?></td>
                          <td><?= $metode['nm_metode'];?></td>
                        </tr>
                      <?php
                      }
                      ?>
                      <tr>
                        <th colspan="2" class="text-right">Total</th>
                        <th><?= number_format($totalNominal);?></th>
                        <th></th>
                      </tr>
                    </table>
                  </div>
                </div>
                <hr>
			          <a href="?act=<?php echo md5('penjualan')?>" class="btn btn-danger"> Kembali</a>
		          </div>
	          </div>
          </div>
        </div><!-- /.box -->
      </div>
    </div><!-- /.row -->
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->