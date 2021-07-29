<?php
$cari = $_POST['cari'];
$id_vendor = $_POST['id_vendor'];
$dari = $_POST['dari'];
$sampai = $_POST['sampai'];
if ($_POST['cari'] != "") {
  $paramsSearch = "?id_vendor=$_POST[id_vendor]&dari=$_POST[dari]&sampai=$_POST[sampai]&cari=$_POST[cari]";
} else {
  $paramsSearch = "";
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data Laporan Pembayaran Sablon
    </h1>
    <ol class="breadcrumb">
      <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Sablon</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-body">
            <form action="#" method="post" class="form-horizontal">
              <div class="row">
                <div class="col-md-2">
                  <select class="form-control select2" name="id_vendor">
                    <option value="">.:: Pilih Vendor ::.</option>
                    <?php
                      $q = mysqli_query($link,"SELECT * FROM vendor Order By nm_vendor ASC");
                      while ($r = mysqli_fetch_assoc($q)) {
                        if ($id_vendor == $r['id_vendor']) {
                          echo "<option value='$r[id_vendor]' selected>$r[nm_vendor]</option>";
                        } else {
                          echo "<option value='$r[id_vendor]'>$r[nm_vendor]</option>";
                        }
                      }
                    ?>
                  </select>
                </div>
                <div class="col-md-2">
                  <div class="input-group date">
                    <input type="text" name="dari" class="form-control pull-right" id="datepicker" placeholder="Dari" value="<?= $dari;?>">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="input-group date">
                    <input type="text" name="sampai" class="form-control pull-right" id="datepicker2" placeholder="Sampai" value="<?= $sampai;?>">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                  </div>
                </div>
                <div class="col-md-1">
                  <input type="submit" class="btn btn-primary" value="cari" name="cari">
                </div>
              </div>
            </form>
            <hr>
            <form action="" id="formAct" method="post">
              <input type="hidden" name="id_cmt" value="<?= $_POST['id_cmt'];?>">
              <button type="button" id="printBatch" class="btn btn-warning"><span class="fa fa-print"></span> Print</button>
              <br><br>
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th width="1">No.</th>
                    <th width="1"><input type="checkbox" onclick="toggle(this);" /></th>
                    <th>Tanggal</th>
                    <th>Nota SPK</th>
                    <th>Nota</th>
                    <th>Vendor</th>
                    <th>Harga</th>
                    <th width="1">Lusin</th>
                    <th width="1">Pcs</th>
                    <th>Total</th>
                    <th width="1">Lunas</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  $i = 0;
                  $total_harga = 0;
                  $q_where = "";
                  $q_vendor = "";
                  $q_date = "";
                  $limit = "LIMIT 100";

                  if (isset($cari)) {

                    $q_where = "WHERE";

                    if ($id_vendor == '') {
                      $q_vendor = "sablon.id_vendor != '' AND";
                    } else {
                      $q_vendor = "sablon.id_vendor = '$id_vendor' AND";
                    }

                    if ($dari == '' OR $sampai == '') {
                      $q_date = "sablon_pengiriman.tanggal != '' AND sablon_pengiriman.tanggal != ''";
                    } else {
                      $q_date = "(date(sablon_pengiriman.tanggal) >= '$dari') AND (date(sablon_pengiriman.tanggal) <= '$sampai')";
                    }
                    
                    $limit = "";

                  }

                  $q = mysqli_query($link,"SELECT 
                        sablon_pengiriman.id_sablon_pengiriman,
                        sablon_pengiriman.jumlah,
                        sablon_pengiriman.tanggal,
                        vendor.nm_vendor, 
                        sablon.id_sablon, 
                        sablon.nota_spk,
                        sablon.nota,
                        sablon.harga,
                        sablon_pengiriman.lunas
                        FROM 
                        sablon_pengiriman 
                        INNER JOIN sablon_detail ON sablon_detail.id_sablon_detail = sablon_pengiriman.id_sablon_detail
                        INNER JOIN sablon ON sablon.nota = sablon_detail.nota
                        INNER JOIN vendor ON vendor.id_vendor = sablon.id_vendor
                        $q_where
                        $q_vendor
                        $q_date
                        GROUP BY sablon_pengiriman.id_sablon_pengiriman
                        ORDER BY sablon_pengiriman.id_sablon_pengiriman DESC
                        $limit
                        ") or die (mysqli_error());
                  while ($r = mysqli_fetch_assoc($q)) {
                    $i++;
                    $id_sablon_pengiriman = base64_encode($r['id_sablon_pengiriman']);
                    $nota = base64_encode($r['nota']);
                    $nol = base64_encode("0");
                    $satu = base64_encode("1");
                    $subtotal = (lusin($r['jumlah']) * $r['harga']) + (pcs($r['jumlah']) * ($r['harga']/12));
                    $total_harga += $subtotal;

                    $lunas = "<a href='?act=".md5('laporan_pembayaran_sablon_approve')."&id_sablon_pengiriman=$id_sablon_pengiriman&lns=$satu' title='Lunasi Pembayaran $r[nota]' onclick='return confirm(\"Apakah anda yakin?\")'><span class='label label-warning'>Pending</span></a>";
                    if ($r['lunas'] == '1') {
                      $lunas = "<a href='?act=".md5('laporan_pembayaran_sablon_approve')."&id_sablon_pengiriman=$id_sablon_pengiriman&lns=$nol' title='Batalkan Pelunasan $r[nota]' onclick='return confirm(\"Apakah anda yakin?\")'><span class='label label-success'>Done</span></a>";
                    }
                ?>
                    <tr>
                      <td><?= $i;?></td>
                      <td><input type="checkbox" name="ids[]" value="<?= $r['id_sablon_pengiriman'];?>"></td>
                      <td><?= $r['tanggal'];?></td>
                      <td><?= $r['nota_spk'];?></td>
                      <td><a href="?act=<?php echo md5('sablon_detail')."&nota=$nota"?>" target="blank" title="Detail Sablon"><?= $r['nota'];?></a></td>
                      <td><?= $r['nm_vendor'];?></td>
                      <td><?= number_format($r['harga']);?></td>
                      <td><?= number_format(lusin($r['jumlah']));?></td>
                      <td><?= number_format(pcs($r['jumlah']));?></td>
                      <td><?= number_format($subtotal);?></td>
                      <td><?= $lunas;?></td>
                    </tr>
                <?php
                  }
                ?>
                  <tr style="font-weight: bold;">
                    <td colspan="9" align="right">Total</td>
                    <td><?= number_format($total_harga);?></td>  
                    <td></td>
                  </tr>
                </tbody>
              </table>
            </form>
          </div><!-- /.box-body -->
        </div><!-- /.box -->
      </div><!-- /.col -->
    </div><!-- /.row -->

  </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<script>
var form = document.getElementById('formAct');
/*
document.getElementById('lanjut').onclick = function() {
  form.action = "home.php?module=<?php echo "$url&act=".md5("preview_manpenjualan");?>";
  form.target = '_self';
  form.submit();
}
*/

document.getElementById('printBatch').onclick = function() {
  window.open('', 'formpopup', 'width=794,height=842,resizeable,scrollbars');
  form.action = "master/pg_laporan/laporan_pembayaran_sablon/print_laporan_pembayaran_sablon.php";
  form.target = 'formpopup';
  form.submit();
}
</script>