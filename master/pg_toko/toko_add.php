<div class="content-wrapper">
<?
 	$bc[] = array('title' => 'Toko', 'url' => 'home.php?act='.md5('toko'), 'active' => '0');
	$bc[] = array('title' => 'Toko Add', 'url' => '#', 'active' => '1');
	echo $lib->breadcrumbs("Data Toko",$bc);
?>

  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-info">
          <div class="box-header with-border"><h3 class="box-title">Tambah Toko</h3></div>
          <form action="home.php?act=<?= md5('toko_insert')?>" method="post" class="form-horizontal" enctype="multipart/form-data">
            <div class="box-body">
              <input type="hidden" name="tipe" value="OFFLINE">
              <div class="form-group">
                <label for="nm_toko" class="col-sm-2 control-label">Nama Toko</label>
                <div class="col-sm-6"><input type="text" name="nm_toko" class="form-control" required></div>
              </div>
              <div class="form-group">
                <label for="alamat" class="col-sm-2 control-label">Alamat</label>
                <div class="col-sm-6"><textarea name="alamat" class="form-control"></textarea></div>
              </div>
              <div class="form-group">
                <label for="prefix_nota" class="col-sm-2 control-label">Prefix Nota</label>
                <div class="col-sm-2"><input type="text" name="prefix_nota" class="form-control" required></div>
              </div>
              <div class="form-group">
                <label for="file" class="col-sm-2 control-label">Logo</label>
                <div class="col-sm-6"><input type="file" name="file"></div>
              </div>
            </div>

            <div class="box-footer">
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label"></label>
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