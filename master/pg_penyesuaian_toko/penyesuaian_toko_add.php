<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data Penyesuaian Toko
    </h1>
    <ol class="breadcrumb">
      <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Penyesuaian Toko</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Tambah Penyesuaian Toko</h3>
          </div><!-- /.box-header -->
          <!-- form start -->
            <div class="box-body">
              <div class="row">
                <form action="" method="post" class="form-horizontal">
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Toko</label>
                    <div class="col-sm-4">
                      <select class="form-control select2" name="id_toko" required id="id_toko">
                        <option>.:: Pilih Toko ::.</option>
                        <?php
                          $q = mysqli_query($link,"SELECT * FROM toko WHERE tipe = 'OFFLINE' Order By nm_toko ASC");
                          while ($r = mysqli_fetch_array($q)) {
                            $selected = "";
                            if ($_POST['id_toko'] == $r['id_toko']) {
                              $selected = "selected";
                            }
                            echo "<option value='$r[id_toko]' $selected>$r[nm_toko]</option>";
                          }
                        ?>
                      </select>
                    </div>
                    <div class="col-sm-4">
                      <input type="submit" class="btn btn-primary" value="cari" name="cari">
                    </div>
                  </div>
                </form>
              </div>
              <hr>
              <?php
              if ($_POST['cari']) {
              ?>
              <div class="row">
                  <div class="col-md-6">
                      <form action="" method="post">
                          <table class="table">
                              <thead>
                                  <tr>
                                      <th width="1">No.</th>
                                      <th>produk</th>
                                      <th>Stok</th>
                                      <th width="125">Selisih</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <?php
                                  $i = 0;
                                  $q = mysqli_query($link,"SELECT 
                                          stok.id_stok,
                                          stok.jumlah,
                                          stok.kd_produk_size
                                          FROM
                                          stok
                                          WHERE
                                          stok.id_toko = '$_POST[id_toko]'
                                          ") or die (mysqli_error());
                                  $c = mysqli_num_rows($q);
                                  if ($c > 0) {
                                      while ($r = mysqli_fetch_array($q)) {
                                          $i++;
                                  ?>
                                          <input type="hidden" name="cari" value="cari">
                                          <input type="hidden" name="id_stok[]" value="<?= $r['id_stok'];?>">
                                          <input type="hidden" name="id_toko" value="<?= $_POST['id_toko'];?>">
                                          <tr>
                                              <td><?= $i;?></td>
                                              <td><?= $r['kd_produk_size'];?></td>
                                              <td><?= number_format($r['jumlah']);?></td>
                                              <td><input type="number" value="0" step="1" name="qty[]" class="form-control" required="required"></td>
                                          </tr>
                                  <?php
                                      }
                                  } else {
                                  ?>
                                          <tr>
                                              <td colspan="3" class="text-center"><b>Data tidak ditemukan</b></td>
                                          </tr>
                                  <?php
                                  }
                                  ?>
                                  </tbody>
                              </table>
                          <hr>
                          <div class="row">
                              <div class="col-md-6 text-left">
                              </div>
                              <div class="col-md-6 text-right">
                                <input type="submit" name="proses" value="Proses" class="btn btn-info">
                              </div>
                          </div>
                      </form>
                  </div>
                  <?php 
                  if ($_POST['proses']) {
                  ?>
                      <div class="col-md-6">
                          <form action="home.php?act=<?php echo md5('penyesuaian_toko_insert')?>" method="post">
                              <input type="hidden" name="act" value="add">
                              <table class="table">
                                  <thead>
                                      <tr>
                                          <th>Produk</th>
                                          <th>Stok Lama</th>
                                          <th>Selisih</th>
                                          <th>Stok Baru</th>
                                          <th>Harga</th>
                                          <th>Total</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php
                                      $id_stok = $_POST['id_stok'];
                                      $qty = $_POST['qty'];
                                      foreach ($id_stok as $k => $v) {
                                          # code...
                                          $q = mysqli_query($link,"SELECT
                                                produk.harga_jual,
                                                stok.id_stok,
                                                stok.id_toko,
                                                stok.kd_produk_size,
                                                stok.jumlah
                                                FROM
                                                stok
                                                Inner Join produk_size ON produk_size.kd_produk_size = stok.kd_produk_size
                                                Inner Join produk ON produk.kd_produk = produk_size.kd_produk
                                                WHERE 
                                                stok.id_stok = '$v'
                                                Order By stok.kd_produk_size ASC
                                                ") or die (mysqli_error());
                                          $r = mysqli_fetch_array($q);
                                          $total = $qty[$k]*$r['harga_jual'];
                                          $stok_baru = $r['jumlah']+$qty[$k];
                                      ?>
                                          <input type="hidden" name="id_stok[]" value="<?= $r['id_stok'];?>">
                                          <input type="hidden" name="id_toko" value="<?= $_POST['id_toko'];?>">
                                          <input type="hidden" name="kd_produk_size[]" value="<?= $r['kd_produk_size'];?>">
                                          <input type="hidden" name="selisih[]" value="<?= $qty[$k];?>">
                                          <input type="hidden" name="stok_lama[]" value="<?= $r['jumlah'];?>">
                                          <input type="hidden" name="stok_baru[]" value="<?= $stok_baru;?>">
                                          <input type="hidden" name="total[]" value="<?= $total;?>">
                                          <tr>
                                          <td><?= $r['kd_produk_size'];?></td>
                                          <td><?= $r['jumlah'];?></td>
                                          <td><?= $qty[$k];?></td>
                                          <td><?= $stok_baru;?></td>
                                          <td><?= number_format($r['harga_jual']);?></td>
                                          <td><?= number_format($total);?></td>
                                          </tr>
                                      <?php
                                      }
                                      ?>
                                      </tbody>
                                  </table>
                              <hr>
                              <div class="row">
                                  <div class="col-md-6 text-left">
                                  </div>
                                  <div class="col-md-6 text-right">
                                    <input type="submit" name="proses" value="Simpan" class="btn btn-success" onclick="return confirm('apakah anda yakin?')">
                                  </div>
                              </div>
                          </form>
                      </div>
                  <?php
                  }
                  ?>
              </div>
              <?php
              }
              ?>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
      </div>
    </div><!-- /.row -->

  </section><!-- /.content -->
</div><!-- /.content-wrapper -->