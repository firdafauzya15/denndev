<div class="content-wrapper">
<?
 	$bc[] = array('title' => 'Customer', 'url' => 'home.php?act='.md5('customer'), 'active' => '0');
	$bc[] = array('title' => 'Customer Add', 'url' => '#', 'active' => '1');
	echo $lib->breadcrumbs("Data Customer",$bc);
?>

  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Tambah customer</h3>
          </div>
          <form action="home.php?act=<?= md5('customer_insert')?>" method="post" class="form-horizontal">
            <div class="box-body">
              <div class="form-group">
                <label for="nm_customer" class="col-sm-2 control-label">Nama customer</label>
                <div class="col-sm-6"><input type="text" name="nm_customer" class="form-control" required></div>
              </div>
              <div class="form-group">
                <label for="telp" class="col-sm-2 control-label">Telp</label>
                <div class="col-sm-6"><input type="text" name="telp" class="form-control" required></div>
              </div>
              <div class="form-group">
                <label for="alamat" class="col-sm-2 control-label">Alamat</label>
                <div class="col-sm-6"><textarea name="alamat" class="form-control"></textarea></div>
              </div>
              <div class="form-group">
                <label for="keterangan" class="col-sm-2 control-label">Keterangan</label>
                <div class="col-sm-6"><textarea name="keterangan" class="form-control"></textarea></div>
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