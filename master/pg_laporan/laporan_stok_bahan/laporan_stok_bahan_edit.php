<?php

$id_stok_bahan = base64_decode($_GET['id_stok_bahan']);
$q = mysqli_query($link,"SELECT * FROM stok_bahan
      Inner Join bahan ON bahan.kd_bahan = stok_bahan.kd_bahan
      WHERE id_stok_bahan = '$id_stok_bahan'") or die (mysqli_error());
$r = mysqli_fetch_array($q);

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data Stok Bahan
    </h1>
    <ol class="breadcrumb">
      <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Stok Bahan</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Ubah Stok Bahan</h3>
          </div><!-- /.box-header -->
          <!-- form start -->
          <form action="home.php?act=<?php echo md5('laporan_stok_bahan_update')?>" method="post" class="form-horizontal">
            <input type="hidden" name="id_stok_bahan" value="<?= $id_stok_bahan;?>">
            <div class="box-body">
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Kode</label>
                <div class="col-sm-6">
                  <input type="text" class="form-control" id="inputEmail3" value="<?= $r['kd_bahan'];?>" readonly="readonly">
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Nama</label>
                <div class="col-sm-6">
                  <input type="text" class="form-control" id="inputEmail3" value="<?= $r['nm_bahan'];?>" readonly="readonly">
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Stok Bahan</label>
                <div class="col-sm-2">
                  <input type="number" min="0" step="any" name="jumlah" class="form-control" id="inputEmail3" value="<?= $r['jumlah'];?>">
                </div>
              </div>
            </div><!-- /.box-body -->

            <div class="box-footer">
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label"></label>
                <div class="col-sm-6">
                  <button type="submit" class="btn btn-primary" onclick="return confirm('Apakah anda yakin ?')">Simpan</button>
                  <a class="btn btn-danger" onclick="window.history.back()">Batal</a>
                </div>
              </div>
            </div><!-- /.box-footer -->
          </form>
        </div><!-- /.box -->
      </div>
    </div><!-- /.row -->

  </section><!-- /.content -->
</div><!-- /.content-wrapper -->