<?php
$tanggal = $_POST['tanggal'];
$jatuh_tempo = $_POST['jatuh_tempo'];
$nota = $_POST['nota'];
$harga = $_POST['harga'];
$kd_produk = $_POST['kd_produk'];
$keterangan = $_POST['keterangan'];

$nota_spk = $_POST['nota_spk'];

$vendor = $_POST['vendor'];
$pecah = explode("|", $vendor);
$id_vendor = $pecah[0];
$nm_vendor = $pecah[1];
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data Sablon / Bordir
    </h1>
    <ol class="breadcrumb">
      <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Sablon / Bordir</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Tambah Sablon / Bordir</h3>
          </div><!-- /.box-header -->
          <!-- form start -->
          <form action="home.php?act=<?php echo md5('sablon_insert')?>" method="post" class="form-horizontal">
            <div class="box-body">
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Tanggal</label>
                <div class="col-sm-3">
                  <input type="text" name="tanggal" value="<?= $tanggal;?>" class="form-control" id="inputEmail3" required readonly="readonly">
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Jatuh Tempo</label>
                <div class="col-sm-3">
                  <input type="text" name="jatuh_tempo" value="<?= $jatuh_tempo;?>" class="form-control" id="inputEmail3" required readonly="readonly">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Nota SPK Cutting</label>
                <div class="col-sm-3">
                  <input type="text" name="nota_spk" value="<?= $nota_spk;?>" class="form-control" id="inputEmail3" required readonly="readonly">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Nota</label>
                <div class="col-sm-3">
                  <input type="text" name="nota" value="<?= $_POST['nota'];?>" class="form-control" id="inputEmail3" required readonly="readonly">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Vendor</label>
                <div class="col-sm-3">
                  <input type="hidden" name="id_vendor" value="<?= $id_vendor;?>" class="form-control" id="inputEmail3" required readonly="readonly">
                  <input type="text" value="<?= $nm_vendor;?>" class="form-control" id="inputEmail3" required readonly="readonly">
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Harga Vendor</label>
                <div class="col-sm-2">
                  <input type="number" name="harga" value="<?= $harga;?>" class="form-control" id="inputEmail3" required readonly="readonly">
                </div>
              </div>
              <hr>
              <div class="form-group">
                <label class="col-sm-2 control-label">Daftar Produk</label>
                <div class="col-sm-10">
                  <table class="table table-bordered">
                    <tr>
                      <th width="1">No</th>
                      <th>Kode</th>
                      <th width="100">Lusin</th>
                      <th width="100">Pcs</th>
                    </tr>
                    <?php
                      $i = 0;
                      foreach ($kd_produk as $k => $v) {
                        # code...
                        $i++;
                    ?>
                        <tr>
                          <th><?= $i;?></th>
                          <th><?= $v;?></th>
                          <th></th>
                        </tr>
                        <?php
                          $qD = mysqli_query($link,"SELECT
                                produk_size.kd_produk_size
                                FROM 
                                produk_size 
                                WHERE
                                produk_size.kd_produk = '$v'
                                ") or die (mysqli_error());
                          while ($rD = mysqli_fetch_array($qD)) {
                        ?>
                            <input type="hidden" name="kd_produk[]" value="<?= $v;?>">
                            <input type="hidden" name="keterangan[]" value="<?= $keterangan[$k];?>">
                            <input type="hidden" name="kd_produk_size[]" value="<?= $rD['kd_produk_size'];?>">
                            <tr>
                              <td></td>
                              <td><?= $rD['kd_produk_size'];?></td>
                              <td>
                                  <input type="number" name="lusin[]" min="0" value="0" class="form-control" id="inputEmail3">
                              </td>
                              <td>
                                  <input type="number" name="pcs[]" min="0" value="0" class="form-control" id="inputEmail3">
                              </td>
                            </tr>
                        <?php
                          }
                        ?>
                        <tr>
                          <td colspan="4">
                            <div class="progress progress-xs">
                              <div class="progress-bar progress-bar-blue" style="width: 100%; height: 1px;"></div>
                            </div>
                          </td>
                        </tr>
                    <?php
                      }
                    ?>
                  </table>
                </div>
              </div><!-- /.form-group -->
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