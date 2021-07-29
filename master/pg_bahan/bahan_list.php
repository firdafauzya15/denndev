<div class="content-wrapper">
<?
 	$bc[] = array('title' => 'Bahan', 'url' => '#', 'active' => '1');
	echo $lib->breadcrumbs("Data Bahan",$bc);
?>

  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-body">
            <a href="?act=<?php echo md5('bahan_add')?>" class="btn btn-info"><i class="fa fa-plus"></i> Tambah Data</a>
            <hr>
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th width="1">No.</th>
                  <th width="50">Aksi</th>
                  <th>Kode</th>
                  <th>Nama</th>
                  <th>Satuan</th>
                </tr>
              </thead>
              <tbody>
              <?php
                $i = 0;
                $q = mysqli_query($link,"SELECT 
                      * 
                      FROM 
                      bahan_header 
                      INNER JOIN _satuan_bahan ON _satuan_bahan.id_satuan_bahan = bahan_header.id_satuan_bahan
                      ORDER BY id_bahan_header DESC
                      ") or die (mysqli_error());
                while ($r = mysqli_fetch_array($q)) {
                  $id_bahan_header = base64_encode($r['id_bahan_header']);
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
                            echo '<li><a href="?act='.md5('bahan_edit').'&id_bahan_header='.$id_bahan_header.'"><i class="fa fa-pencil"></i>Ubah</a></li>';
                            if ($_SESSION['id_level'] == 1) {
                              echo '<li><a href="?act='.md5('bahan_delete').'&id_bahan_header='.$id_bahan_header.'" onclick="return confirm(\'Apakah anda yakin ?\')"><i class="fa fa-trash"></i>Hapus</a></li>';
                            }
                          }
                        ?>
                        </ul>
                      </div>
                    </td>
                    <td><?= $r['kd_bahan_header'];?></td>
                    <td><?= $r['nm_bahan_header'];?></td>
                    <td><?= $r['nm_satuan_bahan'];?></td>
                  </tr>
              <?php
                }
              ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>