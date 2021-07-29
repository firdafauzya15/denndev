<?php
if ($_GET['cari'] != "") {
  $paramsSearch = "?id_cmt=$_GET[id_cmt]&dari=$_GET[dari]&sampai=$_GET[sampai]&cari=$_GET[cari]";
} else {
  $paramsSearch = "";
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data QC SPK Cutting
    </h1>
    <ol class="breadcrumb">
      <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">QC</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-body table-responsive">
            <a href="?act=<?php echo md5('qc_cutting_add')?>" class="btn btn-info"><i class="fa fa-plus"></i> Tambah Data</a>
            <hr>
            <form action="#" method="get" class="form-horizontal">
              <input type="hidden" name="act" value="<?= md5("qc");?>">
              <div class="row">
                <div class="col-md-3">
                  <select class="form-control select2" name="id_cmt" id="id_cmt">
                    <option value="">Semua Potong</option>
                    <?php
                      $cmts = mysqli_query($link,"SELECT * FROM cmt ORDER BY nm_cmt ASC");
                      while ($cmt = mysqli_fetch_array($cmts)) {
                        $selected = "";
                        if ($cmt['id_cmt'] == $_GET['id_cmt']) {
                          $selected = "selected";
                        }
                        echo "<option value='$cmt[id_cmt]' $selected>$cmt[nm_cmt]</option>";
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
                <div class="col-md-1">
                  <a class="btn btn-warning" href="#" onClick="MyWindow=window.open('master/pg_qc/print_qc.php<?= $paramsSearch;?>','MyWindow','width=794,height=842'); return false;"><i class="glyphicon glyphicon-print icon-white"></i> Print</a>
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
                  <th>CMT</th>
                  <th>Kode</th>
                  <th>Jumlah Penalty</th>
                  <th>Keterangan</th>
                  <th width="1">Status</th>
                </tr>
              </thead>
              <tbody>
              <?php
                $i = 0;
                $limit = 100;
                $where = "WHERE ";
                // if ($_GET['dari'] != '' AND $_GET['sampai'] != '') {
                //   $where .= "(date(qc.tanggal) >= '$_GET[dari]') AND (date(qc.tanggal) <= '$_GET[sampai]') AND ";
                // } else {
                //   $where .= "qc.tanggal != '' AND ";
                // }

                if ($_GET['id_cmt'] != '') {
                  $where .= "qc.id_potong = '$_GET[id_potong]' ";
                } else {
                  $where .= "qc.id_potong != '' ";
                }
               
                $q = mysqli_query($link,"SELECT 
                  *   
                  FROM 
                  qc 
                  INNER JOIN potong ON potong.id_potong = qc.id_potong
                  $where 
                  ORDER BY id_qc DESC 
                  LIMIT $limit
                  ");
                if (mysqli_num_rows($q) > 0) {
                  while ($r = mysqli_fetch_array($q)) {
                    $id_qc = base64_encode($r['id_qc']);
                    $i++;

                    $nol = base64_encode("0");
                    $satu = base64_encode("1");
                    $status = "<a href='?act=".md5('qc_approve')."&id_qc=$id_qc&lns=$satu' title='Ubah Status' onclick='return confirm(\"Apakah anda yakin?\")'><span class='label label-warning'>Pending</span></a>";
                    if ($r['status'] == '1') {
                      $status = "<a href='?act=".md5('qc_approve')."&id_qc=$id_qc&lns=$nol' title='Ubah Status' onclick='return confirm(\"Apakah anda yakin?\")'><span class='label label-success'>Done</span></a>";
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
                            <?php
                            if ($_SESSION['id_level'] != 5) {
                            ?>
                              <li><a href="?act=<?php echo md5('qc_edit')."&id_qc=$id_qc"?>"><i class="fa fa-pencil"></i>Ubah</a></li>
                              <?php
                              if ($_SESSION['id_level'] == 1) {
                              ?>
                                <li><a href="?act=<?php echo md5('qc_delete')."&id_qc=$id_qc"?>" onclick="return confirm('Apakah anda yakin ?')"><i class="fa fa-trash"></i>Hapus</a></li>
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
                      <td><?= $r['nm_cmt'];?></td>
                      <td><?= $r['kd_produk'];?></td>
                      <td><?= $r['jumlah_penalty'];?></td>
                      <td><?= $r['keterangan'];?></td>
                      <td><?= $status;?></td>
                    </tr>
              <?php
                  }
                } else {
              ?>
                  <tr>
                    <td colspan="9" align="center">Data tidak ada</td>
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