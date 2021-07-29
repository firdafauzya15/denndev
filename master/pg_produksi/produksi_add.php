<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data Produksi
    </h1>
    <ol class="breadcrumb">
      <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Produksi</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Tambah Produksi</h3>
          </div><!-- /.box-header -->
          <form action="#" method="post" class="form-horizontal">
            <div class="form-group">
              <label class="col-sm-2 control-label">Nota Sablon</label>
              <div class="col-sm-3">
                <select class="form-control select2" name="nota_sablon" required onchange="submit()">
                  <option value="">.:: Pilih Nota ::.</option>
                  <?php
                    $q = mysqli_query($link,"SELECT nota FROM sablon Order By id_sablon ASC");
                    while ($r = mysqli_fetch_array($q)) {
                      
                      $cS = mysqli_fetch_array(mysqli_query($link,"SELECT nota_sablon FROM produksi WHERE nota_sablon = '$r[nota]'"));
                      if ($cS == 0) {
                        if ($r['nota'] == $_POST['nota_sablon']) {
                          echo "<option value='$r[nota]' selected>$r[nota]</option>";
                        } else {
                          echo "<option value='$r[nota]'>$r[nota]</option>";
                        }
                      }

                    }
                  ?>
                </select>
              </div>
            </div>
          </form>
          <hr>
          <?php
          $nota_sablon = $_POST['nota_sablon'];
          if (isset($nota_sablon)) {
          ?>
            <!-- form start -->
            <form action="home.php?act=<?php echo md5('produksi_insert')?>" method="post" class="form-horizontal">
              <input type="hidden" name="nota_sablon" value="<?= $nota_sablon;?>">
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nota</label>
                  <div class="col-sm-3">
                    <input type="text" name="nota" class="form-control" id="inputEmail3" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Tanggal</label>
                  <div class="col-sm-3">
                    <div class="input-group date">
                      <input type="text" name="tanggal" class="form-control pull-right" id="datepicker" value="<?= date('Y-m-d');?>">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Jatuh Tempo</label>
                  <div class="col-sm-3">
                    <div class="input-group date">
                      <input type="text" name="jatuh_tempo" class="form-control pull-right" id="datepicker2" value="<?= date('Y-m-d');?>">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">CMT</label>
                  <div class="col-sm-3">
                    <select class="form-control select2" name="id_cmt" required>
                      <option value="">.:: Pilih CMT ::.</option>
                      <?php
                        $q = mysqli_query($link,"SELECT * FROM cmt Order By nm_cmt ASC");
                        while ($r = mysqli_fetch_array($q)) {
                          echo "<option value='$r[id_cmt]'>$r[nm_cmt]</option>";
                        }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Harga CMT</label>
                  <div class="col-sm-2">
                    <input type="number" name="harga" class="form-control" id="inputEmail3" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Keterangan</label>
                  <div class="col-sm-4">
                    <textarea name="keterangan" class="form-control"></textarea>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <label class="col-sm-2 control-label">Daftar Barang</label>
                  <div class="col-md-10">
                    <table class="table table-bordered">
                      <tr>
                        <th rowspan='2' width="1" style="text-align:center">No</th>
                        <th rowspan='2' style="text-align:center">Kode</th>
                        <th colspan='2' width="200" style="text-align:center">Jumlah CMT</th>
                        <th colspan='2'width="200" style="text-align:center">Jumlah Balikan Sablon</th>
                        <th colspan='2'width="200" style="text-align:center">Jumlah Balikan Reject</th>
                      </tr>
                      <tr>
                       
                        <th width="200">Lusin</th>
                        <th width="200">Pcs</th>
                        <th width="200">Lusin</th>
                        <th width="200">Pcs</th>
                        <th width="200">Lusin</th>
                        <th width="200">Pcs</th>
                      </tr>
                      <?php
                        $qD = mysqli_query($link,"SELECT 
                              sablon_detail.id_sablon_detail,
                              sablon_detail.jumlah,
                              sablon_pengiriman.jumlah as spj,
                              sablon_pengiriman_bs.jumlah as spbj,
                              sablon_detail.kd_produk,
                              sablon_detail.kd_produk_size
                              FROM 
                              sablon_detail
                              Inner Join sablon_pengiriman
                              ON sablon_pengiriman.id_sablon_detail =sablon_detail.id_sablon_detail 

                              INNER JOIN sablon_pengiriman_bs
                              ON sablon_pengiriman_bs.id_Sablon_detail = sablon_detail.id_Sablon_detail
                              WHERE 
                              sablon_detail.nota = '$nota_sablon'
                              ") or die (mysqli_error());
                        while ($rD = mysqli_fetch_array($qD)) {
                          $i++;
                          $id_sablon_detail = base64_encode($rD['id_sablon_detail']);

                          $rKD = mysqli_fetch_array(mysqli_query($link,"SELECT 
                                        sum(sablon_pengiriman.jumlah) AS terkirim
                                        FROM
                                        sablon_pengiriman
                                        WHERE 
                                        sablon_pengiriman.id_sablon_detail = '$rD[id_sablon_detail]'
                                        "));
                      ?>
                          <tr>
                            <td><?= $i;?></td>
                            <td><?= $rD['kd_produk_size'];?></td>
                            <td>
                              <input type="hidden" name="kd_produk[]" value="<?= $rD['kd_produk'];?>">
                              <input type="hidden" name="kd_produk_size[]" value="<?= $rD['kd_produk_size'];?>">
                              <input type="number" name="lusin[]" min="0" value="0" class="form-control" id="inputEmail3">
                            </td>
                            <td>
                              <input type="number" name="pcs[]" min="0" value="0" class="form-control" id="inputEmail3">
                            </td>

                            <td><?= number_format(lusin($rD['spj']));?></td>
				          					<td><?= number_format(pcs($rD['spj']));?></td>
                            <td><?= number_format(lusin($rD['spbj']));?></td>
				          					<td><?= number_format(pcs($rD['spbj']));?></td>
                          </tr>
                      <?php
                        }
                      ?>
                    </table>
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
          <?php
          }
          ?>
        </div><!-- /.box -->
      </div>
    </div><!-- /.row -->

  </section><!-- /.content -->
</div><!-- /.content-wrapper -->