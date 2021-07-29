<?php
include "master/function/nota.php";
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data Surat Jalan antar Toko
    </h1>
    <ol class="breadcrumb">
      <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Surat Jalan antar Toko</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-body">
            <a href="?act=<?php echo md5('surat_jalan_toko_add')?>" class="btn btn-info"><i class="fa fa-plus"></i> Tambah Data</a>
            <hr>
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th width="1">No.</th>
                  <th width="50">Aksi</th>
                  <th>Tanggal</th>
                  <th>Nota</th>
                  <th>Toko Awal</th>
                  <th>Toko Tujuan</th>
                </tr>
              </thead>
              <tbody>
              <?php
                $i = 0;
                $q = mysqli_query($link,"SELECT 
                      surat_jalan_toko.id_surat_jalan_toko, 
                      surat_jalan_toko.id_toko, 
                      surat_jalan_toko.id_toko_tujuan, 
                      surat_jalan_toko.tanggal, 
                      toko.nm_toko
                      FROM 
                      surat_jalan_toko 
                      INNER JOIN toko ON toko.id_toko = surat_jalan_toko.id_toko 
                      GROUP BY surat_jalan_toko.id_surat_jalan_toko
                      ORDER BY surat_jalan_toko.id_surat_jalan_toko DESC
                      ") or die (mysqli_error());
                while ($r = mysqli_fetch_array($q)) {
                  $rTT = mysqli_fetch_array(mysqli_query($link,"SELECT nm_toko FROM toko WHERE id_toko = '$r[id_toko_tujuan]'"));
                  $id_surat_jalan_toko = base64_encode($r['id_surat_jalan_toko']);
                  $id_toko = base64_encode($r['id_toko']);
                  $id_toko_tujuan = base64_encode($r['id_toko_tujuan']);
                  $nota = notaSuratJalan($r['id_surat_jalan_toko']);
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
                          <li><a href="?act=<?php echo md5('surat_jalan_toko_detail')."&id_surat_jalan_toko=$id_surat_jalan_toko"?>"><i class="fa fa-eye"></i>Detail</a></li>
                          <?php
                          if ($_SESSION['id_level'] == 1) {
                          ?>
                            <li><a href="?act=<?php echo md5('surat_jalan_toko_delete')."&id_surat_jalan_toko=$id_surat_jalan_toko&id_toko=$id_toko&id_toko_tujuan=$id_toko_tujuan"?>" onclick="return confirm('Apakah anda yakin ?')"><i class="fa fa-trash"></i>Hapus</a></li>
                          <?php
                          }
                          ?>
                        </ul>
                      </div>
                    </td>
                    <td><?= $r['tanggal'];?></td>
                    <td><?= $nota;?></td>
                    <td><?= $r['nm_toko'];?></td>
                    <td><?= $rTT['nm_toko'];?></td>
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