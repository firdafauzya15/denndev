<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data Penyesuaian Gudang
    </h1>
    <ol class="breadcrumb">
      <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Penyesuaian Gudang</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Tambah Penyesuaian Gudang</h3>
          </div><!-- /.box-header -->
          <!-- form start -->
            <div class="box-body">
              <div class="row">
                <form action="" method="post" class="form-horizontal">
                <div class="form-group">
                    <label class="col-sm-2 control-label">Brand</label>
                    <div class="col-sm-4">
                      <select class="form-control select2" name="id_brand" required>
                        <option>.:: Pilih Brand ::.</option>
                        <?php
                          $q = mysqli_query($link,"SELECT * FROM brand Order By nm_brand ASC");
                          while ($r = mysqli_fetch_array($q)) {
                            $selected = "";
                            if ($_POST['id_brand'] == $r['id_brand']) {
                              $selected = "selected";
                            }
                            echo "<option value='$r[id_brand]' $selected>$r[nm_brand]</option>";
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
                                      <th rowspan='2' width="1">No.</th>
                                      <th rowspan='2'>produk</th>
                                      <th colspan='2'>Stok</th>
                                      <th width="125">Selisih</th>
                                  </tr>
                                  <tr>
                                      
                                      <th>Lusin</th>
                                      <th>pcs</th>
                                      <th width="125">Selisih</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <?php
                                  $i = 0;
                                  $q = mysqli_query($link,"SELECT 
                                          stok_gudang.id_stok_gudang,
                                          stok_gudang.jumlah,
                                          stok_gudang.kd_produk_size
                                          FROM
                                          stok_gudang
                                          INNER JOIN produk_size ON produk_size.kd_produk_size = stok_gudang.kd_produk_size
                                          INNER JOIN produk ON produk.kd_produk = produk_size.kd_produk
                                          WHERE
                                          produk.id_brand = '$_POST[id_brand]'
                                          ") or die (mysqli_error());
                                  $c = mysqli_num_rows($q);
                                  if ($c > 0) {
                                      while ($r = mysqli_fetch_array($q)) {
                                          $i++;
                                  ?>
                                          <input type="hidden" name="cari" value="cari">
                                          <input type="hidden" name="id_stok_gudang[]" value="<?= $r['id_stok_gudang'];?>">
                                          <input type="hidden" name="id_brand" value="<?= $_POST['id_brand'];?>">
                                          <tr>
                                              <td><?= $i;?></td>
                                              <td><?= $r['kd_produk_size'];?></td>
                                              <td><?= number_format($r['jumlah']);?></td>
                                              <td><?= number_format(lusin($r['jumlah']));?></td>
				          					                <td><?= number_format(pcs($r['jumlah']));?></td>
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
                          <form action="home.php?act=<?php echo md5('penyesuaian_gudang_insert')?>" method="post">
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
                                      $id_stok_gudang = $_POST['id_stok_gudang'];
                                      $qty = $_POST['qty'];
                                      foreach ($id_stok_gudang as $k => $v) {
                                          # code...
                                          $q = mysqli_query($link,"SELECT
                                                produk.harga_jual,
                                                stok_gudang.id_stok_gudang,
                                                stok_gudang.kd_produk_size,
                                                stok_gudang.jumlah
                                                FROM
                                                stok_gudang
                                                Inner Join produk_size ON produk_size.kd_produk_size = stok_gudang.kd_produk_size
                                                Inner Join produk ON produk.kd_produk = produk_size.kd_produk
                                                WHERE 
                                                stok_gudang.id_stok_gudang = '$v'
                                                Order By stok_gudang.kd_produk_size ASC
                                                ") or die (mysqli_error());
                                          $r = mysqli_fetch_array($q);
                                          $total = $qty[$k]*$r['harga_jual'];
                                          $stok_gudang_baru = $r['jumlah']+$qty[$k];
                                      ?>
                                          <input type="hidden" name="id_stok_gudang[]" value="<?= $r['id_stok_gudang'];?>">
                                          <input type="hidden" name="id_gudang" value="<?= $_POST['id_gudang'];?>">
                                          <input type="hidden" name="kd_produk_size[]" value="<?= $r['kd_produk_size'];?>">
                                          <input type="hidden" name="selisih[]" value="<?= $qty[$k];?>">
                                          <input type="hidden" name="stok_gudang_lama[]" value="<?= $r['jumlah'];?>">
                                          <input type="hidden" name="stok_gudang_baru[]" value="<?= $stok_gudang_baru;?>">
                                          <input type="hidden" name="total[]" value="<?= $total;?>">
                                          <tr>
                                          <td><?= $r['kd_produk_size'];?></td>
                                          <td><?= $r['jumlah'];?></td>
                                          <td><?= $qty[$k];?></td>
                                          <td><?= $stok_gudang_baru;?></td>
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