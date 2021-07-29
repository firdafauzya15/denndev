<?php
include "master/function/nota.php";
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data Retur Bahan
    </h1>
    <ol class="breadcrumb">
      <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Retur Bahan</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-body">
            <a href="?act=<?php echo md5('retur_bahan_add')?>" class="btn btn-info"><i class="fa fa-plus"></i> Tambah Data</a>
            <hr>
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th width="1">No.</th>
                  <th width="50">Aksi</th>
                  <th>Tanggal</th>
                  <th>Nota</th>
                  <th>Supplier</th>
                </tr>
              </thead>
              <tbody>
              <?php
              $i = 0;
              $q = mysqli_query($link,"SELECT 
                    retur_bahan.id_retur_bahan, 
                    retur_bahan.id_supplier_bahan, 
                    retur_bahan.tanggal, 
                    supplier_bahan.nm_supplier_bahan
                    FROM 
                    retur_bahan 
                    INNER JOIN supplier_bahan ON supplier_bahan.id_supplier_bahan = retur_bahan.id_supplier_bahan 
                    GROUP BY retur_bahan.id_retur_bahan
                    ORDER BY retur_bahan.id_retur_bahan DESC
                    ") or die (mysqli_error());
              while ($r = mysqli_fetch_array($q)) {
                $id_retur_bahan = base64_encode($r['id_retur_bahan']);
                $id_supplier_bahan = base64_encode($r['id_supplier_bahan']);
                $nota = notaReturBahan($r['id_retur_bahan']);
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
                        <li><a href="?act=<?php echo md5('retur_bahan_detail')."&id_retur_bahan=$id_retur_bahan"?>"><i class="fa fa-eye"></i>Detail</a></li>
                        <?php
                        if ($_SESSION['id_level'] == 1) {
                        ?>
                          <li><a href="?act=<?php echo md5('retur_bahan_delete')."&id_retur_bahan=$id_retur_bahan&id_supplier_bahan=$id_supplier_bahan"?>" onclick="return confirm('Apakah anda yakin ?')"><i class="fa fa-trash"></i>Hapus</a></li>
                        <?php
                        }
                        ?>
                      </ul>
                    </div>
                  </td>
                  <td><?= $r['tanggal'];?></td>
                  <td><?= $nota;?></td>
                  <td><?= $r['nm_supplier_bahan'];?></td>
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