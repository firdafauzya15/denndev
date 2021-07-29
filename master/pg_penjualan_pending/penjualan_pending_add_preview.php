<?php
  $id_toko = $_POST['id_toko'];
  $rT = mysqli_fetch_array(mysqli_query($link,"SELECT nm_toko FROM toko WHERE id_toko = '$id_toko'"));
  $id_customer = $_POST['id_customer'];
  $rC = mysqli_fetch_array(mysqli_query($link,"SELECT nm_customer FROM customer WHERE id_customer = '$id_customer'"));
  $tanggal = $_POST['tanggal'];
  $jatuh_tempo = $_POST['jatuh_tempo'];
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data Penjualan Pending
    </h1>
    <ol class="breadcrumb">
      <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Penjualan Pending </li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Preview Penjualan Pending</h3>
          </div><!-- /.box-header -->
          <!-- form start -->
          <form action="home.php?act=<?php echo md5('penjualan_pending_insert')?>" method="post" class="form-horizontal">
            <input type="hidden" name="id_toko" value="<?= $id_toko;?>">
            <input type="hidden" name="id_customer" value="<?= $id_customer;?>">
            <input type="hidden" name="tanggal" value="<?= $tanggal;?>">
            <input type="hidden" name="jatuh_tempo" value="<?= $jatuh_tempo;?>">
            <div class="box-body">
              <div class="form-group">
                <label class="col-sm-2 control-label">Toko</label>
                <div class="col-sm-4">
                  <input type="text" name="Toko" class="form-control pull-right" required value="<?= $rT['nm_toko'];?>" readonly="readonly">
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Tanggal</label>
                <div class="col-sm-3">
                  <div class="input-group date">
                    <input type="text" name="tanggal" class="form-control pull-right" required value="<?= $tanggal;?>" readonly="readonly">
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
                    <input type="text" name="jatuh_tempo" class="form-control pull-right" required value="<?= $jatuh_tempo;?>" readonly="readonly">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Customer</label>
                <div class="col-sm-4">
                  <input type="text" name="Toko" class="form-control pull-right" required value="<?= $rC['nm_customer'];?>" readonly="readonly">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Metode Pembayaran</label>
                <div class="col-sm-2">
                  <select class="form-control select2" name="id_metode" required>
                    <?php
                      $q = mysqli_query($link,"SELECT * FROM _metode Order By nm_metode ASC");
                      while ($r = mysqli_fetch_array($q)) {
                        echo "<option value='$r[id_metode]'>$r[nm_metode]</option>";
                      }
                    ?>
                  </select>
                </div>
              </div>
              <hr>
              <div class="form-group">
                <div class="col-sm-12">
                  <table class="table table-bordered" style="margin-bottom: -3px;">
                    <tr>
                      <th rowspan="2" width="1">No.</td>
                      <th rowspan="2">Kode</td>
                      <th rowspan="2">Nama</td>
                      <th rowspan="2">Harga</td>
                      <th colspan="2">Stok Tersedia</td>
                      <th rowspan="2">Lusin</td>
                      <th rowspan="2">Pcs</td>
                      <th rowspan="2">Sub Total</td>
                    </tr> 
                    <tr>
                      <th>Lusin</th>
                      <th>Pcs</th>
                    </tr>
                    <?php
                    $i = 0;
                    $total = 0;
                    $valid = 0;
                    $kd_produk_size = $_POST['kd_produk_size'];
                    $lusin = $_POST['lusin'];
                    $pcs = $_POST['pcs'];
                    $harga_jual = $_POST['harga_jual'];
                    foreach ($kd_produk_size as $k => $v) {
                      # code...
                      $jumlah = ($lusin[$k] * 12) + $pcs[$k];
                      $i++;
                      $q = mysqli_query($link,"SELECT
                            *
                            FROM
                            stok
                            Inner Join produk_size On produk_size.kd_produk_size = stok.kd_produk_size
                            Inner Join produk ON produk.kd_produk = produk_size.kd_produk
                            WHERE 
                            produk_size.kd_produk_size = '$v'
                            AND stok.id_toko = '$id_toko'
                            ") or die(mysqli_error());
                      $r = mysqli_fetch_array($q);
                      $subtotal = ($lusin[$k] * $harga_jual[$k]) + ($pcs[$k] * ($harga_jual[$k]/12));
                      $total += $subtotal; 

                      if ($jumlah[$k] > $r['jumlah']) 
                      {
                        $valid += 1;
                        $stat = "<a href='#' title='Stok tidak cukup'><i class='glyphicon glyphicon-exclamation-sign'></i></a>";
                      } 
                      else 
                      {
                        $valid += 0;
                        $stat = "";
                      }
                    ?>
                      <input type="hidden" name="kd_produk_size[]" value="<?= $r['kd_produk_size'];?>">
                      <input type="hidden" name="jumlah[]" value="<?= $jumlah;?>">
                      <input type="hidden" name="harga_modal[]" value="<?= $harga_modal[$k];?>">
                      <input type="hidden" name="harga_jual[]" value="<?= $harga_jual[$k];?>">
                      <tr>
                        <td><?= $i;?></td>
                        <td><?= $r['kd_produk_size'];?></td>
                        <td><?= $r['nm_produk'];?></td>
                        <td><?= number_format($harga_jual[$k]);?></td>
                        <td><?= number_format(lusin($r['jumlah']));?></td>
                        <td><?= number_format(pcs($r['jumlah']));?></td>
                        <td><?= number_format($lusin[$k]);?> <?= $stat;?></td>
                        <td><?= number_format($pcs[$k]);?> <?= $stat;?></td>
                        <td><?= number_format($subtotal);?></td>
                      </tr>                   
                    <?php
                    }
                    ?>
                    <tr>
                      <td colspan="7"></td>
                      <td>Total</td>
                      <td><?= number_format($total);?></td>
                      <input type="hidden" name="total" id="total" value="<?= $total;?>">
                    </tr>
                    <tr>
                      <td colspan="7"></td>
                      <td>Pajak (%)</td>
                      <td><input name="pajak" id="pajak" type="number" required="required" style="width: 85px;" value="0" onkeyup="count_pajak(this)" onchange="count_pajak(this)"/></td>
                    </tr>
                    <tr>
                      <td colspan="7"></td>
                      <td>Diskon</td>
                      <td><input name="diskon" id="diskon" type="number" required="required" style="width: 85px;" value="0" onkeyup="count_diskon(this)" onchange="count_diskon(this)"/></td>
                    </tr>
                    <tr style="font-weight: bold;">
                      <td colspan="7"></td>
                      <td>Grand Total</td>
                      <td id="grandtotal"><?= number_format($total);?></td>
                      <input type="hidden" name="grandtotal" id="grandtotal_form" value="<?= $total;?>">
                    </tr>
                  </table>
                </div>
              </div><!-- /.form-group -->
            </div><!-- /.box-body -->

            <div class="box-footer">
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label"></label>
                <div class="col-sm-10 text-right">
                  <?php
                  if ($valid > 0) 
                  {
                    echo "Terdapat item melebihi stok!";
                  } 
                  else 
                  {
                  ?>
                    <button type="submit" class="btn btn-primary" onclick="return confirm('Apakah anda yakin ?')">Submit</button>
                  <?php
                  }
                  ?>
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

<script>
function count_pajak(e) {
  
  if (!/^[0-9,]+$/.test(e.value)) 
  {
    e.value = e.value.substring(0,e.value.length-100);
  }
  
  var pajak = (document.getElementById("total").value * document.getElementById("pajak").value) / 100;
  var grandtotal_form = parseInt(document.getElementById("total").value) + parseInt(pajak);
  var grandtotal = grandtotal_form.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
  document.getElementById("grandtotal").innerHTML = grandtotal;
  document.getElementById("grandtotal_form").value = grandtotal_form;

}

</script>

<script>
function count_diskon(e) {
  
  if (!/^[0-9,]+$/.test(e.value)) 
  {
    e.value = e.value.substring(0,e.value.length-100);
  }
  
  var pajak = (document.getElementById("total").value * document.getElementById("pajak").value) / 100;
  var grandtotal_form = parseInt(document.getElementById("total").value) + parseInt(pajak);
  
  var diskon = document.getElementById("diskon").value;
  var grandtotal_form = parseInt(grandtotal_form) - parseInt(diskon);
  
  var grandtotal = grandtotal_form.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
  document.getElementById("grandtotal").innerHTML = grandtotal;
  document.getElementById("grandtotal_form").value = grandtotal_form;

}

</script>

<script>
function count_bayar(e) {
  
  if (!/^[0-9,]+$/.test(e.value)) 
  {
    e.value = e.value.substring(0,e.value.length-100);
  }
  
  var kembalian = parseInt(document.getElementById("bayar").value) - parseInt(document.getElementById("grandtotal_form").value);
  var kembalian = kembalian.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
  document.getElementById("kembalian").innerHTML = kembalian;

}

</script>