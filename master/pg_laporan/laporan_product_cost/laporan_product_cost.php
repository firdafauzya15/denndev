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
      Data Laporan Product Cost
    </h1>
    <ol class="breadcrumb">
      <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Product Cost</li>
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
                  <th>Harga Bahan</th>
                  <th>Harga Aksesoris</th>
                  <th>Harga Cutting</th>
                  <th>Harga Sablon</th>
                  <th>Harga CMT</th>
                  <th>Product Cost</th>
                  <th width="1">Tipe</th>
                </tr>
              </thead>
              <tbody>
              <?php
                $i = 0;
                $total_bahan = 0;
                $total_aksesoris = 0;
                $total_spk = 0;
                $total_sablon = 0;
                $total_produksi = 0;
                $total_modal = 0;
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
                  $harga_aksesoris = 0;
                  $harga_spk = 0;
                  $harga_sablon = 0;
                  $harga_produksi = 0;
                  $harga_modal = $r['harga_modal'];

                  if ($r['id_tipe_produk'] == '1') {

                    $qProd = mysqli_query($link,"SELECT 
                          sum(spk_cutting_pengiriman.jumlah) AS qty,
                          spk_cutting.nota AS nota_spk,
                          spk_cutting.harga AS harga_spk,
                          sablon.harga AS harga_sablon,
                          produksi.nota AS nota_produksi,
                          produksi.harga AS harga_produksi
                          FROM 
                          sablon_detail 
                          Inner Join sablon ON sablon.nota = sablon_detail.nota
                          Inner Join produksi ON produksi.nota_sablon = sablon.nota
                          Inner Join spk_cutting ON spk_cutting.nota = sablon.nota_spk
                          Inner Join spk_cutting_pengiriman ON spk_cutting_pengiriman.nota = spk_cutting.nota
                          Inner Join produk ON produk.kd_produk = sablon_detail.kd_produk
                          WHERE 
                          produk.kd_produk = '$r[kd_produk]'
                          Order By produksi.id_produksi DESC
                          ") or die (mysqli_error());
                    $rProd = mysqli_fetch_array($qProd);

                    $harga_bahan = 0;
                    $qBahan = mysqli_query($link,"SELECT 
                          spk_cutting_detail.kd_bahan,
                          spk_cutting_detail.jumlah,
                          pembelian_bahan_detail.harga
                          FROM 
                          spk_cutting_detail 
                          Inner Join pembelian_bahan_detail ON pembelian_bahan_detail.kd_bahan = spk_cutting_detail.kd_bahan
                          WHERE 
                          spk_cutting_detail.nota = '$rProd[nota_spk]'
                          Group By spk_cutting_detail.kd_bahan
                          Order By pembelian_bahan_detail.id_pembelian_bahan_detail DESC
                          ") or die (mysqli_error());
                    while ($rBahan = mysqli_fetch_array($qBahan)) {
                      $harga_bahan += $rBahan['harga']*$rBahan['jumlah'];
                    }

                    $harga_aksesoris = 0;
                    $qaksesoris = mysqli_query($link,"SELECT 
                          produksi_aksesoris.kd_aksesoris,
                          produksi_aksesoris.jumlah,
                          pembelian_aksesoris_detail.harga
                          FROM 
                          produksi_aksesoris 
                          Inner Join pembelian_aksesoris_detail ON pembelian_aksesoris_detail.kd_aksesoris = produksi_aksesoris.kd_aksesoris
                          WHERE 
                          produksi_aksesoris.nota = '$rProd[nota_produksi]'
                          Group By produksi_aksesoris.kd_aksesoris
                          Order By pembelian_aksesoris_detail.id_pembelian_aksesoris_detail DESC
                          ") or die (mysqli_error());
                    while ($raksesoris = mysqli_fetch_array($qaksesoris)) {
                      $harga_aksesoris += $raksesoris['harga']*$raksesoris['jumlah'];
                    }

                    $harga_bahan = $harga_bahan/$rProd['qty'];
                    $harga_aksesoris = $harga_aksesoris;
                    $harga_spk = $rProd['harga_spk'];
                    $harga_sablon = $rProd['harga_sablon'];
                    $harga_produksi = $rProd['harga_produksi'];
                    $harga_modal = $harga_bahan + $harga_aksesoris + $harga_spk + $harga_sablon + $harga_produksi;

                  }

                  $total_bahan += $harga_bahan;
                  $total_aksesoris += $harga_aksesoris;
                  $total_spk += $harga_spk;
                  $total_sablon += $harga_sablon;
                  $total_produksi += $harga_produksi;
                  $total_modal += $harga_modal;

                  $tipe = "<span class='label label-warning'>Barang Produksi</span>";
                  if ($r['id_tipe_produk'] == '2') {
                    $tipe = "<span class='label label-success'>Barang Jadi</span>";
                  }
              ?>
                  <tr>
                    <td><?= $i;?></td>
                    <td><?= $r['kd_produk'];?></td>
                    <td><?= $r['nm_produk'];?></td>
                    <td><?= number_format($harga_bahan);?></td>
                    <td><?= number_format($harga_aksesoris);?></td>
                    <td><?= number_format($harga_spk);?></td>
                    <td><?= number_format($harga_sablon);?></td>
                    <td><?= number_format($harga_produksi);?></td>
                    <td><?= number_format($harga_modal);?></td>
                    <td><?= $tipe;?></td>
                  </tr>
              <?php
                }
              ?>
                <tr style="font-weight: bold;">
                  <td colspan="3" align="right">Total</td>
                  <td><?= number_format($total_bahan);?></td>  
                  <td><?= number_format($total_aksesoris);?></td>  
                  <td><?= number_format($total_spk);?></td>  
                  <td><?= number_format($total_sablon);?></td>  
                  <td><?= number_format($total_produksi);?></td>  
                  <td><?= number_format($total_modal);?></td>  
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