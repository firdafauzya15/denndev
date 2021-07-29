<div class="content-wrapper">
  <section class="content-header">
    <h1>Data Barang / Stok Bahan</h1>
    <ol class="breadcrumb">
      <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Barang / Stok Bahan</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th width="1">No.</th>
                  <th width="50">Aksi</th>
                  <th>Kode</th>
                  <th>Nama</th>
                  <th width="80">Jumlah Stok</th>
                </tr>
              </thead>
              <tbody>
              <?php
                $i = 0;
                $q = mysqli_query($link,"SELECT 
                      stok_bahan.id_stok_bahan,
                      sum(stok_bahan.jumlah) AS jumlah,
                      bahan_header.id_bahan_header,
                      bahan_header.kd_bahan_header,
                      bahan_header.nm_bahan_header
                      FROM 
                      stok_bahan 
                      Inner Join bahan ON bahan.kd_bahan = stok_bahan.kd_bahan
                      Inner Join bahan_header ON bahan_header.id_bahan_header = bahan.id_bahan_header
                      GROUP BY bahan.id_bahan_header
                      Order By bahan.kd_bahan DESC
                      ") or die (mysqli_error());
                while ($r = mysqli_fetch_array($q)) {
                  $id = base64_encode($r['id_stok_bahan']);
                  $id_bahan_header = base64_encode($r['id_bahan_header']);
                  $i++;
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
                          <li><a href="?act=<?php echo md5('laporan_stok_bahan_detail')."&id_bahan_header=$id_bahan_header"?>"><i class="fa fa-eye"></i>Detail</a></li>
                        </ul>
                      </div>
                    </td>
                    <td><?= $r['kd_bahan_header'];?></td>
                    <td><?= $r['nm_bahan_header'];?></td>
                    <td><?= $r['jumlah'];?></td>
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