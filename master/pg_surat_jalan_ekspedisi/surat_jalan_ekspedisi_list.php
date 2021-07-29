<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data Surat Jalan Ekspedisi
    </h1>
    <ol class="breadcrumb">
      <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Surat Jalan Ekspedisi</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-body">
            <a href="?act=<?php echo md5('surat_jalan_ekspedisi_add')?>" class="btn btn-info"><i class="fa fa-plus"></i> Tambah Data</a>
            <hr>
            <form action="#" method="get" class="form-horizontal">
              <input type="hidden" name="act" value="<?= md5('surat_jalan_ekspedisi');?>">
              <div class="row">
                <div class="col-md-3">
                  <select class="form-control select2" name="id_customer">
                    <option value="">Semua Customer</option>
                    <?php
                      $customers = mysqli_query($link,"SELECT * FROM customer ORDER BY nm_customer ASC");
                      while ($customer = mysqli_fetch_array($customers)) {
                        $selected = "";
                        if ($customer['id_customer'] == $_GET['id_customer']) {
                          $selected = "selected";
                        }
                        echo "<option value='$customer[id_customer]' $selected>$customer[nm_customer]</option>";
                      }
                    ?>
                  </select>
                </div>
                <div class="col-md-2">
                  <div class="input-group date">
                    <input type="text" name="dari" class="form-control pull-right" id="datepicker" placeholder="Dari" value="<?= $_GET['dari'];?>">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="input-group date">
                    <input type="text" name="sampai" class="form-control pull-right" id="datepicker2" placeholder="Sampai" value="<?= $_GET['sampai'];?>">
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
            <table class="table">
              <thead>
                <tr>
                  <th width="1">No.</th>
                  <th width="100">Aksi</th>
                  <th>Tanggal</th>
                  <th>customer</th>
                  <th>Keterangan</th>
                </tr>
              </thead>
              <tbody>
              <?php
                $i = 0;
                $limit = 100;
                $where = "WHERE ";
                if ($_GET['dari'] != '' AND $_GET['sampai'] != '') {
                  $where .= "(date(surat_jalan_ekspedisi.tanggal) >= '$_GET[dari]') AND (date(surat_jalan_ekspedisi.tanggal) <= '$_GET[sampai]') AND ";
                } else {
                  $where .= "surat_jalan_ekspedisi.tanggal != '' AND ";
                }

                if ($_GET['id_customer'] != '') {
                  $where .= "surat_jalan_ekspedisi.id_customer = '$_GET[id_customer]' ";
                } else {
                  $where .= "surat_jalan_ekspedisi.id_customer != '' ";
                }
                $q = mysqli_query($link,"SELECT 
                  surat_jalan_ekspedisi.id_surat_jalan_ekspedisi,
                  surat_jalan_ekspedisi.tanggal,
                  surat_jalan_ekspedisi.keterangan,
                  customer.nm_customer
                  FROM 
                  surat_jalan_ekspedisi 
                  INNER JOIN customer ON customer.id_customer = surat_jalan_ekspedisi.id_customer
                  $where 
                  ORDER BY id_surat_jalan_ekspedisi DESC 
                  LIMIT $limit
                  ");
                while ($r = mysqli_fetch_array($q)) {
                  $id_surat_jalan_ekspedisi = base64_encode($r['id_surat_jalan_ekspedisi']);
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
                          <li><a href="?act=<?php echo md5('surat_jalan_ekspedisi_edit')."&id_surat_jalan_ekspedisi=$id_surat_jalan_ekspedisi"?>"><i class="fa fa-pencil"></i>Ubah</a></li>
                          <li><a href="?act=<?php echo md5('surat_jalan_ekspedisi_delete')."&id_surat_jalan_ekspedisi=$id_surat_jalan_ekspedisi"?>" onclick="return confirm('Apakah anda yakin ?')"><i class="fa fa-trash"></i>Hapus</a></li>
                        </ul>
                      </div>
                    </td>
                    <td><?= $r['tanggal'];?></td>
                    <td><?= $r['nm_customer'];?></td>
                    <td><?= $r['keterangan'];?></td>
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