<div class="content-wrapper">
<?
 	$bc[] = array('title' => 'CMT', 'url' => 'home.php?act='.md5('cmt'), 'active' => '0');
	$bc[] = array('title' => 'CMT Add', 'url' => '#', 'active' => '1');
	echo $lib->breadcrumbs("Data CMT",$bc);
?>
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-info">
          <div class="box-header with-border"><h3 class="box-title">Tambah CMT</h3></div>
          <form action="home.php?act=<?= md5('cmt_insert')?>" method="post" class="form-horizontal">
            <div class="box-body">
              <div class="form-group">
                <label for="nm_cmt" class="col-sm-2 control-label">Nama CMT</label>
                <div class="col-sm-6"><input type="text" name="nm_cmt" class="form-control" required></div>
              </div>
              <div class="form-group">
                <label for="telp" class="col-sm-2 control-label">Telp</label>
                <div class="col-sm-6"><input type="text" name="telp" class="form-control" required></div>
              </div>
              <div class="form-group">
                <label for="pic" class="col-sm-2 control-label">PIC</label>
                <div class="col-sm-6"><input type="text" name="pic" class="form-control" required></div>
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