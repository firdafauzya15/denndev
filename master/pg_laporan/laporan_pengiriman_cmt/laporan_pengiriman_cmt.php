<?php
$cari = $_POST['cari'];
$id_cmt = $_POST['id_cmt'];
$dari = $_POST['dari'];
$sampai = $_POST['sampai'];
if ($_POST['cari'] != "") {
  $paramsSearch = "?id_cmt=$_POST[id_cmt]&dari=$_POST[dari]&sampai=$_POST[sampai]&cari=$_POST[cari]";
} else {
  $paramsSearch = "";
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data Laporan Pengiriman Produksi CMT
    </h1>
    <ol class="breadcrumb">
      <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Produksi CMT</li>
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
                  <select class="form-control select2" name="id_cmt">
                    <option value="">.:: Pilih CMT ::.</option>
                    <?php
                      $q = mysqli_query($link,"SELECT * FROM cmt Order By nm_cmt ASC");
                      while ($r = mysqli_fetch_array($q)) {
                        if ($id_cmt == $r['id_cmt']) {
                          echo "<option value='$r[id_cmt]' selected>$r[nm_cmt]</option>";
                        } else {
                          echo "<option value='$r[id_cmt]'>$r[nm_cmt]</option>";
                        }
                      }
                    ?>
                  </select>
                </div>
                <!--
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
                -->
                <div class="col-md-1">
                  <input type="submit" class="btn btn-primary" value="cari" name="cari">
                </div>
              </div>
            </form>
            <hr>
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th rowspan="2" width="1">No.</th>
                  <th rowspan="2">CMT</th>
                  <th rowspan="2">Kode Produk</th>
                  <th colspan="2">Produksi</th>
                  <th colspan="2">Terkirim</th>
                  <th colspan="2">Pending</th>
                </tr>
                <tr>
                  <th width="100">Lusin</th>
                  <th width="100">Pcs</th>
                  <th width="100">Lusin</th>
                  <th width="100">Pcs</th>
                  <th width="100">Lusin</th>
                  <th width="100">Pcs</th>
                </tr>
              </thead>
              <tbody>
              <?php
                $i = 0;
                $totalProduksi = 0;
                $totalKirim = 0;
                $totalPending = 0;
                $q_where = "";
                $q_cmt = "";
                $q_date = "";
                $limit = "LIMIT 100";

                if (isset($cari)) {

                  $q_where = "WHERE";

                  if ($id_cmt == '') {
                    $q_cmt = "produksi.id_cmt != '' AND";
                  } else {
                    $q_cmt = "produksi.id_cmt = '$id_cmt' AND";
                  }

                  if ($dari == '' OR $sampai == '') {
                    $q_date = "produksi.tanggal != '' AND produksi.tanggal != ''";
                  } else {
                    $q_date = "(date(produksi.tanggal) >= '$dari') AND (date(produksi.tanggal) <= '$sampai')";
                  }
                  
                  $limit = "";

                }

                $q = mysqli_query($link,"SELECT
                      produksi.id_cmt,
                      produksi.nota,
                      produksi_detail.id_produksi_detail,
                      produksi_detail.kd_produk_size,
                      produksi_detail.jumlah
                      FROM 
                      produksi
                      INNER JOIN produksi_detail ON produksi_detail.nota = produksi.nota
                      $q_where
                      $q_cmt
                      $q_date
                      GROUP BY produksi_detail.kd_produk_size, produksi.id_cmt
                      ORDER BY produksi.id_produksi DESC
                      $limit
                      ") or die (mysqli_error());
                while ($r = mysqli_fetch_array($q)) {
                  $i++;
                  $nota = base64_encode($r['nota']);     
                  $cmt = mysqli_fetch_array(mysqli_query($link,"SELECT * FROM cmt WHERE id_cmt = '$r[id_cmt]'"));
                  $produksiPengiriman = mysqli_fetch_array(mysqli_query($link,"SELECT 
                    SUM(produksi_pengiriman.jumlah) AS jumlah 
                    FROM 
                    produksi_pengiriman
                    WHERE 
                    produksi_pengiriman.id_produksi_detail = '$r[id_produksi_detail]' 
                    "));
                  $pending = $r['jumlah'] - $produksiPengiriman['jumlah'];
                  $totalProduksi += $r['jumlah'];
                  $totalKirim += $produksiPengiriman['jumlah'];
                  $totalPending += $pending;
              ?>
                  <tr>
                    <td><?= $i;?></td>
                    <td><?= $cmt['nm_cmt'];?></td>
                    <td><?= $r['kd_produk_size'];?></td>
                    <td><?= number_format(lusin($r['jumlah']));?></td>
                    <td><?= number_format(pcs($r['jumlah']));?></td>
                    <td><?= number_format(lusin($produksiPengiriman['jumlah']));?></td>
                    <td><?= number_format(pcs($produksiPengiriman['jumlah']));?></td>
                    <td><?= number_format(lusin($pending));?></td>
                    <td><?= number_format(pcs($pending));?></td>
                  </tr>
              <?php
                }
              ?>
                <tr>
                  <th colspan="3">Total</th>
                  <th><?= number_format(lusin($totalProduksi));?></th>
                  <th><?= number_format(pcs($totalProduksi));?></th>
                  <th><?= number_format(lusin($totalKirim));?></th>
                  <th><?= number_format(pcs($totalKirim));?></th>
                  <th><?= number_format(lusin($totalPending));?></th>
                  <th><?= number_format(pcs($totalPending));?></th>
                </tr>
              </tbody>
            </table>
          </div><!-- /.box-body -->
        </div><!-- /.box -->
      </div><!-- /.col -->
    </div><!-- /.row -->

  </section><!-- /.content -->
</div><!-- /.content-wrapper -->