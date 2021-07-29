<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data Rincian Produk
    </h1>
    <ol class="breadcrumb">
      <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Rincian Produk</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-body">
            <!--<a href="master/pg_laporan/xls_stok_gudang.php" class="btn btn-success">Export Excel</a>-->
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th rowspan="2" width="1">No.</th>
                  <th rowspan="2">Kode</th>
                  <th rowspan="2">Nama</th>
                  <th colspan="2" width="80">Gudang</th>
                  <th colspan="2" width="80">Toko</th>
                  <th colspan="2" width="80">Grantotal</th>
                </tr>
                <tr>
                  <th>Lusin</th>
                  <th>Pcs</th>
                  <th>Lusin</th>
                  <th>Pcs</th>
                  <th>Lusin</th>
                  <th>Pcs</th>
                </tr>
              </thead>
              <tbody>
              <?php
                $i = 0;
                $q = mysqli_query($link,"SELECT 
                      produk_size.kd_produk_size,
                      produk_size.kd_produk,
                      produk.nm_produk
                      FROM 
                      produk_size 
                      Inner Join produk ON produk.kd_produk = produk_size.kd_produk
                      Order By produk_size.kd_produk_size DESC
                      ") or die (mysqli_error());
                while ($r = mysqli_fetch_array($q)) {
                  $i++;
                  $rG = mysqli_fetch_array(mysqli_query($link,"SELECT stok_gudang.jumlah FROM stok_gudang WHERE kd_produk_size = '$r[kd_produk_size]'"));
                  $rT = mysqli_fetch_array(mysqli_query($link,"SELECT stok.jumlah FROM stok WHERE kd_produk_size = '$r[kd_produk_size]'"));
                  $grandtotal = $rG['jumlah'] + $rT['jumlah'];
              ?>
                  <tr>
                    <td><?= $i;?></td>
                    <td><?= $r['kd_produk_size'];?></td>
                    <td><?= $r['nm_produk'];?></td>
                    <td><?= number_format(lusin($rG['jumlah']));?></td>
                    <td><?= number_format(pcs($rG['jumlah']));?></td>
                    <td><?= number_format(lusin($rT['jumlah']));?></td>
                    <td><?= number_format(pcs($rT['jumlah']));?></td>
                    <td><?= number_format(lusin($grandtotal));?></td>
                    <td><?= number_format(pcs($grandtotal));?></td>
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