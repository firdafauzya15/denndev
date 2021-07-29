<?php
$cari = $_POST['cari'];
$id_potong = $_POST['id_potong'];
$dari = $_POST['dari'];
$sampai = $_POST['sampai'];
if ($_POST['cari'] != "") {
  $paramsSearch = "?id_potong=$_POST[id_potong]&dari=$_POST[dari]&sampai=$_POST[sampai]&cari=$_POST[cari]";
} else {
  $paramsSearch = "";
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data Laporan Pembayaran SPK Cutting
    </h1>
    <ol class="breadcrumb">
      <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">SPK Cutting</li>
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
                <div class="col-md-3">
                  <select class="form-control select2" name="id_potong">
                    <option value="">.:: Pilih Tukang Potong ::.</option>
                    <?php
                      $q = mysqli_query($link,"SELECT * FROM potong Order By nm_potong ASC");
                      while ($r = mysqli_fetch_array($q)) {
                        if ($id_potong == $r['id_potong']) {
                          echo "<option value='$r[id_potong]' selected>$r[nm_potong]</option>";
                        } else {
                          echo "<option value='$r[id_potong]'>$r[nm_potong]</option>";
                        }
                      }
                    ?>
                  </select>
                </div>
                <div class="col-md-2">
                  <div class="input-group date">
                    <input type="text" name="dari" class="form-control pull-right" id="datepicker" required placeholder="Dari" value="<?= $dari;?>">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="input-group date">
                    <input type="text" name="sampai" class="form-control pull-right" id="datepicker2" required placeholder="Sampai" value="<?= $sampai;?>">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                  </div>
                </div>
                <div class="col-md-1">
                  <input type="submit" class="btn btn-primary" value="cari" name="cari">
                </div>
                <div class="col-md-4">
                  <a class="btn btn-warning" href="#" onClick="MyWindow=window.open('master/pg_laporan/laporan_pembayaran_cutting/print_laporan_pembayaran_cutting.php<?= $paramsSearch;?>','MyWindow','width=794,height=842'); return false;"><i class="glyphicon glyphicon-print icon-white"></i> Print</a>
                </div>
              </div>
            </form>
            <hr>
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th width="1">No.</th>
                  <th>Tanggal</th>
                  <th>Nota</th>
                  <th>Tukang Potong</th>
                  <th>Lusin</th>
                  <th>Pcs</th>
                  <th>Harga</th>
                  <th>Total</th>
                  <th width="1">Lunas</th>
                </tr>
              </thead>
              <tbody>
              <?php
                $i = 0;
                $total_harga = 0;
                $q_where = "";
                $q_date = "";
                $limit = "LIMIT 100";

                if (isset($cari)) {

                  $q_where = "WHERE";

                  if ($id_potong == '') {
                    $q_potong = "spk_cutting.id_potong != '' AND";
                  } else {
                    $q_potong = "spk_cutting.id_potong = '$id_potong' AND";
                  }

                  if ($dari == '' OR $sampai == '') {
                    $q_date = "spk_cutting_pengiriman.tanggal != '' AND spk_cutting_pengiriman.tanggal != ''";
                  } else {
                    $q_date = "(date(spk_cutting_pengiriman.tanggal) >= '$dari') AND (date(spk_cutting_pengiriman.tanggal) <= '$sampai')";
                  }

                  $limit = "";

                }

                $q = mysqli_query($link,"SELECT 
                      potong.nm_potong, 
                      spk_cutting_pengiriman.id_spk_cutting_pengiriman,
                      spk_cutting_pengiriman.tanggal,
                      spk_cutting_pengiriman.jumlah,
                      spk_cutting_pengiriman.lunas,
                      spk_cutting.nota, 
                      spk_cutting.harga
                      FROM 
                      spk_cutting_pengiriman
                      INNER JOIN spk_cutting ON spk_cutting.nota = spk_cutting_pengiriman.nota 
                      INNER JOIN potong ON potong.id_potong = spk_cutting.id_potong
                      $q_where
                      $q_potong
                      $q_date
                      Group By spk_cutting_pengiriman.id_spk_cutting_pengiriman
                      Order By spk_cutting_pengiriman.id_spk_cutting_pengiriman DESC
                      $limit
                      ") or die (mysqli_error());
                while ($r = mysqli_fetch_array($q)) {
                  $i++;
                  $nota = base64_encode($r['nota']);
                  $id_spk_cutting_pengiriman = base64_encode($r['id_spk_cutting_pengiriman']);
                  $nol = base64_encode("0");
                  $satu = base64_encode("1");
                  $subtotal = (lusin($r['jumlah']) * $r['harga']) + (pcs($r['jumlah']) * ($r['harga']/12));
                  $total_harga += $subtotal;
                  $lunas = "<a href='?act=".md5('laporan_pembayaran_cutting_approve')."&id_spk_cutting_pengiriman=$id_spk_cutting_pengiriman&lns=$satu' title='Lunasi Pembayaran' onclick='return confirm(\"Apakah anda yakin?\")'><span class='label label-warning'>Pending</span></a>";
                  if ($r['lunas'] == '1') {
                    $lunas = "<a href='?act=".md5('laporan_pembayaran_cutting_approve')."&id_spk_cutting_pengiriman=$id_spk_cutting_pengiriman&lns=$nol' title='Batalkan Pelunasan' onclick='return confirm(\"Apakah anda yakin?\")'><span class='label label-success'>Done</span></a>";
                  }
              ?>
                  <tr>
                    <td><?= $i;?></td>
                    <td><?= $r['tanggal'];?></td>
                    <td><a href="?act=<?php echo md5('spk_cutting_detail')."&nota=$nota"?>" target="blank" title="Detail SPK Cutting"><?= $r['nota'];?></a></td>
                    <td><?= $r['nm_potong'];?></td>
                    <td><?= number_format(lusin($r['jumlah']));?></td>
                    <td><?= number_format(pcs($r['jumlah']));?></td>
                    <td><?= number_format($r['harga']);?></td>
                    <td><?= number_format($subtotal);?></td>
                    <td><?= $lunas;?></td>
                  </tr>
              <?php
                }
              ?>
                <tr style="font-weight: bold;">
                  <td colspan="7" align="right">Total</td>
                  <td><?= number_format($total_harga);?></td>  
                  <td></td>
                </tr>
              </tbody>
            </table>
          </div><!-- /.box-body -->
        </div><!-- /.box -->
      </div><!-- /.col -->
    </div><!-- /.row -->

  </section><!-- /.content -->
</div><!-- /.content-wrapper -->