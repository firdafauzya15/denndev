<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data Sablon / Bordir
    </h1>
    <ol class="breadcrumb">
      <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Sablon / Bordir</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-body table-responsive">
            <a href="?act=<?php echo md5('sablon_add')?>" class="btn btn-info"><i class="fa fa-plus"></i> Tambah Data</a>
            <hr>
            <form class="form-inline" action="home.php">
              <input type="hidden" name="act" value="<?= $_GET['act']; ?>">
              <div class="form-group">
                <input type="text" name="nota_spk" class="form-control" value="<?= $_GET['nota_spk']; ?>" placeholder="Nota SPK">
              </div>
              <div class="form-group">
                <input type="text" name="nota" class="form-control" value="<?= $_GET['nota']; ?>" placeholder="Nota">
              </div>
              <button type="submit" class="btn btn-default"><i class="fa fa-search"></i> Cari</button>
            </form>
            <br>
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th rowspan="2" width="1">No.</th>
                  <th rowspan="2" width="50">Aksi</th>
                  <th rowspan="2">Tanggal Keluar</th>
                  <th rowspan="2">Tanggal Balikan</th>
                  <th rowspan="2">Nota SPK</th>
                  <th rowspan="2">Nota</th>
                  <th rowspan="2">Brand</th>
                  <th rowspan="2">Model</th>
                  <th rowspan="2">Nama Produk</th>
                  <th rowspan="2">Vendor</th>
                  <th colspan="2" width="1">Jumlah</th>
                  <th colspan="2" width="1">Terkirim</th>
                  <th colspan="2" width="1">Reject</th>
                  <th rowspan="2" width="1">Status</th>
                </tr>
                <tr>
                  <th width="1">Lusin</th>
                  <th width="1">Pcs</th>
                  <th width="1">Lusin</th>
                  <th width="1">Pcs</th>
                  <th width="1">Lusin</th>
                  <th width="1">Pcs</th>
                </tr>
              </thead>
              <tbody>
              <?php
                $i = 0;

                $where = "";
                $and = "";
                if ($_GET['nota_spk'] != '') {
                  $where .= $and . "sablon.nota_spk = '$_GET[nota_spk]'";
                  $and = " AND ";
                }
                if ($_GET['nota'] != '') {
                  $where .= $and . "sablon.nota = '$_GET[nota]'";
                  $and = " AND ";
                }
                if ($where != '') {
                  $where = 'WHERE ' . $where;
                }

                $q = mysqli_query($link,"SELECT 
                      sum(sablon_detail.jumlah) AS jumlah_sablon,
                      vendor.nm_vendor, 
                      sablon.id_sablon, 
                      sablon.tanggal,
                      sablon.jatuh_tempo,
                      sablon.tgl_balikan,
                      sablon.nota_spk,
                      sablon.nota,
                      model.nm_model,
                      brand.nm_brand,
                      produk.nm_produk
                      FROM 
                      sablon 
                      INNER JOIN sablon_detail ON sablon_detail.nota = sablon.nota
                     
                      INNER JOIN vendor ON vendor.id_vendor = sablon.id_vendor
                      inner join produk on produk.kd_produk = sablon_detail.kd_produk
                      inner join brand on brand.id_brand = produk.id_brand
                      inner join model on model.id_model = produk.id_model
                      $where
                      GROUP BY sablon.id_sablon
                      ORDER BY sablon.id_sablon DESC
                      LIMIT 500
                      ") or die (mysqli_error());
                while ($r = mysqli_fetch_assoc($q)) {
                  $nota = base64_encode($r['nota']);
                  $i++;

                  $rK = mysqli_fetch_assoc(mysqli_query($link,"SELECT 
                                sum(sablon_pengiriman.jumlah) AS jumlah_kirim
                                FROM
                                sablon_pengiriman
                                INNER JOIN sablon_detail ON sablon_detail.id_sablon_detail = sablon_pengiriman.id_sablon_detail
                                WHERE 
                                sablon_detail.nota = '$r[nota]'
                                "));

                  $rB = mysqli_fetch_assoc(mysqli_query($link,"SELECT 
                                sum(sablon_pengiriman_bs.jumlah) AS jumlah_bs
                                FROM
                                sablon_pengiriman_bs
                                INNER JOIN sablon_detail ON sablon_detail.id_sablon_detail = sablon_pengiriman_bs.id_sablon_detail
                                WHERE 
                                sablon_detail.nota = '$r[nota]'
                                "));

                  $status = "<span class='label label-warning'>Pending</span>";
                  if ($r['jumlah_sablon'] == ($rK['jumlah_kirim']+$rB['jumlah_bs'])) {
                    $status = "<span class='label label-success'>Done</span>";
                  }

                  $jatuhTempo = "";
                  if (date("Y-m-d") > $r['jatuh_tempo']) {
                    $jatuhTempo = "style='color:red;'";
                  }
              
                  $datacmt = mysqli_num_rows(mysqli_query($link,"SELECT nota_Sablon FROM produksi where nota_sablon = '".$r[nota]."'"));

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
                          <li><a href="?act=<?php echo md5('sablon_detail')."&nota=$nota"?>"><i class="fa fa-eye"></i>Detail</a></li>
                          <?php
                          if ($_SESSION['id_level'] == 1) {
                          ?>
                            <li><a href="?act=<?php echo md5('sablon_delete')."&nota=$nota"?>" onclick="return confirm('Apakah anda yakin ?')"><i class="fa fa-trash"></i>Hapus</a></li>
                          <?php
                          }
                          ?>
                        </ul>
                      </div>
                    </td>
                    <td><?= $r['tanggal'];?></td>
                    <td <?= $jatuhTempo;?>>
                    <?= $r['tgl_balikan'];?></td>
                    <td><?= $r['nota_spk'];?></td>
                    <td <?= $datacmt> 0 ? "":"style='color:red;'"?>><?= $r['nota'];?></td>
                    <td><?= $r['nm_brand'];?></td>
                    <td><?= $r['nm_model'];?></td>
                    <td><?= $r['nm_produk'];?></td>
                    <td><?= $r['nm_vendor'];?></td>
                    <td><?= number_format(lusin($r['jumlah_sablon']));?></td>
                    <td><?= number_format(pcs($r['jumlah_sablon']));?></td>
                    <td><?= number_format(lusin($rK['jumlah_kirim']));?></td>
                    <td><?= number_format(pcs($rK['jumlah_kirim']));?></td>
                    <td><?= number_format(lusin($rB['jumlah_bs']));?></td>
                    <td><?= number_format(pcs($rB['jumlah_bs']));?></td>
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