<?php

$id_pola = base64_decode($_GET['id_pola']);
$q = mysqli_query($link,"SELECT * FROM pola WHERE id_pola = '$id_pola'");
$r = mysqli_fetch_array($q);

?>

<div class="content-wrapper">
<?
 	$bc[] = array('title' => 'Pola', 'url' => 'home.php?act='.md5('pola'), 'active' => '0');
	$bc[] = array('title' => 'Pola Edit', 'url' => '#', 'active' => '1');
	echo $lib->breadcrumbs("Data Pola",$bc);
?>
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-info">
          <div class="box-header with-border"><h3 class="box-title">Ubah pola</h3></div>
          <form action="home.php?act=<?= md5('pola_update')?>" method="post" class="form-horizontal">
            <input type="hidden" name="id_pola" value="<?= $id_pola;?>">
            <div class="box-body">
              <div class="form-group">
                <label for="kd_pola" class="col-sm-2 control-label">Kode pola</label>
                <div class="col-sm-6">
                  <input type="text" name="kd_pola" class="form-control" value="<?= $r['kd_pola'];?>" required>
                </div>
              </div>
              <div class="form-group">
                <label for="nm_pola" class="col-sm-2 control-label">Nama pola</label>
                <div class="col-sm-6">
                  <input type="text" name="nm_pola" class="form-control" value="<?= $r['nm_pola'];?>" required>
                </div>
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