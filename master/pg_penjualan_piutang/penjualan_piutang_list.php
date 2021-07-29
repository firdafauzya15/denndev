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
      Data Piutang
    </h1>
    <ol class="breadcrumb">
      <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Piutang</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-body">
            <form action="#" method="get" class="form-horizontal">
              <input type="hidden" name="act" value="512147035c12f16bb88aa30031c29747">
              <div class="row">
                <div class="col-md-3">
                  <select class="form-control select2" name="id_toko" id="id_toko">
                    <option value="">Semua Toko</option>
                    <?php
                      $tokos = mysqli_query($link,"SELECT * FROM toko ORDER BY nm_toko ASC");
                      while ($toko = mysqli_fetch_array($tokos)) {
                        $selected = "";
                        if ($toko['id_toko'] == $_GET['id_toko']) {
                          $selected = "selected";
                        }
                        echo "<option value='$toko[id_toko]' $selected>$toko[nm_toko]</option>";
                      }
                    ?>
                  </select>
                </div>
                <div class="col-md-3">
                  <select class="form-control select2" name="id_customer" id="id_customer">
                    <option value="">Semua Customer</option>
                    <?php
                      $customers = mysqli_query($link,"SELECT * FROM customer ORDER BY nm_customer ASC");
                      while ($customer = mysqli_fetch_array($customers)) {
                        $selected = "";
                        if ($customer['id_customer'] == $_GET['id_customer']) {
                          $selected = "selected";
                        }
                        echo "<option value='$customer[id_customer]' $selected>$customer[nm_customer]</option>";
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
              <br>
              <div class="row">
                <div class="col-md-1">
                  <a class="btn btn-warning" href="#" onClick="MyWindow=window.open('master/pg_penjualan_piutang/print_penjualan_piutang.php<?= $paramsSearch;?>','MyWindow','width=794,height=842'); return false;"><i class="glyphicon glyphicon-print icon-white"></i> Print</a>
                </div>
              </div>
            </form>
            <hr>
            <table class="table">
              <thead>
                <tr>
                  <th width="1">No.</th>
                  <th width="100">Aksi</th>
                  <th>Tanggal</th>
                  <th>Nota</th>
                  <th>Toko</th>
                  <th>Customer</th>
                  <th>Total Belanja</th>
                  <th width="1">Status</th>
                </tr>
              </thead>
              <tbody>
              <?php
                $i = 0;
                $limit = 100;
                $where = "WHERE ";
                if ($_GET['dari'] != '' AND $_GET['sampai'] != '') {
                  $where .= "(date(penjualan.tanggal) >= '$_GET[dari]') AND (date(penjualan.tanggal) <= '$_GET[sampai]') AND ";
                } else {
                  $where .= "penjualan.tanggal != '' AND ";
                }

                if ($_GET['id_toko'] != '') {
                  $where .= "penjualan.id_toko = '$_GET[id_toko]' AND ";
                } else {
                  $where .= "penjualan.id_toko != ''  AND ";
                }

                if ($_GET['id_customer'] != '') {
                  $where .= "penjualan.id_customer = '$_GET[id_customer]' ";
                } else {
                  $where .= "penjualan.id_customer != '' ";
                }
                $q = mysqli_query($link,"SELECT 
                      penjualan.nota, 
                      penjualan.id_toko, 
                      penjualan.tanggal, 
                      penjualan.pajak, 
                      penjualan.diskon, 
                      penjualan.status, 
                      toko.nm_toko,
                      customer.nm_customer
                      FROM 
                      penjualan 
                      Inner Join toko ON toko.id_toko = penjualan.id_toko 
                      Inner Join customer ON customer.id_customer = penjualan.id_customer 
                      $where
                      AND penjualan.online = '0'
                      AND penjualan.id_metode = '5'
                      Group By penjualan.id_penjualan
                      Order By penjualan.id_penjualan DESC
                      ") or die (mysqli_error());
                while ($r = mysqli_fetch_array($q)) {
                  $nota = base64_encode($r['nota']);
                  $id_toko = base64_encode($r['id_toko']);
                  $i++;
                  $nol = base64_encode("0");
                  $satu = base64_encode("1");
                  $status = "<a href='?act=".md5('penjualan_piutang_update')."&nota=$nota&lns=$satu' title='Lunasi Pembayaran $r[nota]' onclick='return confirm(\"Apakah anda yakin?\")'><span class='label label-warning'>Pending</span></a>";
                  if ($r['status'] == '1') {
                    $status = "<a href='?act=".md5('penjualan_piutang_update')."&nota=$nota&lns=$nol' title='Batalkan Pelunasan $r[nota]' onclick='return confirm(\"Apakah anda yakin?\")'><span class='label label-success'>Done</span></a>";
                  }

                  $total = 0;
                  $penjualanDetails = mysqli_query($link,"SELECT 
                        penjualan_detail.jumlah, 
                        penjualan_detail.harga_jual
                        FROM 
                        penjualan_detail 
                        WHERE penjualan_detail.nota = '$r[nota]'
                        ") or die (mysqli_error());
                  while ($penjualanDetail = mysqli_fetch_array($penjualanDetails)) {
                    $subtotal = (lusin($penjualanDetail['jumlah']) * $penjualanDetail['harga_jual']) + (pcs($penjualanDetail['jumlah']) * ($penjualanDetail['harga_jual']/12));
                    $total += $subtotal;
                  }
                  $pajak = ($total*$r['pajak'])/100;
                  $diskon = ($total*$r['diskon'])/100;
                  $grandtotal = $total + $pajak - $diskon;
              ?>
                  <tr>
                    <td><?= $i;?></td>
                    <td>
                      <div class="btn-group">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-cog"></i></button>
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                          <span class="caret"></span>
                          <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="?act=<?php echo md5('penjualan_piutang_detail')."&nota=$nota"?>"><i class="fa fa-eye"></i>Detail</a></li>
                        </ul>
                      </div>
                    </td>
                    <td><?= $r['tanggal'];?></td>
                    <td><?= $r['nota'];?></td>
                    <td><?= $r['nm_toko'];?></td>
                    <td><?= $r['nm_customer'];?></td>
                    <td><?= number_format($grandtotal);?></td>
                    <td><?= $status;?></td>
                  </tr>
              <?php
                }
              ?>
              </tbody>
            </table>
          </div><!-- /.box-body -->
        </div><!-- /.box -->
      </div><!-- /.col -->
    </div><!-- /.row -->

  </section><!-- /.content -->
</div><!-- /.content-wrapper -->