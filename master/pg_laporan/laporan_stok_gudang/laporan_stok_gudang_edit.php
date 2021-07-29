<?php

$id_stok_gudang = base64_decode($_GET['id_stok_gudang']);
$q = mysqli_query($link,"SELECT * FROM stok_gudang
      Inner Join produk_size ON produk_size.kd_produk_size = stok_gudang.kd_produk_size
      Inner Join produk ON produk.kd_produk = produk_size.kd_produk
      WHERE id_stok_gudang = '$id_stok_gudang'") or die (mysqli_error());
$r = mysqli_fetch_array($q);

?>

<div class="content-wrapper">
  <section class="content-header">
    <h1>Data Stok Gudang</h1>
    <ol class="breadcrumb">
      <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Stok Gudang</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-info">
          <div class="box-header with-border"><h3 class="box-title">Ubah Stok Gudang</h3></div>
          <form action="home.php?act=<?php echo md5('laporan_stok_gudang_update')?>" method="post" class="form-horizontal">
            <input type="hidden" name="id_stok_gudang" value="<?= $id_stok_gudang;?>">
            <div class="box-body">
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Kode</label>
                <div class="col-sm-6">
                  <input type="text" class="form-control" id="inputEmail3" value="<?= $r['kd_produk_size'];?>" readonly="readonly">
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Nama</label>
                <div class="col-sm-6">
                  <input type="text" class="form-control" id="inputEmail3" value="<?= $r['nm_produk'];?>" readonly="readonly">
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Stok</label>
                <div class="col-sm-2">
                  <input type="number" min="0" name="jumlah" class="form-control" id="inputEmail3" value="<?= $r['jumlah'];?>">
                </div>
              </div>
            </div>

            <div class="box-footer">
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label"></label>
                <div class="col-sm-6">
                  <button type="submit" class="btn btn-primary" onclick="return confirm('Apakah anda yakin ?')">Simpan</button>
                  <a class="btn btn-danger" onclick="window.history.back()">Batal</a>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
</div>