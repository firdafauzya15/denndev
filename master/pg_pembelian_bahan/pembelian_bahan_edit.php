<?php

$id_brand = base64_decode($_GET['id_brand']);
$q = mysqli_query($link,"SELECT * FROM brand WHERE id_brand = '$id_brand'");
$r = mysqli_fetch_array($q);

?>
<div class="content-wrapper">
  <?
 	$bc[] = array('title' => 'Pembelian Bahan', 'url' => 'home.php?act='.md5('pembelian_bahan'), 'active' => '0');
	$bc[] = array('title' => 'Pembelian Bahan Edit', 'url' => '#', 'active' => '1');
	echo $lib->breadcrumbs("Data Pembelian Bahan",$bc);
?>
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Ubah Brand</h3>
          </div>
          <form action="home.php?act=<?php echo md5('brand_update')?>" method="post" class="form-horizontal">
            <input type="hidden" name="id_brand" value="<?= $id_brand;?>">
            <div class="box-body">
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Nama Brand</label>
                <div class="col-sm-6">
                  <input type="text" name="nm_brand" class="form-control" id="inputEmail3" value="<?= $r['nm_brand'];?>" required>
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