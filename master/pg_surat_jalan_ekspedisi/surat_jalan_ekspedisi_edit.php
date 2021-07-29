<?php

$id_surat_jalan_ekspedisi = base64_decode($_GET['id_surat_jalan_ekspedisi']);
$q = mysqli_query($link,"SELECT * FROM surat_jalan_ekspedisi WHERE id_surat_jalan_ekspedisi = '$id_surat_jalan_ekspedisi'");
$r = mysqli_fetch_array($q);

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data Surat Jalan Ekspedisi
    </h1>
    <ol class="breadcrumb">
      <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Surat Jalan Ekspedisi</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Ubah Surat Jalan Ekspedisi</h3>
          </div><!-- /.box-header -->
          <!-- form start -->
          <form action="home.php?act=<?php echo md5('surat_jalan_ekspedisi_update')?>" method="post" class="form-horizontal">
            <input type="hidden" name="id_surat_jalan_ekspedisi" value="<?= $id_surat_jalan_ekspedisi;?>">
            <div class="box-body">
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Tanggal</label>
                <div class="col-sm-3">
                  <div class="input-group date">
                    <input type="text" name="tanggal" class="form-control pull-right" id="datepicker" value="<?= $r['tanggal'];?>">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Customer</label>
                <div class="col-sm-4">
                  <select class="form-control select2" name="id_customer" required>
                    <?php
                      $customers = mysqli_query($link,"SELECT * FROM customer ORDER BY nm_customer ASC");
                      while ($customer = mysqli_fetch_array($customers)) {
                        $selected = "";
                        if ($customer['id_customer'] == $r['id_customer']) {
                          $selected = "selected";
                        }
                        echo "<option value='$customer[id_customer]' $selected>$customer[nm_customer]</option>";
                      }
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Keterangan</label>
                <div class="col-sm-6">
                  <textarea name="keterangan" class="form-control"><?= $r['keterangan'];?></textarea>
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