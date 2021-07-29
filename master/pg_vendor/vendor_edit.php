<?php

$id_vendor = base64_decode($_GET['id_vendor']);
$q = mysqli_query($link,"SELECT * FROM vendor WHERE id_vendor = '$id_vendor'");
$r = mysqli_fetch_array($q);

?>
<div class="content-wrapper">
<?
 	$bc[] = array('title' => 'Vendor', 'url' => 'home.php?act='.md5('Vendor'), 'active' => '0');
	$bc[] = array('title' => 'Vendor Edit', 'url' => '#', 'active' => '1');
	echo $lib->breadcrumbs("Data Vendor",$bc);
?>

  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-info">
          <div class="box-header with-border"><h3 class="box-title">Ubah Vendor</h3></div>
          <form action="home.php?act=<?= md5('vendor_update')?>" method="post" class="form-horizontal">
            <input type="hidden" name="id_vendor" value="<?= $id_vendor;?>">
            <div class="box-body">
              <div class="form-group">
                <label for="nm_vendor" class="col-sm-2 control-label">Nama Vendor</label>
                <div class="col-sm-6">
                  <input type="text" name="nm_vendor" class="form-control"  value="<?= $r['nm_vendor'];?>" required>
                </div>
              </div>
              <div class="form-group">
                <label for="telp" class="col-sm-2 control-label">Telp</label>
                <div class="col-sm-6">
                  <input type="text" name="telp" class="form-control"  value="<?= $r['telp'];?>" required>
                </div>
              </div>
              <div class="form-group">
                <label for="pic" class="col-sm-2 control-label">PIC</label>
                <div class="col-sm-6">
                  <input type="text" name="pic" class="form-control"  value="<?= $r['pic'];?>" required>
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