<div class="content-wrapper">
<?
 	$bc[] = array('title' => 'Pengeluaran', 'url' => 'home.php?act='.md5('pengeluaran'), 'active' => '0');
	$bc[] = array('title' => 'Pengeluaran Add', 'url' => '#', 'active' => '1');
	echo $lib->breadcrumbs("Data pengeluaran",$bc);
?>

  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Tambah Pengeluaran</h3>
          </div>
          <form action="home.php?act=<?php echo md5('pengeluaran_insert')?>" method="post" class="form-horizontal">
            <div class="box-body">
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Tanggal</label>
                <div class="col-sm-3">
                  <div class="input-group date">
                    <input type="text" name="tanggal" class="form-control pull-right" id="datepicker">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Toko</label>
                <div class="col-sm-4">
                  <select class="form-control select2" name="id_toko" required id="id_toko">
                    <?php
                      $tokos = mysqli_query($link,"SELECT * FROM toko ORDER BY nm_toko ASC");
                      while ($toko = mysqli_fetch_array($tokos)) {
                        echo "<option value='$toko[id_toko]'>$toko[nm_toko]</option>";
                      }
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Nominal</label>
                <div class="col-sm-3">
                  <input type="text" name="nominal" class="form-control" id="inputEmail3" required>
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Keterangan</label>
                <div class="col-sm-6">
                  <textarea name="keterangan" class="form-control"></textarea>
                </div>
              </div>
            </div><!-- /.box-body -->

            <div class="box-footer">
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label"></label>
                <div class="col-sm-6">
                  <button type="submit" class="btn btn-primary" onclick="return confirm('Apakah anda yakin ?')">Simpan</button>
                  <a class="btn btn-danger" onclick="window.history.back()">Batal</a>
                </div>
              </div>
            </div><!-- /.box-footer -->
          </form>
        </div><!-- /.box -->
      </div>
    </div><!-- /.row -->

  </section><!-- /.content -->
</div><!-- /.content-wrapper -->