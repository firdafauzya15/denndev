<div class="content-wrapper">
<?
 	$bc[] = array('title' => 'Kategori', 'url' => 'home.php?act='.md5('kategori'), 'active' => '0');
	$bc[] = array('title' => 'Kategori Add', 'url' => '#', 'active' => '1');
	echo $lib->breadcrumbs("Data Kategori",$bc);
?>

  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Tambah Kategori</h3>
          </div>
          <form action="home.php?act=<?= md5('kategori_insert')?>" method="post" class="form-horizontal">
            <div class="box-body">
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Nama Kategori</label>
                <div class="col-sm-6">
                  <input type="text" name="nm_kategori" class="form-control" id="inputEmail3" required>
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Ukuran</label>
                <div class="col-sm-6">
                <?php
                $qS = mysqli_query($link,"SELECT * FROM size") or die (mysqli_error());
                while ($rS = mysqli_fetch_array($qS)) {
                ?>
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="id_size[]" value="<?= $rS['id_size'];?>">
                      <?= $rS['nm_size'];?>
                    </label>
                  </div>
                <?php
                }
                ?>
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