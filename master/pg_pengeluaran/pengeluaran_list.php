<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data pengeluaran
    </h1>
    <ol class="breadcrumb">
      <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">pengeluaran</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-body">
            <a href="?act=<?php echo md5('pengeluaran_add')?>" class="btn btn-info"><i class="fa fa-plus"></i> Tambah Data</a>
            <hr>
            <form action="#" method="get" class="form-horizontal">
              <input type="hidden" name="act" value="6e80aeeec490acefa539dd9c55aa38fc">
              <div class="row">
                <div class="col-md-3">
                  <select class="form-control select2" name="id_toko" id="id_toko">
                    <option value="">Semua Toko</option>
                    <?php
                      $tokos = mysqli_query($link,"SELECT * FROM toko ORDER BY nm_toko ASC");
                      while ($toko = mysqli_fetch_array($tokos)) {
                        $selected = "";
                        if ($toko['id_toko'] == $_GET['id_toko']) {
                          $selected = "selected";
                        }
                        echo "<option value='$toko[id_toko]' $selected>$toko[nm_toko]</option>";
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
                  <th>Toko</th>
                  <th>Nominal</th>
                  <th>Keterangan</th>
                </tr>
              </thead>
              <tbody>
              <?php
                $i = 0;
                $limit = 100;
                $where = "WHERE ";
                if ($_GET['dari'] != '' AND $_GET['sampai'] != '') {
                  $where .= "(date(pengeluaran.tanggal) >= '$_GET[dari]') AND (date(pengeluaran.tanggal) <= '$_GET[sampai]') AND ";
                } else {
                  $where .= "pengeluaran.tanggal != '' AND ";
                }

                if ($_GET['id_toko'] != '') {
                  $where .= "pengeluaran.id_toko = '$_GET[id_toko]' ";
                } else {
                  $where .= "pengeluaran.id_toko != '' ";
                }
                $q = mysqli_query($link,"SELECT 
                  *   
                  FROM 
                  pengeluaran 
                  INNER JOIN toko ON toko.id_toko = pengeluaran.id_toko
                  $where 
                  ORDER BY id_pengeluaran DESC 
                  LIMIT $limit
                  ");
                while ($r = mysqli_fetch_array($q)) {
                  $id_pengeluaran = base64_encode($r['id_pengeluaran']);
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
                          if ($_SESSION['id_level'] != 5) {
                          ?>
                            <li><a href="?act=<?php echo md5('pengeluaran_edit')."&id_pengeluaran=$id_pengeluaran"?>"><i class="fa fa-pencil"></i>Ubah</a></li>
                            <?php
                            if ($_SESSION['id_level'] == 1) {
                            ?>
                              <li><a href="?act=<?php echo md5('pengeluaran_delete')."&id_pengeluaran=$id_pengeluaran"?>" onclick="return confirm('Apakah anda yakin ?')"><i class="fa fa-trash"></i>Hapus</a></li>
                            <?php
                            }
                            ?>
                          <?php
                          }
                          ?>
                        </ul>
                      </div>
                    </td>
                    <td><?= $r['tanggal'];?></td>
                    <td><?= $r['nm_toko'];?></td>
                    <td><?= number_format($r['nominal']);?></td>
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