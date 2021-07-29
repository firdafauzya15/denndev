<?php
$cari = $_POST['cari'];
$readBarcode = $_POST['readBarcode'];
$pecah = explode(" | ", $readBarcode);
$kd_produk = $pecah[0];
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data Laporan Laba Rugi
    </h1>
    <ol class="breadcrumb">
      <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Laba Rugi</li>
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
                <div class="col-md-4">
                <input type="text" class="form-control" name="readBarcode" placeholder="Cari Produk ..." value="<?= $readBarcode;?>">
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
                  <th>Kode</th>
                  <th>Nama</th>
                  <th>Lusin</th>
                  <th>Pcs</th>
                  <th>Total Modal</th>
                  <th>Total Jual</th>
                  <th>Laba Rugi</th>
                  <th width="1">Tipe</th>
                </tr>
              </thead>
              <tbody>
              <?php
                $i = 0;
                $total_laba_rugi = 0;
                $total_modal = 0;
                $total_jual = 0;
                $q_where = "";
                $q_produk = "";
                $limit = "LIMIT 50";

                if (isset($cari)) {

                  $q_where = "WHERE";
                  $q_produk = "produk.kd_produk = '$kd_produk'";
                  $limit = "";

                }

                $q = mysqli_query($link,"SELECT 
                      produk.kd_produk,
                      produk.nm_produk,
                      produk.harga_modal,
                      produk.harga_jual,
                      produk.id_tipe_produk
                      FROM 
                      produk 
                      $q_where
                      $q_produk
                      Group By produk.id_produk
                      Order By produk.id_produk DESC
                      $limit
                      ") or die (mysqli_error());
                while ($r = mysqli_fetch_array($q)) {
                  $i++;

                  $harga_bahan = 0;
                  $harga_spk = 0;
                  $harga_sablon = 0;
                  $harga_produksi = 0;

                  $harga_modal = 0;
                  $harga_jual = 0;
                  $jml_jual = 0;
                  $qD = mysqli_query($link,"SELECT 
                        kd_produk_size
                        FROM
                        produk_size
                        WHERE 
                        kd_produk = '$r[kd_produk]'
                        ") or die (mysqli_error());
                  while ($rD = mysqli_fetch_array($qD)) {

                    $qSell = mysqli_query($link,"SELECT
                              sum(penjualan_detail.jumlah) AS jml_jual,
                              sum(penjualan_detail.harga_modal*penjualan_detail.jumlah) AS harga_modal,
                              sum(penjualan_detail.harga_jual*penjualan_detail.jumlah) AS harga_jual
                              FROM
                              penjualan_detail
                              WHERE
                              penjualan_detail.kd_produk_size = '$rD[kd_produk_size]'
                              ") or die (mysqli_error());
                    $rSell = mysqli_fetch_array($qSell);
                    $jml_jual += $rSell['jml_jual'];
                    $harga_modal += $rSell['harga_modal'];
                    $harga_jual += $rSell['harga_jual'];

                  }

                  $subtotal_modal = $harga_modal; 
                  $subtotal_jual = $harga_jual; 
                  $subtotal_laba_rugi = $subtotal_jual - $subtotal_modal;
                  $total_modal += $subtotal_modal;
                  $total_jual += $subtotal_jual;
                  $total_laba_rugi += $subtotal_laba_rugi;

                  $tipe = "<span class='label label-warning'>Barang Produksi</span>";
                  if ($r['id_tipe_produk'] == '2') {
                    $tipe = "<span class='label label-success'>Barang Jadi</span>";
                  }
              ?>
                  <tr>
                    <td><?= $i;?></td>
                    <td><?= $r['kd_produk'];?></td>
                    <td><?= $r['nm_produk'];?></td>
                    <td><?= number_format(lusin($jml_jual));?></td>
                    <td><?= number_format(pcs($jml_jual));?></td>
                    <td><?= number_format($subtotal_modal);?></td>
                    <td><?= number_format($subtotal_jual);?></td>
                    <td><?= number_format($subtotal_laba_rugi);?></td>
                    <td><?= $tipe;?></td>
                  </tr>
              <?php
                }
              ?>
                <tr style="font-weight: bold;">
                  <td colspan="5" align="right">Total</td>
                  <td><?= number_format($total_modal);?></td>  
                  <td><?= number_format($total_jual);?></td>  
                  <td><?= number_format($total_laba_rugi);?></td>  
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


<script>
$(document).ready(function() {
  
  var availableAttributes = [
          <?php
          $qB = mysqli_query($link,"SELECT
                kd_produk, 
                nm_produk 
                FROM 
                produk 
                Order By kd_produk ASC
                ");
          while($rB = mysqli_fetch_array($qB)){
            echo "'" . $rB['kd_produk'] . " | " . $rB['nm_produk'] . "',";
          }
          ?>
  ];

  $("input[name^='readBarcode']").autocomplete({
    source: availableAttributes
  }); 
  
});

// autocomplete enablement
</script>