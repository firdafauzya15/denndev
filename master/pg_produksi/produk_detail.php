<?php

$id_produk = base64_decode($_GET['id_produk']);
$q = mysqli_query($link,"SELECT * FROM produk
      Inner Join kategori On kategori.id_kategori = produk.id_kategori 
      Inner Join brand On brand.id_brand = produk.id_brand
      WHERE id_produk = '$id_produk'");
$r = mysqli_fetch_array($q);

$tipe = "<span class='label label-warning'>Barang Produksi</span>";
if ($r['id_tipe_produk'] == '2') {
  $tipe = "<span class='label label-success'>Barang Jadi</span>";
}

$harga_modal = $r['harga_modal'];

if ($r['id_tipe_produk'] == '1') {

  $qProd = mysqli_query($link,"SELECT 
        spk_cutting.nota AS nota_spk,
        spk_cutting.harga AS harga_spk,
        sablon.harga AS harga_sablon,
        produksi.harga AS harga_produksi
        FROM 
        sablon_detail 
        Inner Join sablon ON sablon.nota = sablon_detail.nota
        Inner Join produksi ON produksi.nota_sablon = sablon.nota
        Inner Join spk_cutting ON spk_cutting.nota = sablon.nota_spk
        Inner Join produk ON produk.kd_produk = sablon_detail.kd_produk
        WHERE 
        produk.kd_produk = '$r[kd_produk]'
        Order By produksi.id_produksi DESC
        ") or die (mysqli_error());
  $rProd = mysqli_fetch_array($qProd);

  $harga_bahan = 0;
  $qBahan = mysqli_query($link,"SELECT 
        spk_cutting_detail.kd_bahan,
        pembelian_bahan_detail.harga
        FROM 
        spk_cutting_detail 
        Inner Join pembelian_bahan_detail ON pembelian_bahan_detail.kd_bahan = spk_cutting_detail.kd_bahan
        WHERE 
        spk_cutting_detail.nota = '$rProd[nota_spk]'
        Order By pembelian_bahan_detail.id_pembelian_bahan_detail DESC
        ") or die (mysqli_error());
  while ($rBahan = mysqli_fetch_array($qBahan)) {
    $harga_bahan += $rBahan['harga'];
  }

  $harga_bahan = $harga_bahan;
  $harga_spk = $rProd['harga_spk'];
  $harga_sablon = $rProd['harga_sablon'];
  $harga_produksi = $rProd['harga_produksi'];
  $harga_modal = $harga_bahan + $harga_spk + $harga_sablon + $harga_produksi;

}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data Produk
    </h1>
    <ol class="breadcrumb">
      <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Produk</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Detail Produk</h3>
          </div><!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="col-md-6">
                <table class="table table-bordered">
                  <tr>
                    <td>Tipe</td>
                    <td>:</td>
                    <td><?= $tipe;?></td>
                  </tr>
                  <tr>
                    <td>Brand</td>
                    <td>:</td>
                    <td><?= $r['nm_brand'];?></td>
                  </tr>
                  <tr>
                    <td>Kategori</td>
                    <td>:</td>
                    <td><?= $r['nm_kategori'];?></td>
                  </tr>
                  <tr>
                    <td>Kode Produk</td>
                    <td>:</td>
                    <td><?= $r['kd_produk'];?></td>
                  </tr>
                  <tr>
                    <td>Nama Produk</td>
                    <td>:</td>
                    <td><?= $r['nm_produk'];?></td>
                  </tr>
                  <tr>
                    <td>Harga Modal</td>
                    <td>:</td>
                    <td><?= number_format($harga_modal);?></td>
                  </tr>
                  <tr>
                    <td>Harga Jual</td>
                    <td>:</td>
                    <td><?= number_format($r['harga_jual']);?></td>
                  </tr>
                  <tr>
                    <td>Gambar</td>
                    <td>:</td>
                    <td><img src="upload/<?= $r['file'];?>" height="100" width="100"></td>
                  </tr>
                </table>
              </div>
              <div class="col-md-6 text-right">
                <a class="btn btn-danger" onclick="window.history.back()">Kembali</a>
                <hr>
              </div>
            </div>
            <hr>
            <h4> Generate Barcode </h4>
            <div class="row">
              <div class="col-md-8">
                <table class="table table-bordered">
                  <tr>
                    <th>Kode</th>
                    <th>Ukuran</th>
                    <th>Qty</th>
                    <th width="1">Aksi</th>
                  </tr>
                  <?php
                  $i = 0;
                  $qD = mysqli_query($link,"SELECT 
                        * 
                        FROM 
                        produk_size 
                        Inner Join size On size.id_size = produk_size.id_size
                        WHERE 
                        kd_produk = '$r[kd_produk]'
                        ") or die (mysqli_error());
                  while ($rD = mysqli_fetch_array($qD)) {
                  ?>
                    <form action="master/pg_produk/print_barcode.php" method="post" class="form-horizontal" enctype="multipart/form-data" target="_blank">
                      <input type="hidden" name="id_produk_size" value="<?= $rD['id_produk_size'];?>">
                      <tr>
                        <td><?= $rD['kd_produk_size'];?></td>
                        <td><?= $rD['nm_size'];?></td>
                        <td><input name="qty[]" type="number" required="required" style="width: 85px;" /></td>
                        <td><button type="submit" class="btn btn-warning"><i class="fa fa-print"></i> Print</button></td>
                      </tr>
                    </form>
                  <?php
                  }
                  ?>
                </table>
              </div>
            </div>
          </div>
        </div><!-- /.box -->
      </div>
    </div><!-- /.row -->

  </section><!-- /.content -->
</div><!-- /.content-wrapper -->