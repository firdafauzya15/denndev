<?php
$cari = $_POST['cari'];
$dari = $_POST['dari'];
$sampai = $_POST['sampai'];
?>

<div class="content-wrapper">
  <section class="content-header">
    <h1>Data Laporan Best Seller</h1>
    <ol class="breadcrumb">
      <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Best Seller</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-body">
            <form action="#" method="post" class="form-horizontal">
              <div class="row">
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
                </tr>
              </thead>
              <tbody>
              <?php
                $i = 0;
                $q_where = "";
                $q_date = "";
                $limit = "LIMIT 50";

                if (isset($cari)) {

                  $q_where = "WHERE";
                  $q_date = "(date(penjualan.tanggal) >= '$dari') AND (date(penjualan.tanggal) <= '$sampai')";
                  $limit = "";

                }
                $q = mysqli_query($link,"SELECT 
                      sum(penjualan_detail.jumlah) AS terjual,
                      produk.kd_produk,
                      produk.nm_produk
                      FROM 
                      penjualan_detail 
                      INNER JOIN penjualan ON penjualan.nota = penjualan_detail.nota
                      INNER JOIN produk_size ON produk_size.kd_produk_size = penjualan_detail.kd_produk_size
                      INNER JOIN produk ON produk.kd_produk = produk_size.kd_produk
                      $q_where
                      $q_date
                      Group By produk.id_produk
                      Order By terjual DESC
                      ") or die (mysqli_error());
                while ($r = mysqli_fetch_array($q)) {
                  $i++;
              ?>
                  <tr>
                    <td><?= $i;?></td>
                    <td><?= $r['kd_produk'];?></td>
                    <td><?= $r['nm_produk'];?></td>
                    <td><?= lusin($r['terjual']);?></td>
                    <td><?= pcs($r['terjual']);?></td>
                  </tr>
              <?php
                }
              ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

  </section>
</div>