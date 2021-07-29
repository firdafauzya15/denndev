<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data Penyesuaian Gudang
    </h1>
    <ol class="breadcrumb">
      <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Penyesuaian Gudang</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-body">
            <a href="?act=<?php echo md5('penyesuaian_gudang_add')?>" class="btn btn-info"><i class="fa fa-plus"></i> Tambah Data</a>
            <hr>
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th width="1">No.</th>
                  <th width="50">Aksi</th>
                  <th>Tanggal</th>
                </tr>
              </thead>
              <tbody>
              <?php
                $i = 0;
                $q = mysqli_query($link,"SELECT 
                      penyesuaian_gudang.id_penyesuaian_gudang, 
                      penyesuaian_gudang.tanggal 
                      FROM 
                      penyesuaian_gudang 
                      Group By penyesuaian_gudang.id_penyesuaian_gudang
                      Order By penyesuaian_gudang.id_penyesuaian_gudang DESC
                      ") or die (mysqli_error());
                while ($r = mysqli_fetch_array($q)) {
                  $id_penyesuaian_gudang = base64_encode($r['id_penyesuaian_gudang']);
                  $id_gudang = base64_encode($r['id_gudang']);
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
                          <li><a href="?act=<?php echo md5('penyesuaian_gudang_detail')."&id_penyesuaian_gudang=$id_penyesuaian_gudang"?>"><i class="fa fa-eye"></i>Detail</a></li>
                        </ul>
                      </div>
                    </td>
                    <td><?= $r['tanggal'];?></td>
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