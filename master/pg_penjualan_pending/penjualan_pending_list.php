<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data Penjualan Pending
    </h1>
    <ol class="breadcrumb">
      <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Penjualan Pending</li>
    </ol>
  </section>

  <!-- Main content -->
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
                  <th>Tanggal</th>
                  <th>jatuh Tempo</th>
                  <th>Nota</th>
                  <th>Toko</th>
                  <th>Customer</th>
                  <th>Metode</th>
                </tr>
              </thead>
              <tbody>
              <?php
                $i = 0;
                $qr = "";
                if ($_SESSION['id_level'] == '2') {
                  $qr = "WHERE penjualan.id_toko = '$_SESSION[id_toko]'";
                }
                $q = mysqli_query($link,"SELECT 
                      penjualan.nota, 
                      penjualan.id_toko, 
                      penjualan.tanggal, 
                      if(penjualan.jatuh_tempo IS NULL, '-', penjualan.jatuh_tempo) AS jatuh_tempo, 
                      _metode.nm_metode, 
                      toko.nm_toko, 
                      customer.nm_customer 
                      FROM 
                      penjualan 
                      INNER JOIN toko ON toko.id_toko = penjualan.id_toko 
                      INNER JOIN customer ON customer.id_customer = penjualan.id_customer 
                      INNER JOIN _metode ON _metode.id_metode = penjualan.id_metode 
                      $qr
                      AND penjualan.online = '0'
                      AND penjualan.pending = '1'
                      GROUP BY penjualan.id_penjualan
                      ORDER BY penjualan.id_penjualan DESC
                      ") or die (mysqli_error());
                while ($r = mysqli_fetch_array($q)) {
                  $nota = base64_encode($r['nota']);
                  $id_toko = base64_encode($r['id_toko']);
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
                          <li><a href="?act=<?php echo md5('penjualan_pending_detail')."&nota=$nota"?>"><i class="fa fa-eye"></i>Detail</a></li>
                          <?php
                          if ($_SESSION['id_level'] == '1') {
                          ?>
                            <li><a href="?act=<?php echo md5('penjualan_pending_delete')."&nota=$nota&id_toko=$id_toko"?>" onclick="return confirm('Apakah anda yakin ?')"><i class="fa fa-trash"></i>Hapus</a></li>
                          <?php
                          }
                          ?>
                        </ul>
                      </div>
                    </td>
                    <td><?= $r['tanggal'];?></td>
                    <td><?= $r['jatuh_tempo'];?></td>
                    <td><?= $r['nota'];?></td>
                    <td><?= $r['nm_toko'];?></td>
                    <td><?= $r['nm_customer'];?></td>
                    <td><?= $r['nm_metode'];?></td>
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