<?php
include "master/function/nota.php";
$id = base64_decode($_GET['id_stok']);
$q = mysqli_query($link,"SELECT 
                      toko.nm_toko,
                      stok.id_stok,
                      stok.id_toko,
                      stok.kd_produk_size,
                      stok.jumlah,
                      produk_size.kd_produk,
                      produk.nm_produk
                      FROM 
                      stok 
                      Inner Join toko ON toko.id_toko = stok.id_toko
                      Inner Join produk_size ON produk_size.kd_produk_size = stok.kd_produk_size
                      Inner Join produk ON produk.kd_produk = produk_size.kd_produk
                      WHERE 
                      stok.id_stok = '$id'
                      ") or die (mysqli_error());
$rP = mysqli_fetch_array($q);
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Detail Stok 
    </h1>
    <ol class="breadcrumb">
      <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Stok </li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Data Stok</h3>
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
                    <td>Toko</td>
                    <td><?= $rP['nm_toko'];?></td>
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
                          AND surat_jalan.id_toko = '$rP[id_toko]'
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
              <div class="col-md-6">
                <h3>Surat Jalan antar Toko</h3>
                <table class="table table-bordered">
                  <tr>
                    <td>Tanggal</td>
                    <td>Nota</td>
                    <td>Toko</td>
                    <td>Lusin</td>
                    <td>Pcs</td>
                  </tr>
                  <?php
                    $totalSuratJalanToko = 0;
                    $qSuratJalanToko = mysqli_query($link,"SELECT 
                          toko.nm_toko, 
                          surat_jalan_toko.tanggal, 
                          surat_jalan_toko.id_surat_jalan_toko, 
                          sum(surat_jalan_toko_detail.jumlah) AS jumlah
                          FROM 
                          surat_jalan_toko_detail 
                          Inner Join surat_jalan_toko ON surat_jalan_toko.id_surat_jalan_toko = surat_jalan_toko_detail.id_surat_jalan_toko
                          Inner Join toko ON toko.id_toko = surat_jalan_toko.id_toko
                          WHERE 
                          surat_jalan_toko_detail.kd_produk_size = '$rP[kd_produk_size]'
                          AND surat_jalan_toko.id_toko = '$rP[id_toko]'
                          GROUP BY surat_jalan_toko.tanggal, surat_jalan_toko.id_surat_jalan_toko
                          ") or die (mysqli_error());
                    while ($rSuratJalanToko = mysqli_fetch_array($qSuratJalanToko)) {
                      $totalSuratJalanToko += $rSuratJalanToko['jumlah'];
                      $nota = notaSuratJalan($rSuratJalan['id_surat_jalan_toko']);
                  ?>
                      <tr>
                        <td><?= $rSuratJalanToko['tanggal'];?></td>
                        <td><?= $nota;?></td>
                        <td><?= $rSuratJalanToko['nm_toko'];?></td>
                        <td><?= lusin($rSuratJalanToko['jumlah']);?></td>
                        <td><?= pcs($rSuratJalanToko['jumlah']);?></td>
                      </tr>
                  <?php
                    }
                  ?>
                  <tr>
                    <td colspan="3"><b>Total</b></td>
                    <td><b><?= number_format(lusin($totalSuratJalanToko));?></b></td>
                    <td><b><?= number_format(pcs($totalSuratJalanToko));?></b></td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <h3>Penjualan</h3>
                <table class="table table-bordered">
                  <tr>
                    <td>Tanggal</td>
                    <td>Nota</td>
                    <td>Toko</td>
                    <td>Lusin</td>
                    <td>Pcs</td>
                  </tr>
                  <?php
                    $totalPenjualan = 0;
                    $qPenjualan = mysqli_query($link,"SELECT 
                          toko.nm_toko, 
                          penjualan.tanggal, 
                          penjualan.nota, 
                          sum(penjualan_detail.jumlah) AS jumlah
                          FROM 
                          penjualan_detail 
                          Inner Join penjualan ON penjualan.nota = penjualan_detail.nota
                          Inner Join toko ON toko.id_toko = penjualan.id_toko
                          WHERE 
                          penjualan_detail.kd_produk_size = '$rP[kd_produk_size]'
                          AND penjualan.id_toko = '$rP[id_toko]'
                          GROUP BY penjualan.tanggal, penjualan.nota 
                          ") or die (mysqli_error());
                    while ($rPenjualan = mysqli_fetch_array($qPenjualan)) {
                      $totalPenjualan += $rPenjualan['jumlah'];
                  ?>
                      <tr>
                        <td><?= $rPenjualan['tanggal'];?></td>
                        <td><?= $rPenjualan['nota'];?></td>
                        <td><?= $rPenjualan['nm_toko'];?></td>
                        <td><?= lusin($rPenjualan['jumlah']);?></td>
                        <td><?= pcs($rPenjualan['jumlah']);?></td>
                      </tr>
                  <?php
                    }
                  ?>
                  <tr>
                    <td colspan="3"><b>Total</b></td>
                    <td><b><?= number_format(lusin($totalPenjualan));?></b></td>
                    <td><b><?= number_format(pcs($totalPenjualan));?></b></td>
                  </tr>
                </table>
              </div>
              <div class="col-md-6">
                <h3>Retur Penjualan</h3>
                <table class="table table-bordered">
                  <tr>
                    <td>Tanggal</td>
                    <td>Nota</td>
                    <td>Toko</td>
                    <td>Lusin</td>
                    <td>Pcs</td>
                  </tr>
                  <?php
                    $totalReturPenjualan = 0;
                    $qReturPenjualan = mysqli_query($link,"SELECT 
                          toko.nm_toko, 
                          retur_penjualan.tanggal, 
                          retur_penjualan.nota, 
                          sum(retur_penjualan_detail.jumlah) AS jumlah
                          FROM 
                          retur_penjualan_detail 
                          Inner Join retur_penjualan ON retur_penjualan.nota = retur_penjualan_detail.nota
                          Inner Join toko ON toko.id_toko = retur_penjualan.id_toko
                          WHERE 
                          retur_penjualan_detail.kd_produk_size = '$rP[kd_produk_size]'
                          AND retur_penjualan.id_toko = '$rP[id_toko]'
                          GROUP BY retur_penjualan.tanggal
                          ") or die (mysqli_error());
                    while ($rReturPenjualan = mysqli_fetch_array($qReturPenjualan)) {
                      $totalReturPenjualan += $rReturPenjualan['jumlah'];
                  ?>
                      <tr>
                        <td><?= $rReturPenjualan['tanggal'];?></td>
                        <td><?= $rReturPenjualan['nota'];?></td>
                        <td><?= $rReturPenjualan['nm_toko'];?></td>
                        <td><?= lusin($rReturPenjualan['jumlah']);?></td>
                        <td><?= pcs($rReturPenjualan['jumlah']);?></td>
                      </tr>
                  <?php
                    }
                  ?>
                  <tr>
                    <td colspan="3"><b>Total</b></td>
                    <td><b><?= number_format(lusin($totalReturPenjualan));?></b></td>
                    <td><b><?= number_format(pcs($totalReturPenjualan));?></b></td>
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