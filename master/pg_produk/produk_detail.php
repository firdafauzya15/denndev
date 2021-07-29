<?php
$id_produk = base64_decode($_GET['id_produk']);
$q = mysqli_query($link,"SELECT 
  *, 
  produk.file AS file 
  FROM 
  produk
  Inner Join pola On pola.id_pola = produk.id_pola 
  Inner Join brand On brand.id_brand = produk.id_brand
  WHERE 
  id_produk = '$id_produk'
  ");
$r = mysqli_fetch_array($q);

$tipe = "<span class='label label-warning'>Barang Produksi</span>";
if ($r['id_tipe_produk'] == '2') {
  $tipe = "<span class='label label-success'>Barang Jadi</span>";
}

$harga_modal = $r['harga_modal'];
?>

<div class="content-wrapper">
<?
 	$bc[] = array('title' => 'Produk', 'url' => 'home.php?act='.md5('produk'), 'active' => '0');
	$bc[] = array('title' => 'Produk Detail', 'url' => '#', 'active' => '1');
	echo $lib->breadcrumbs("Data Produk",$bc);
?> 


  <section class="content">
    <div class="row">
      <div class="col-md-12">
 
        <div class="box box-info">
          <div class="box-header with-border"><h3 class="box-title">Detail Produk</h3></div>
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
                    <td>Pola</td>
                    <td>:</td>
                    <td><?= $r['kd_pola'];?></td>
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
                    <td>Gambar</td>
                    <td>:</td>
                    <td><img src="upload/<?= $r['file'];?>" height="100" width="100"></td>
                  </tr>
                </table>
              </div>
              <div class="col-md-6 text-right">
                <a class="btn btn-warning" target="blank" href="master/pg_produk/print_produk.php?p=<?= $_GET['id_produk'];?>"><i class="glyphicon glyphicon-print icon-white"></i> Print</a>
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
                    <th>Harga</th>
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
                    <form action="master/function/generate_barcode/" method="post" class="form-horizontal" enctype="multipart/form-data" target="_blank">
                      <input type="hidden" name="id_produk_size" value="<?= $rD['id_produk_size'];?>">
                      <input type="hidden" name="kd_produk_size" value="<?= $rD['kd_produk_size'];?>">
                      <tr>
                        <td><?= $rD['kd_produk_size'];?></td>
                        <td><?= number_format($rD['harga_jual']);?></td>
                        <td><input name="qty" type="number" required="required" style="width: 85px;" /></td>
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