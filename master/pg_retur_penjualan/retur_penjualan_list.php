<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data Retur Penjualan
    </h1>
    <ol class="breadcrumb">
      <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Retur Penjualan</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-body">
            <a href="?act=<?php echo md5('retur_penjualan_add')?>" class="btn btn-info"><i class="fa fa-plus"></i> Tambah Data</a>
            <hr>
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th width="1">No.</th>
                  <th width="50">Aksi</th>
                  <th>Tanggal</th>
                  <th>Nota</th>
                  <th>Toko</th>
                  <th>Customer</th>
                  <th width="1">Status</th>
                </tr>
              </thead>
              <tbody>
              <?php
                $i = 0;
                $q = mysqli_query($link,"SELECT 
                      toko.nm_toko, 
                      customer.nm_customer, 
                      retur_penjualan.nota, 
                      retur_penjualan.tanggal
                      FROM 
                      retur_penjualan 
                      INNER JOIN toko ON toko.id_toko = retur_penjualan.id_toko 
                      INNER JOIN customer ON customer.id_customer = retur_penjualan.id_customer 
                      GROUP BY retur_penjualan.nota
                      ORDER BY retur_penjualan.nota DESC
                      ") or die (mysqli_error());
                while ($r = mysqli_fetch_array($q)) {
                  $i++;
                  $nota = base64_encode($r['nota']);
                  $id_toko = base64_encode($r['id_toko']);

                  $penjualans = mysqli_query($link,"SELECT id_penjualan FROM penjualan WHERE nota_retur = '$r[nota]'");

                  $status = "<span class='label label-warning'>Pending</span>";
                  if (mysqli_num_rows($penjualans) > 0) {
                    $status = "<span class='label label-success'>Done</span>";
                  }
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
                          <li><a href="?act=<?php echo md5('retur_penjualan_detail')."&nota=$nota"?>"><i class="fa fa-eye"></i>Detail</a></li>
                          <?php
                          if ($_SESSION['id_level'] == 1) {
                          ?>
                            <li><a href="?act=<?php echo md5('retur_penjualan_delete')."&nota=$nota"?>" onclick="return confirm('Apakah anda yakin ?')"><i class="fa fa-trash"></i>Hapus</a></li>
                          <?php
                          }
                          ?>
                        </ul>
                      </div>
                    </td>
                    <td><?= $r['tanggal'];?></td>
                    <td><?= $r['nota'];?></td>
                    <td><?= $r['nm_toko'];?></td>
                    <td><?= $r['nm_customer'];?></td>
                    <td><?= $status;?></td>
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