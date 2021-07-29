<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data Produksi
    </h1>
    <ol class="breadcrumb">
      <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Produksi</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-body">
            <a href="?act=<?php echo md5('produksi_add')?>" class="btn btn-info"><i class="fa fa-plus"></i> Tambah Data</a>
            <hr>
            <form class="form-inline" action="home.php">
              <input type="hidden" name="act" value="<?= $_GET['act']; ?>">
              <div class="form-group">
                <input type="text" name="nota_sablon" class="form-control" value="<?= $_GET['nota_sablon']; ?>" placeholder="Nota Sablon">
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
                  <th rowspan="2">Tanggal Keluar CMT</th>
                  <th rowspan="2">Tanggal Balikan CMT</th>
                  <th rowspan="2">Nota Sablon</th>
                  <th rowspan="2">Model</th>
                  <th rowspan="2">Produk</th>
                  <th rowspan="2">Brand</th>
                  <th rowspan="2">Vendor</th>
                  <th rowspan="2">Keluar Sablon</th>
                  <th rowspan="2">Balikan Sablon</th>
                  <th colspan="2" width="1">Jml Balikan</th>
                  <th rowspan="2">Nota</th>
                  <th colspan="2" width="1">Jumlah</th>
                  <th colspan="2" width="1">Terkirim</th>
                  <th colspan="2" width="1">Reject</th>
                  <th rowspan="2">Notes</th>
                  <th rowspan="2" width="1">Status</th>
                </tr>
                <tr>
                  <th width="1">Lusin</th>
                  <th width="1">Pcs</th>
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
              if ($_GET['nota_sablon'] != '') {
                $where .= $and . "produksi.nota_sablon = '$_GET[nota_sablon]'";
                $and = " AND ";
              }
              if ($_GET['nota'] != '') {
                $where .= $and . "produksi.nota = '$_GET[nota]'";
                $and = " AND ";
              }
              if ($where != '') {
                $where = 'WHERE ' . $where;
              }

              $q = mysqli_query($link,"SELECT 
                produksi.id_produksi, 
                produksi.tanggal as cmt_tgl,
                produksi.tgl_balikan as cmt_tb,
                produksi.nota,
                produksi.nota_sablon,
                produksi.notes,
                sablon.tanggal as sablon_tgl,
                sablon.jatuh_tempo as sablon_jt,
                vendor.nm_vendor,
                model.nm_model,
                produk.nm_produk,
                brand.nm_brand
                FROM 
                produksi
                inner join sablon
                on sablon.nota = produksi.nota_sablon
                inner join vendor
                on vendor.id_vendor = sablon.id_vendor
                left join produk
                on produk.kd_produk = produksi.nota_sablon

                left join model
                on model.id_model = produk.id_model

                left join brand
                on brand.id_brand  = produk.id_brand
                $where
                GROUP BY produksi.id_produksi
                ORDER BY produksi.id_produksi DESC
                LIMIT 500
              ") or die (mysqli_error());
              while ($r = mysqli_fetch_assoc($q)) {
                $i++;
                $nota = base64_encode($r['nota']);
                $nota_sablon = base64_encode($r['nota_sablon']);
                
                $rx = mysqli_fetch_assoc(mysqli_query($link,"SELECT 
                sum(sablon_pengiriman.jumlah) AS jumlah_sablon
                FROM
                sablon_pengiriman
                INNER JOIN sablon_detail ON sablon_detail.id_sablon_detail = sablon_pengiriman.id_sablon_detail
                WHERE 
                sablon_detail.nota = '$r[nota_sablon]'
                "));


                $rP = mysqli_fetch_assoc(mysqli_query($link,"SELECT 
                  sum(produksi_detail.jumlah) AS jumlah_produksi
                  FROM
                  produksi_detail
                  WHERE 
                  produksi_detail.nota = '$r[nota]'
                "));

                $rK = mysqli_fetch_assoc(mysqli_query($link,"SELECT 
                  sum(produksi_pengiriman.jumlah) AS jumlah_kirim
                  FROM
                  produksi_pengiriman
                  INNER JOIN produksi_detail ON produksi_detail.id_produksi_detail = produksi_pengiriman.id_produksi_detail
                  WHERE 
                  produksi_detail.nota = '$r[nota]'
                "));

                $rB = mysqli_fetch_assoc(mysqli_query($link,"SELECT 
                  sum(produksi_pengiriman_bs.jumlah) AS jumlah_bs
                  FROM
                  produksi_pengiriman_bs
                  INNER JOIN produksi_detail ON produksi_detail.id_produksi_detail = produksi_pengiriman_bs.id_produksi_detail
                  WHERE 
                  produksi_detail.nota = '$r[nota]'
                "));

                $status = "<span class='label label-warning'>Pending</span>";
                if ($rP['jumlah_produksi'] == ($rK['jumlah_kirim']+$rB['jumlah_bs'])) {
                  $status = "<span class='label label-success'>Done</span>";
                }

                $jatuhTempo = "";
                if (date("Y-m-d") > $r['jatuh_tempo']) {
                  $jatuhTempo = "style='color:red;'";
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
                        <li><a href="?act=<?php echo md5('produksi_detail')."&nota=$nota"?>"><i class="fa fa-eye"></i>Detail</a></li>
                        <?php
                        if ($_SESSION['id_level'] == 1) {
                        ?>
                          <li><a href="?act=<?php echo md5('produksi_delete')."&nota=$nota"?>" onclick="return confirm('Apakah anda yakin ?')"><i class="fa fa-trash"></i>Hapus</a></li>
                        <?php
                        }
                        ?>
                      </ul>
                    </div>
                  </td>
                  <td><?= $r['cmt_tgl'];?></td>
                  <td><?= $r['cmt_tb'];?></td>
                  <td><?= $r['nota_sablon'];?></td>
                  <td><?= $r['nm_model'];?></td>
                  <td><?= $r['nm_produk'];?></td>
                  <td><?= $r['nm_brand'];?></td>
                  <td><?= $r['nm_vendor'];?></td>
                  <td><?= $r['sablon_tgl'];?></td>
                  <td><?= $r['sablon_jt'];?></td>
                  <td><?= number_format(lusin($rx['jumlah_sablon']));?></td>
                  <td><?= number_format(pcs($rx['jumlah_sablon']));?></td>
                  <td><?= $r['nota'];?></td>
                  <td><?= number_format(lusin($rP['jumlah_produksi']));?></td>
                  <td><?= number_format(pcs($rP['jumlah_produksi']));?></td>
                  <td><?= number_format(lusin($rK['jumlah_kirim']));?></td>
                  <td><?= number_format(pcs($rK['jumlah_kirim']));?></td>
                  <td><?= number_format(lusin($rB['jumlah_bs']));?></td>
                  <td><?= number_format(pcs($rB['jumlah_bs']));?></td>
                  <td><?= $r['notes'];?></td>
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