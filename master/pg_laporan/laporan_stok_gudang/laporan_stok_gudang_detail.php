<?php
include "master/function/nota.php";
$id = base64_decode($_GET['id_stok_gudang']);
$q = mysqli_query($link,"SELECT 
                      stok_gudang.id_stok_gudang,
                      stok_gudang.kd_produk_size,
                      stok_gudang.jumlah,
                      produk_size.kd_produk,
                      produk.nm_produk
                      FROM 
                      stok_gudang 
                      Inner Join produk_size ON produk_size.kd_produk_size = stok_gudang.kd_produk_size
                      Inner Join produk ON produk.kd_produk = produk_size.kd_produk
                      WHERE 
                      stok_gudang.id_stok_gudang = '$id'
                      ") or die (mysqli_error());
$rP = mysqli_fetch_array($q);
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Detail Stok Gudang 
    </h1>
    <ol class="breadcrumb">
      <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Stok Gudang </li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Data Stok Gudang</h3>
          </div><!-- /.box-header -->
          <br>
          <div class="box-body">
	          <div class="row">
		          <div class="col-md-6">
			          <table class="table table-bordered">
			          	<tr>
			          		<td>Produk</td>
			          		<td><?= $rP['kd_produk_size'];?> - <?= $rP['nm_produk'];?></td>
			          	</tr>
                  <tr>
                    <td>Lusin</td>
                    <td><?= lusin($rP['jumlah']);?></td>
                  </tr>
                  <tr>
                    <td>Pcs</td>
                    <td><?= pcs($rP['jumlah']);?></td>
                  </tr>
			          </table>
		          </div>
	          </div>
	          <hr>
	          <div class="row">
		          <div class="col-md-6">
                <h3>Pengiriman CMT</h3>
			          <table class="table table-bordered">
			          	<tr>
                    <td>Tanggal</td>
			          		<td>CMT</td>
                    <td>Lusin</td>
			          		<td>Pcs</td>
			          	</tr>
		              <?php
		                $i = 0;
		                $totalPengiriman = 0;
		                $qPengiriman = mysqli_query($link,"SELECT 
                          cmt.nm_cmt, 
                          produksi_pengiriman.tanggal, 
		                      sum(produksi_pengiriman.jumlah) AS jumlah
		                      FROM 
		                      produksi_pengiriman 
                          Inner Join sablon_detail ON sablon_detail.id_sablon_detail = produksi_pengiriman.id_sablon_detail
                          Inner Join produksi ON produksi.nota_sablon = sablon_detail.nota
		                      Inner Join cmt ON cmt.id_cmt = produksi.id_cmt
                     			WHERE 
                          sablon_detail.kd_produk_size = '$rP[kd_produk_size]'
                          GROUP BY produksi_pengiriman.tanggal
		                      ") or die (mysqli_error());
		                while ($rPengiriman = mysqli_fetch_array($qPengiriman)) {
                      $totalPengiriman += $rPengiriman['jumlah'];
		              ?>
					          	<tr>
                        <td><?= $rPengiriman['tanggal'];?></td>
					          		<td><?= $rPengiriman['nm_cmt'];?></td>
                        <td><?= number_format(lusin($rPengiriman['jumlah']));?></td>
					          		<td><?= number_format(pcs($rPengiriman['jumlah']));?></td>
					          	</tr>
					        <?php
						      	}
						      ?>
                  <tr>
                    <td colspan="2"><b>Total</b></td>
                    <td><b><?= number_format(lusin($totalPengiriman));?></b></td>
                    <td><b><?= number_format(pcs($totalPengiriman));?></b></td>
                  </tr>
			          </table>
		          </div>
              <div class="col-md-6">
                <h3>Barang Masuk</h3>
                <table class="table table-bordered">
                  <tr>
                    <td>Tanggal</td>
                    <td>Nota</td>
                    <td>Lusin</td>
                    <td>Pcs</td>
                  </tr>
                  <?php
                    $totalBarangMasuk = 0;
                    $qBarangMasuk = mysqli_query($link,"SELECT 
                          barang_masuk.tanggal, 
                          barang_masuk.id_barang_masuk, 
                          sum(barang_masuk_detail.jumlah) AS jumlah
                          FROM 
                          barang_masuk_detail 
                          Inner Join barang_masuk ON barang_masuk.id_barang_masuk = barang_masuk_detail.id_barang_masuk
                          WHERE 
                          barang_masuk_detail.kd_produk_size = '$rP[kd_produk_size]'
                          GROUP BY barang_masuk.tanggal, barang_masuk.id_barang_masuk 
                          ") or die (mysqli_error());
                    while ($rBarangMasuk = mysqli_fetch_array($qBarangMasuk)) {
                      $totalBarangMasuk += $rBarangMasuk['jumlah'];
                      $nota = notaBarangMasuk($rBarangMasuk['id_barang_masuk']);
                  ?>
                      <tr>
                        <td><?= $rBarangMasuk['tanggal'];?></td>
                        <td><?= $nota;?></td>
                        <td><?= lusin($rBarangMasuk['jumlah']);?></td>
                        <td><?= pcs($rBarangMasuk['jumlah']);?></td>
                      </tr>
                  <?php
                    }
                  ?>
                  <tr>
                    <td colspan="2"><b>Total</b></td>
                    <td><b><?= number_format(lusin($totalBarangMasuk));?></b></td>
                    <td><b><?= number_format(pcs($totalBarangMasuk));?></b></td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <h3>Surat Jalan</h3>
                <table class="table table-bordered">
                  <tr>
                    <td>Tanggal</td>
                    <td>Nota</td>
                    <td>Toko</td>
                    <td>Lusin</td>
                    <td>Pcs</td>
                  </tr>
                  <?php
                    $totalSuratJalan = 0;
                    $qSuratJalan = mysqli_query($link,"SELECT 
                          toko.nm_toko, 
                          surat_jalan.tanggal, 
                          surat_jalan.id_surat_jalan, 
                          sum(surat_jalan_detail.jumlah) AS jumlah
                          FROM 
                          surat_jalan_detail 
                          Inner Join surat_jalan ON surat_jalan.id_surat_jalan = surat_jalan_detail.id_surat_jalan
                          Inner Join toko ON toko.id_toko = surat_jalan.id_toko
                          WHERE 
                          surat_jalan_detail.kd_produk_size = '$rP[kd_produk_size]'
                          GROUP BY surat_jalan.tanggal, surat_jalan.id_surat_jalan
                          ") or die (mysqli_error());
                    while ($rSuratJalan = mysqli_fetch_array($qSuratJalan)) {
                      $totalSuratJalan += $rSuratJalan['jumlah'];
                      $nota = notaSuratJalan($rSuratJalan['id_surat_jalan']);
                  ?>
                      <tr>
                        <td><?= $rSuratJalan['tanggal'];?></td>
                        <td><?= $nota;?></td>
                        <td><?= $rSuratJalan['nm_toko'];?></td>
                        <td><?= lusin($rSuratJalan['jumlah']);?></td>
                        <td><?= pcs($rSuratJalan['jumlah']);?></td>
                      </tr>
                  <?php
                    }
                  ?>
                  <tr>
                    <td colspan="3"><b>Total</b></td>
                    <td><b><?= number_format(lusin($totalSuratJalan));?></b></td>
                    <td><b><?= number_format(pcs($totalSuratJalan));?></b></td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
        </div><!-- /.box -->
      </div>
    </div><!-- /.row -->
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->