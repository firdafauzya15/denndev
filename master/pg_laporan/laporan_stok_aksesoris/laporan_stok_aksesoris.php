<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data Barang / Stok Aksesoris
    </h1>
    <ol class="breadcrumb">
      <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Barang / Stok Aksesoris</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-body">
            <!--<a href="master/pg_laporan/xls_stok_aksesoris.php" class="btn btn-success">Export Excel</a>-->
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
                      * 
                      FROM 
                      stok_aksesoris 
                      Inner Join aksesoris ON aksesoris.kd_aksesoris = stok_aksesoris.kd_aksesoris
                      Order By aksesoris.kd_aksesoris DESC
                      ") or die (mysqli_error());
                while ($r = mysqli_fetch_array($q)) {
                  $id = base64_encode($r['id_stok_aksesoris']);
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
                          <?php
                          if ($_SESSION['id_level'] == '1' OR $_SESSION['id_level'] == '3') {
                          ?>
                            <li><a href="?act=<?php echo md5('laporan_stok_aksesoris_edit')."&id_stok_aksesoris=$id"?>"><i class="fa fa-pencil"></i>Edit</a></li>
                          <?php
                          }
                          ?>
                        </ul>
                      </div>
                    </td>
                    <td><?= $r['kd_aksesoris'];?></td>
                    <td><?= $r['nm_aksesoris'];?></td>
                    <td><?= number_format($r['jumlah']);?></td>
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