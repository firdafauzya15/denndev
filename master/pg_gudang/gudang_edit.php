<?php
$id_gudang = base64_decode($_GET['id_gudang']);
$q = mysqli_query($link,"SELECT * FROM gudang WHERE id_gudang = '$id_gudang'");
$r = mysqli_fetch_array($q);
?>
<div class="content-wrapper">
<?
 	$bc[] = array('title' => 'Gudang', 'url' => 'home.php?act='.md5('gudang'), 'active' => '0');
	$bc[] = array('title' => 'Gudang Edit', 'url' => '#', 'active' => '1');
	echo $lib->breadcrumbs("Data Gudang",$bc);
?>

  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-info">
          <div class="box-header with-border"><h3 class="box-title">Ubah Gudang</h3></div>
          <form action="home.php?act=<?= md5('gudang_update')?>" method="post" class="form-horizontal">
            <input type="hidden" name="id_gudang" value="<?= $id_gudang;?>">
            <div class="box-body">
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Nama Gudang</label>
                <div class="col-sm-6">
                  <input type="text" name="nm_gudang" class="form-control" value="<?= $r['nm_gudang'];?>" required>
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