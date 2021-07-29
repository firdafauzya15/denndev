<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data Laporan Laba Rugi Nota
    </h1>
    <ol class="breadcrumb">
      <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Laba Rugi Nota</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-body">
            <form action="#" method="get" class="form-horizontal">
              <input type="hidden" name="act" value="d2776dfb2bb6257c7157f5163795e579">
              <div class="row">
                <div class="col-md-2">
                  <div class="input-group date">
                    <input type="text" name="dari" class="form-control pull-right" id="datepicker" required placeholder="Dari" value="<?= $_GET['dari'];?>">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="input-group date">
                    <input type="text" name="sampai" class="form-control pull-right" id="datepicker2" required placeholder="Sampai" value="<?= $_GET['sampai'];?>">
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
                  <th>Modal</th>
                  <th>Pemasukkan</th>
                  <th>Pajak</th>
                  <th>Diskon</th>
                  <th>Retur</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>
              <?php
                $limit = 100;
                $where = "WHERE ";
                if ($_GET['dari'] != '' AND $_GET['sampai'] != '') {
                  $where .= "(date(penjualan.tanggal) >= '$_GET[dari]') AND (date(penjualan.tanggal) <= '$_GET[sampai]') ";
                } else {
                  $where .= "penjualan.tanggal != '' ";
                }
                $i = 0;
                $grandTotal = 0;
                $penjualans = mysqli_query($link,"SELECT 
                      toko.nm_toko,
                      customer.nm_customer,
                      penjualan.nota,
                      penjualan.tanggal,
                      penjualan.pajak,
                      penjualan.diskon,
                      penjualan.total_retur
                      FROM 
                      penjualan 
                      INNER JOIN toko ON toko.id_toko = penjualan.id_toko
                      INNER JOIN customer ON customer.id_customer = penjualan.id_customer
                      $where
                      ORDER BY penjualan.id_penjualan DESC
                      LIMIT $limit
                      ") or die (mysqli_error());
                while ($penjualan = mysqli_fetch_array($penjualans)) {
                  $i++;
                  $modal = 0;
                  $pemasukkan = 0;
                  $penjualanDetails = mysqli_query($link,"SELECT 
                    penjualan_detail.harga_modal,
                    penjualan_detail.harga_jual,
                    penjualan_detail.jumlah
                    FROM 
                    penjualan_detail
                    INNER JOIN produk_size ON produk_size.kd_produk_size = penjualan_detail.kd_produk_size
                    INNER JOIN produk ON produk.kd_produk = produk_size.kd_produk
                    WHERE 
                    penjualan_detail.nota = '$penjualan[nota]'
                    ") or die (mysqli_error());
                  while ($penjualanDetail = mysqli_fetch_array($penjualanDetails)) {
                    $modal += (lusin($penjualanDetail['jumlah']) * $penjualanDetail['harga_modal']) + (pcs($penjualanDetail['jumlah']) * ($penjualanDetail['harga_modal']/12));    
                    $pemasukkan += (lusin($penjualanDetail['jumlah']) * $penjualanDetail['harga_jual']) + (pcs($penjualanDetail['jumlah']) * ($penjualanDetail['harga_jual']/12));    
                  }
                  $pajak = ($pemasukkan*$penjualan['pajak'])/100;
                  $subTotal = ((($pemasukkan + $pajak) - $penjualan['diskon']) - $modal) - $penjualan['total_retur'];
                  $grandTotal += $subTotal;
              ?>
                  <tr>
                    <td><?= $i;?></td>
                    <td><?= $penjualan['tanggal'];?></td>
                    <td><?= $penjualan['nota'];?></td>
                    <td><?= $penjualan['nm_toko'];?></td>
                    <td><?= $penjualan['nm_customer'];?></td>
                    <td><?= number_format($modal,0,",",".");?></td>
                    <td><?= number_format($pemasukkan,0,",",".");?></td>
                    <td><?= number_format($pajak,0,",",".");?></td>
                    <td><?= number_format($penjualan['diskon'],0,",",".");?></td>
                    <td><?= number_format($penjualan['total_retur'],0,",",".");?></td>
                    <td><?= number_format($subTotal,0,",",".");?></td>
                  </tr>
              <?php
                }
              ?>
                <tr style="font-weight: bold;">
                  <td colspan="10" align="right">Total</td>
                  <td><?= number_format($grandTotal,0,",",".");?></td>
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