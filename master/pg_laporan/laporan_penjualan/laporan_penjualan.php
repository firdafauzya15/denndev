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
      Data Laporan Penjualan
    </h1>
    <ol class="breadcrumb">
      <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Penjualan</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-body">
            <form action="#" method="get" class="form-horizontal">
              <input type="hidden" name="act" value="047f1a913ea6fa6b232dc455249605cb">
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
                <table class="table">
                  <?php
                  $metodes = mysqli_query($link,"SELECT * FROM _metode ORDER BY id_metode ASC LIMIT 4");
                  while ($metode = mysqli_fetch_array($metodes)) {
                    $limit = 100;
                    $where = "WHERE ";
                    $where .= "penjualan.id_metode = '$metode[id_metode]'";
                    if ($_GET['dari'] != '' AND $_GET['sampai'] != '') {
                      $where .= "AND (date(penjualan.tanggal) >= '$_GET[dari]') AND (date(penjualan.tanggal) <= '$_GET[sampai]') ";
                    } else {
                      $where .= "AND penjualan.tanggal != '' ";
                    }
                    if ($_GET['id_customer'] != '') {
                      $where .= "AND penjualan.id_customer = '$_GET[id_customer]' ";
                    } else {
                      $where .= "AND penjualan.id_customer != '' ";
                    }
                    if ($_GET['id_toko'] != '') {
                      $where .= "AND penjualan.id_toko = '$_GET[id_toko]' ";
                    } else {
                      $where .= "AND penjualan.id_toko != '' ";
                    }

                    $total_omset = 0;
                    $penjualans = mysqli_query($link,"SELECT 
                      _metode.potongan, 
                      penjualan.nota, 
                      penjualan.pajak, 
                      penjualan.diskon, 
                      sum(penjualan_detail.jumlah) AS total 
                      FROM 
                      penjualan 
                      Inner Join _metode ON _metode.id_metode = penjualan.id_metode 
                      Inner Join penjualan_detail ON penjualan_detail.nota = penjualan.nota 
                      $where 
                      GROUP BY penjualan.nota
                      LIMIT $limit
                      ") or die (mysqli_error());
                    while ($penjualan = mysqli_fetch_array($penjualans)) {
                      $omset = 0;
                      $qp = mysqli_query($link,"SELECT 
                            penjualan_detail.harga_jual,
                            penjualan_detail.jumlah
                            FROM 
                            penjualan_detail 
                            WHERE penjualan_detail.nota = '$penjualan[nota]'
                            ") or die (mysqli_error());
                      while ($rp = mysqli_fetch_array($qp)) {
                        $subtotal = (lusin($rp['jumlah']) * $rp['harga_jual']) + (pcs($rp['jumlah']) * ($rp['harga_jual']/12));
                        $omset += $subtotal;
                      }

                      $pajak = ($omset*$penjualan['pajak'])/100;
                      $diskon = ($omset*$penjualan['diskon'])/100;
                      $potongan = ($omset*$penjualan['potongan'])/100;
                      $omset_bersih = $omset + $pajak - $diskon;

                      $total_jumlah += $penjualan['total'];
                      $total_omset_kotor += $omset;
                      $total_diskon += $diskon;
                      $total_pajak += $pajak;
                      $total_potongan += $potongan;
                      $total_omset += $omset_bersih;
                    }

                    $rows = "<tr>";
                    $rows .= "<td>$metode[nm_metode]</td>";
                    $rows .= "<td width='1'><b>".number_format($total_omset,0,',','.')."</b></span></td>";
                    $rows .= "</tr>";
                    echo "$rows";
                  }
                  ?>
                </table>
              </div>
              <div class="col-md-4">
                <table class="table">
                  <?php
                  $metodes = mysqli_query($link,"SELECT * FROM _metode ORDER BY id_metode DESC LIMIT 4");
                  while ($metode = mysqli_fetch_array($metodes)) {
                    $limit = 100;
                    $where = "WHERE ";
                    $where .= "penjualan.id_metode = '$metode[id_metode]'";
                    if ($_GET['dari'] != '' AND $_GET['sampai'] != '') {
                      $where .= "AND (date(penjualan.tanggal) >= '$_GET[dari]') AND (date(penjualan.tanggal) <= '$_GET[sampai]') ";
                    } else {
                      $where .= "AND penjualan.tanggal != '' ";
                    }
                    if ($_GET['id_customer'] != '') {
                      $where .= "AND penjualan.id_customer = '$_GET[id_customer]' ";
                    } else {
                      $where .= "AND penjualan.id_customer != '' ";
                    }
                    if ($_GET['id_toko'] != '') {
                      $where .= "AND penjualan.id_toko = '$_GET[id_toko]' ";
                    } else {
                      $where .= "AND penjualan.id_toko != '' ";
                    }

                    $total_omset = 0;
                    $penjualans = mysqli_query($link,"SELECT 
                      _metode.potongan, 
                      penjualan.nota, 
                      penjualan.pajak, 
                      penjualan.diskon, 
                      sum(penjualan_detail.jumlah) AS total 
                      FROM 
                      penjualan 
                      Inner Join _metode ON _metode.id_metode = penjualan.id_metode 
                      Inner Join penjualan_detail ON penjualan_detail.nota = penjualan.nota 
                      $where 
                      GROUP BY penjualan.nota
                      LIMIT $limit
                      ") or die (mysqli_error());
                    while ($penjualan = mysqli_fetch_array($penjualans)) {
                      $omset = 0;
                      $qp = mysqli_query($link,"SELECT 
                            penjualan_detail.harga_jual,
                            penjualan_detail.jumlah
                            FROM 
                            penjualan_detail 
                            WHERE penjualan_detail.nota = '$penjualan[nota]'
                            ") or die (mysqli_error());
                      while ($rp = mysqli_fetch_array($qp)) {
                        $subtotal = (lusin($rp['jumlah']) * $rp['harga_jual']) + (pcs($rp['jumlah']) * ($rp['harga_jual']/12));
                        $omset += $subtotal;
                      }

                      $pajak = ($omset*$penjualan['pajak'])/100;
                      $diskon = ($omset*$penjualan['diskon'])/100;
                      $potongan = ($omset*$penjualan['potongan'])/100;
                      $omset_bersih = $omset + $pajak - $diskon;

                      $total_jumlah += $penjualan['total'];
                      $total_omset_kotor += $omset;
                      $total_diskon += $diskon;
                      $total_pajak += $pajak;
                      $total_potongan += $potongan;
                      $total_omset += $omset_bersih;
                    }

                    $rows = "<tr>";
                    $rows .= "<td>$metode[nm_metode]</td>";
                    $rows .= "<td width='1'><b>".number_format($total_omset,0,',','.')."</b></td>";
                    $rows .= "</tr>";
                    echo "$rows";
                  }
                  ?>
                </table>
              </div>
              <div class="col-md-4">
                <a class="btn btn-warning" href="#" onClick="MyWindow=window.open('master/pg_laporan/laporan_penjualan/print_laporan_penjualan.php<?= $paramsSearch;?>','MyWindow','width=794,height=842'); return false;"><i class="glyphicon glyphicon-print icon-white"></i> Print</a>
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
                  <th>Pembayaran</th>
                  <th>Lusin</th>
                  <th>Pcs</th>
                  <th>Total</th>
                  <th>Pajak (%)</th>
                  <th>Diskon (%)</th>
                  <th>Potongan (%)</th>
                  <th>Omset</th>
                </tr>
              </thead>
              <tbody>
              <?php
                $i = 0;
                $total_omset_kotor = 0;
                $total_omset = 0;
                $total_diskon = 0;
                $total_pajak = 0;
                $total_potongan = 0;
                $total_jumlah = 0;
                
                $limit = 100;
                $where = "WHERE ";

                if ($_GET['dari'] != '' AND $_GET['sampai'] != '') {
                  $where .= "(date(penjualan.tanggal) >= '$_GET[dari]') AND (date(penjualan.tanggal) <= '$_GET[sampai]') ";
                } else {
                  $where .= "penjualan.tanggal != '' ";
                }

                if ($_GET['id_customer'] != '') {
                  $where .= "AND penjualan.id_customer = '$_GET[id_customer]' ";
                } else {
                  $where .= "AND penjualan.id_customer != '' ";
                }

                if ($_GET['id_toko'] != '') {
                  $where .= "AND penjualan.id_toko = '$_GET[id_toko]' ";
                } else {
                  $where .= "AND penjualan.id_toko != '' ";
                }

                $q = mysqli_query($link,"SELECT 
                      penjualan.id_penjualan, 
                      penjualan.nota, 
                      penjualan.id_toko, 
                      penjualan.tanggal, 
                      penjualan.pajak, 
                      penjualan.diskon, 
                      penjualan.online, 
                      customer.nm_customer, 
                      _metode.nm_metode, 
                      _metode.potongan, 
                      sum(penjualan_detail.jumlah) AS total 
                      FROM 
                      penjualan 
                      Inner Join _metode ON _metode.id_metode = penjualan.id_metode 
                      Inner Join customer ON customer.id_customer = penjualan.id_customer 
                      Inner Join penjualan_detail ON penjualan_detail.nota = penjualan.nota 
                      $where
                      Group By penjualan.id_penjualan
                      Order By penjualan.id_penjualan DESC
                      LIMIT $limit
                      ") or die (mysqli_error());
                while ($r = mysqli_fetch_array($q)) {
                  $i++;
                  $id_penjualan = base64_encode($r['id_penjualan']);
                  $nota = base64_encode($r['nota']);

                  $toko = mysqli_fetch_array(mysqli_query($link,"SELECT * FROM toko WHERE id_toko = '$r[id_toko]'"));
                  $namaToko = $toko['nm_toko'];
                  if ($toko['nm_toko'] == null) {
                    $namaToko = "-";
                  }

                  $omset = 0;
                  $qp = mysqli_query($link,"SELECT 
                        penjualan_detail.harga_jual,
                        penjualan_detail.jumlah
                        FROM 
                        penjualan_detail 
                        WHERE penjualan_detail.nota = '$r[nota]'
                        ") or die (mysqli_error());
                  while ($rp = mysqli_fetch_array($qp)) {
                    $subtotal = (lusin($rp['jumlah']) * $rp['harga_jual']) + (pcs($rp['jumlah']) * ($rp['harga_jual']/12));
                    $omset += $subtotal;
                  }

                  $pajak = ($omset*$r['pajak'])/100;
                  $diskon = ($omset*$r['diskon'])/100;
                  $potongan = ($omset*$r['potongan'])/100;
                  $omset_bersih = $omset + $pajak - $diskon;

                  $total_jumlah += $r['total'];
                  $total_omset_kotor += $omset;
                  $total_diskon += $diskon;
                  $total_pajak += $pajak;
                  $total_potongan += $potongan;
                  $total_omset += $omset_bersih;

                  $link = "penjualan_detail";
                  if ($toko['nm_toko'] == null) {
                    $link = "penjualan_kantor_detail";
                  }
              ?>
                  <tr>
                    <td><?= $i;?></td>
                    <td><?= $r['tanggal'];?></td>
                    <td><a href="?act=<?php echo md5($link)."&nota=$nota"?>" target="blank" title="Detail Penjualan"><?= $r['nota'];?></a></td>
                    <td><?= $namaToko;?></td>
                    <td><?= $r['nm_customer'];?></td>
                    <td><?= $r['nm_metode'];?></td>
                    <td><?= number_format(lusin($r['total']));?></td>
                    <td><?= number_format(pcs($r['total']));?></td>
                    <td><?= number_format($omset);?></td>
                    <td><?= number_format($pajak);?> (<?= $r['pajak'];?>)</td>
                    <td><?= number_format($diskon);?> (<?= $r['diskon'];?>)</td>
                    <td><?= number_format($potongan);?> (<?= $r['potongan'];?>)</td>
                    <td><?= number_format($omset_bersih);?></td>
                  </tr>
              <?php
                }
              ?>
                <tr style="font-weight: bold;">
                  <td colspan="8" align="right">Total</td>
                  <td><?= number_format($total_omset_kotor);?></td>  
                  <td><?= number_format($total_pajak);?></td>  
                  <td><?= number_format($total_diskon);?></td>  
                  <td><?= number_format($total_potongan);?></td>  
                  <td><?= number_format($total_omset);?></td>  
                </tr>
              </tbody>
            </table>
          </div><!-- /.box-body -->
        </div><!-- /.box -->
      </div><!-- /.col -->
    </div><!-- /.row -->

  </section><!-- /.content -->
</div><!-- /.content-wrapper -->