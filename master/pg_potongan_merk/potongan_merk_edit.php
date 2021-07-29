<?php

$id_brand = base64_decode($_GET['id_brand']);
$q = mysqli_query($link,"SELECT * FROM brand WHERE id_brand = '$id_brand'");
$r = mysqli_fetch_array($q);

?>

<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Data Brand
    </h1>
    <ol class="breadcrumb">
      <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Brand</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Ubah Brand</h3>
          </div><!-- /.box-header -->
          <!-- form start -->
          <form action="home.php?act=<?php echo md5('brand_update')?>" method="post" class="form-horizontal">
            <input type="hidden" name="id_brand" value="<?= $id_brand;?>">
            <div class="box-body">
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Nama Brand</label>
                <div class="col-sm-6">
                  <input type="text" name="nm_brand" class="form-control" id="inputEmail3" value="<?= $r['nm_brand'];?>" required>
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