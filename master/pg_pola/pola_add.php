<div class="content-wrapper">
<?
 	$bc[] = array('title' => 'Pola', 'url' => 'home.php?act='.md5('pola'), 'active' => '0');
	$bc[] = array('title' => 'Pola Add', 'url' => '#', 'active' => '1');
	echo $lib->breadcrumbs("Data Pola",$bc);
?>

  <section class="content">
    <div class="row">
      <div class="col-md-12">

        <div class="box box-info">
          <div class="box-header with-border"><h3 class="box-title">Tambah pola</h3></div>
          <form action="home.php?act=<?= md5('pola_insert')?>" method="post" class="form-horizontal" enctype="multipart/form-data">
            <div class="box-body">
              <div class="form-group">
                <label for="kd_pola" class="col-sm-2 control-label">Kode pola</label>
                <div class="col-sm-6">
                  <input type="text" name="kd_pola" class="form-control" required>
                </div>
              </div>
              <div class="form-group">
                <label for="kd_pola" class="col-sm-2 control-label">Nama pola</label>
                <div class="col-sm-6">
                  <input type="text" name="kd_pola" class="form-control" required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Foto</label>
                <div class="col-sm-6">
                  <input type="file" name="file">
                </div>
              </div>
            </div>

            <div class="box-footer">
              <div class="form-group">
                <label class="col-sm-2 control-label"></label>
                <div class="col-sm-6">
                  <button type="submit" class="btn btn-primary">Simpan</button>
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