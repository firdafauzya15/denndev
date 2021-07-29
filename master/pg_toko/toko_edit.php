<?php
$id_toko = base64_decode($_GET['id_toko']);
$q = mysqli_query($link,"SELECT * FROM toko WHERE id_toko = '$id_toko'");
$r = mysqli_fetch_array($q);
?>
<div class="content-wrapper">
<?
 	$bc[] = array('title' => 'Toko', 'url' => 'home.php?act='.md5('toko'), 'active' => '0');
	$bc[] = array('title' => 'Toko Edit', 'url' => '#', 'active' => '1');
	echo $lib->breadcrumbs("Data User",$bc);
?>

  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-info">
          <div class="box-header with-border"><h3 class="box-title">Ubah Toko</h3></div>
          <form action="home.php?act=<?= md5('toko_update')?>" method="post" class="form-horizontal" enctype="multipart/form-data">
            <input type="hidden" name="id_toko" value="<?= $id_toko;?>">
            <input type="hidden" name="file_lama" value="<?= $r['file'];?>">
            <div class="box-body">
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Nama Toko</label>
                <div class="col-sm-6">
                  <input type="text" name="nm_toko" class="form-control" id="inputEmail3" value="<?= $r['nm_toko'];?>" required>
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Alamat</label>
                <div class="col-sm-6">
                  <textarea name="alamat" class="form-control"><?= $r['alamat'];?></textarea>
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Prefix Nota</label>
                <div class="col-sm-6">
                  <input type="text" name="prefix_nota" class="form-control" id="inputEmail3" value="<?= $r['prefix_nota'];?>" required>
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Foto</label>
                <div class="col-sm-6">
                  <img src="upload/<?= $r['file'];?>" height="100" width="100">
                  <hr>
                  <input type="file" name="file" id="inputEmail3">
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