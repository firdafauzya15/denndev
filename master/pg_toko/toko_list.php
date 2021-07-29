<div class="content-wrapper">
<?
 	$bc[] = array('title' => 'Toko', 'url' => '#', 'active' => '1');
	echo $lib->breadcrumbs("Data Toko",$bc);
?>
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-body">
            <a href="?act=<?= md5('toko_add')?>" class="btn btn-info"><i class="fa fa-plus"></i> Tambah Data</a>
            <hr>
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th width="1">No.</th>
                  <th width="50">Aksi</th>
                  <th>Nama</th>
                  <th>Alamat</th>
                  <th>Prefix Nota</th>
                  <th width="1">Logo</th>
                </tr>
              </thead>
              <tbody>
              <?php
                $i = 0;
                $q = mysqli_query($link,"SELECT * FROM toko ORDER BY id_toko DESC");
                while ($r = mysqli_fetch_array($q)) {
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
                          <li><a href="?act=<?= md5('toko_edit')."&id_toko=$id_toko"?>"><i class="fa fa-pencil"></i>Ubah</a></li>
                          <?php
                          if ($_SESSION['id_level'] == 1) {
                            echo '<li><a href="?act='.md5('toko_delete').'&id_toko='.$id_toko.'" onclick="return confirm(\'Apakah anda yakin ?\')"><i class="fa fa-trash"></i>Hapus</a></li>';
                          }
                          ?>
                        </ul>
                      </div>
                    </td>
                    <td><?= $r['nm_toko'];?></td>
                    <td><?= nl2br($r['alamat']);?></td>
                    <td><?= $r['prefix_nota'];?></td>
                    <td><img src="upload/<?= $r['file'];?>" height="64" width="64"></td>
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