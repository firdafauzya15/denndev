<?php
if ($_GET['cari'] != "") {
  $paramsSearch = "?id_toko=$_GET[id_toko]&id_customer=$_GET[id_customer]&dari=$_GET[dari]&sampai=$_GET[sampai]&cari=$_GET[cari]";
} else {
  $paramsSearch = "";
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data Laporan Retur Penjualan
    </h1>
    <ol class="breadcrumb">
      <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Retur Penjualan</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-body">
            <form action="#" method="get" class="form-horizontal">
              <input type="hidden" name="act" value="8679e200d4069293f2e12ea0db34bcc1">
              <div class="row">
                <div class="col-md-3">
                  <select class="form-control select2" name="id_toko">
                    <option value="">.:: Semua Toko ::.</option>
                    <?php
                      $q = mysqli_query($link,"SELECT * FROM toko Order By nm_toko ASC");
                      while ($r = mysqli_fetch_array($q)) {
                        if ($_GET['id_toko'] == $r['id_toko']) {
                          echo "<option value='$r[id_toko]' selected>$r[nm_toko]</option>";
                        } else {
                          echo "<option value='$r[id_toko]'>$r[nm_toko]</option>";
                        }
                      }
                    ?>
                  </select>
                </div>
                <div class="col-md-3">
                  <select class="form-control select2" name="id_customer">
                    <option value="">.:: Semua Customer ::.</option>
                    <?php
                      $q = mysqli_query($link,"SELECT * FROM customer Order By nm_customer ASC");
                      while ($r = mysqli_fetch_array($q)) {
                        if ($_GET['id_customer'] == $r['id_customer']) {
                          echo "<option value='$r[id_customer]' selected>$r[nm_customer]</option>";
                        } else {
                          echo "<option value='$r[id_customer]'>$r[nm_customer]</option>";
                        }
                      }
                    ?>
                  </select>
                </div>
                <div class="col-md-2">
                  <div class="input-group date">
                    <input type="text" name="dari" class="form-control pull-right" id="datepicker" placeholder="Dari" value="<?= $_GET['dari'];?>">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="input-group date">
                    <input type="text" name="sampai" class="form-control pull-right" id="datepicker2" placeholder="Sampai" value="<?= $_GET['sampai'];?>">
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
            <div class="row">
              <div class="col-md-4">
                <a class="btn btn-warning" href="#" onClick="MyWindow=window.open('master/pg_laporan/laporan_retur_penjualan/print_laporan_retur_penjualan.php<?= $paramsSearch;?>','MyWindow','width=794,height=842'); return false;"><i class="glyphicon glyphicon-print icon-white"></i> Print</a>
              </div>
            </div>
            <hr>
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th width="1">No.</th>
                  <th>Tanggal</th>
                  <th>Nota</th>
                  <th>Toko</th>
                  <th>Customer</th>
                  <th>Nominal</th>
                </tr>
              </thead>
              <tbody>
              <?php
                $i = 0;
                $grandTotal = 0;
                
                $limit = 100;
                $where = "WHERE ";

                if ($_GET['dari'] != '' AND $_GET['sampai'] != '') {
                  $where .= "(date(retur_penjualan.tanggal) >= '$_GET[dari]') AND (date(retur_penjualan.tanggal) <= '$_GET[sampai]') ";
                } else {
                  $where .= "retur_penjualan.tanggal != '' ";
                }

                if ($_GET['id_customer'] != '') {
                  $where .= "AND retur_penjualan.id_customer = '$_GET[id_customer]' ";
                } else {
                  $where .= "AND retur_penjualan.id_customer != '' ";
                }

                if ($_GET['id_toko'] != '') {
                  $where .= "AND retur_penjualan.id_toko = '$_GET[id_toko]' ";
                } else {
                  $where .= "AND retur_penjualan.id_toko != '' ";
                }

                $q = mysqli_query($link,"SELECT 
                      retur_penjualan.id_retur_penjualan, 
                      retur_penjualan.nota, 
                      retur_penjualan.id_toko, 
                      retur_penjualan.tanggal,
                      customer.nm_customer, 
                      sum(retur_penjualan_detail.jumlah) AS total 
                      FROM 
                      retur_penjualan 
                      Inner Join customer ON customer.id_customer = retur_penjualan.id_customer 
                      Inner Join retur_penjualan_detail ON retur_penjualan_detail.nota = retur_penjualan.nota 
                      $where
                      Group By retur_penjualan.id_retur_penjualan
                      Order By retur_penjualan.id_retur_penjualan DESC
                      LIMIT $limit
                      ") or die (mysqli_error());
                while ($r = mysqli_fetch_array($q)) {
                  $i++;
                  $id_retur_penjualan = base64_encode($r['id_retur_penjualan']);
                  $nota = base64_encode($r['nota']);

                  $toko = mysqli_fetch_array(mysqli_query($link,"SELECT * FROM toko WHERE id_toko = '$r[id_toko]'"));
                  $namaToko = $toko['nm_toko'];
                  if ($toko['nm_toko'] == null) {
                    $namaToko = "-";
                  }

                  $subTotal = 0;
                  $qp = mysqli_query($link,"SELECT 
                        retur_penjualan_detail.harga_jual,
                        retur_penjualan_detail.jumlah
                        FROM 
                        retur_penjualan_detail 
                        WHERE retur_penjualan_detail.nota = '$r[nota]'
                        ") or die (mysqli_error());
                  while ($rp = mysqli_fetch_array($qp)) {
                    $subTotal += (lusin($rp['jumlah']) * $rp['harga_jual']) + (pcs($rp['jumlah']) * ($rp['harga_jual']/12));
                  }

                  $grandTotal += $subTotal;

                  $link = "retur_penjualan_detail";
              ?>
                  <tr>
                    <td><?= $i;?></td>
                    <td><?= $r['tanggal'];?></td>
                    <td><a href="?act=<?php echo md5($link)."&nota=$nota"?>" target="blank" title="Detail Retur Penjualan"><?= $r['nota'];?></a></td>
                    <td><?= $namaToko;?></td>
                    <td><?= $r['nm_customer'];?></td>
                    <td><?= number_format($subTotal);?></td>
                  </tr>
              <?php
                }
              ?>
                <tr style="font-weight: bold;">
                  <td colspan="5" align="right">Total</td>
                  <td><?= number_format($grandTotal);?></td>  
                </tr>
              </tbody>
            </table>
          </div><!-- /.box-body -->
        </div><!-- /.box -->
      </div><!-- /.col -->
    </div><!-- /.row -->

  </section><!-- /.content -->
</div><!-- /.content-wrapper -->