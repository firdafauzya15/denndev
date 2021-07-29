<?php
$nota = base64_decode($_GET['nota']);
$q = mysqli_query($link,"SELECT 
                      penjualan.id_penjualan, 
                      penjualan.nota, 
                      penjualan.nm_customer, 
                      penjualan.alamat_customer, 
                      penjualan.telp_customer
                      FROM 
                      penjualan 
                      WHERE penjualan.nota = '$nota'") or die (mysqli_error());
$r = mysqli_fetch_array($q);
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data Penjualan (Online)
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
            <h3 class="box-title">Ubah Customer</h3>
          </div><!-- /.box-header -->
          <!-- form start -->
          <form action="home.php?act=<?php echo md5('penjualan_online_update')?>" method="post" class="form-horizontal">
            <input type="hidden" name="nota" value="<?= $r['nota'];?>">
            <input type="hidden" name="id_penjualan" value="<?= $r['id_penjualan'];?>">
            <div class="box-body">
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Nota</label>
                <div class="col-sm-6">
                  <input type="text" name="nota" class="form-control" id="inputEmail3" value="<?= $r['nota'];?>" required readonly="readonly">
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Nama Customer</label>
                <div class="col-sm-6">
                  <input type="text" name="nm_customer" class="form-control" id="inputEmail3" value="<?= $r['nm_customer'];?>" required>
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Alamat Customer</label>
                <div class="col-sm-6">
                  <input type="text" name="alamat_customer" class="form-control" id="inputEmail3" value="<?= $r['alamat_customer'];?>" required>
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Telp Customer</label>
                <div class="col-sm-6">
                  <input type="text" name="telp_customer" class="form-control" id="inputEmail3" value="<?= $r['telp_customer'];?>" required>
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