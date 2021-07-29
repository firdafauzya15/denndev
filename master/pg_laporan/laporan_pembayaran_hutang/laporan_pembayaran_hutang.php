<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data Laporan Pembayaran Hutang
    </h1>
    <ol class="breadcrumb">
      <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Pembayaran Hutang</li>
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
                <div class="col-md-3">
                  <select class="form-control select2" name="id_metode">
                    <option value="">.:: Semua Metode ::.</option>
                    <?php
                      $q = mysqli_query($link,"SELECT * FROM _metode Order By nm_metode ASC");
                      while ($r = mysqli_fetch_array($q)) {
                        if ($_GET['id_metode'] == $r['id_metode']) {
                          echo "<option value='$r[id_metode]' selected>$r[nm_metode]</option>";
                        } else {
                          echo "<option value='$r[id_metode]'>$r[nm_metode]</option>";
                        }
                      }
                    ?>
                  </select>
                </div>
              </div>
              <br>
              <div class="row">
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
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th width="1">No.</th>
                  <th>Tanggal</th>
                  <th>Nota</th>
                  <th>Toko</th>
                  <th>Customer</th>
                  <th>Pembeyaran</th>
                  <th>Jumlah</th>
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
                        penjualan_detail.harga_jual*penjualan_detail.jumlah AS subtotal
                        FROM 
                        penjualan_detail 
                        WHERE penjualan_detail.nota = '$r[nota]'
                        ") or die (mysqli_error());
                  while ($rp = mysqli_fetch_array($qp)) {
                    $omset += $rp['subtotal'];
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
                    <td><?= number_format($r['total']);?> pcs</td>
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
                  <td colspan="6" align="right">Total</td>
                  <td><?= number_format($total_jumlah);?> pcs</td>  
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