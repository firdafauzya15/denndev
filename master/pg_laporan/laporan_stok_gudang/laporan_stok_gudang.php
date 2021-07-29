<div class="content-wrapper">
  <section class="content-header">
    <h1>Data Barang / Stok Gudang</h1>
    <ol class="breadcrumb">
      <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Barang / Stok Gudang</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-body">
            <a class="btn btn-warning" target="blank" href="master/pg_laporan/laporan_stok_gudang/print_stok_gudang.php"><i class="fa fa-print"></i> Print</a>
            <a class="btn btn-success" target="blank" href="master/pg_laporan/laporan_stok_gudang/print_stok_gudang.php"><i class="fa fa-file-excel"></i> Excel</a><hr>
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th rowspan="2" width="1">No.</th>
                  <?php
                  if ($_SESSION['id_level'] == '1') {
                  ?>
                    <th rowspan="2" width="50">Aksi</th>
                  <?php
                  }
                  ?>
                  <th rowspan="2">Kode</th>
                  <th rowspan="2">Nama</th>
                  <th colspan="2">Stok</th>
                </tr>
                <tr>
                  <th width="1">Lusin</th>
                  <th width="1">Pcs</th>
                </tr>
              </thead>
              <tbody>
              <?php
                $i = 0;
                $q = mysqli_query($link,"SELECT 
                      stok_gudang.id_stok_gudang,
                      stok_gudang.kd_produk_size,
                      stok_gudang.jumlah,
                      produk_size.kd_produk
                      FROM 
                      stok_gudang 
                      Inner Join produk_size ON produk_size.kd_produk_size = stok_gudang.kd_produk_size

                      ") or die (mysqli_error());
                while ($r = mysqli_fetch_array($q)) {
                  $id = base64_encode($r['id_stok_gudang']);
                  $i++;
                  $rP = mysqli_fetch_array(mysqli_query($link,"SELECT nm_produk FROM produk WHERE kd_produk = '$r[kd_produk]'"));
              ?>
                  <tr>
                    <td><?= $i;?></td>
                    <?php
                    if ($_SESSION['id_level'] == '1') {
                    ?>
                      <td>
                        <div class="btn-group">
                          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-cog"></i></button>
                          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <ul class="dropdown-menu" role="menu">
                              <li><a href="?act=<?php echo md5('laporan_stok_gudang_detail')."&id_stok_gudang=$id"?>"><i class="fa fa-eye"></i>Detail</a></li>
                              <li><a href="?act=<?php echo md5('laporan_stok_gudang_edit')."&id_stok_gudang=$id"?>"><i class="fa fa-pencil"></i>Edit</a></li>
                          </ul>
                        </div>
                      </td>
                    <?php
                    }
                    ?>
                    <td><?= $r['kd_produk_size'];?></td>
                    <td><?= $rP['nm_produk'];?></td>
                    <td><?= number_format(lusin($r['jumlah']));?></td>
                    <td><?= number_format(pcs($r['jumlah']));?></td>
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