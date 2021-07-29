<div class="content-wrapper">
<?
 	$bc[] = array('title' => 'User', 'url' => '#', 'active' => '1');
	echo $lib->breadcrumbs("Data User",$bc);
?>

  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-body">
            <a href="?act=<?= md5('user_add')?>" class="btn btn-info"><i class="fa fa-plus"></i> Tambah Data</a>
            <hr>
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th width="1">No.</th>
                  <th width="50">Aksi</th>
                  <th>Nama</th>
                  <th>Username</th>
                  <th>Level</th>
                  <th>Toko</th>
                  <th>Gudang</th>
                </tr>
              </thead>
              <tbody>
              <?php
                $i = 0;
                $q = mysqli_query($link,"SELECT * FROM user
                     INNER JOIN _level ON _level.id_level = user.id_level
                     LEFT JOIN toko ON toko.id_toko = user.id_toko
                     LEFT JOIN gudang ON gudang.id_gudang = user.id_gudang
                     WHERE 
                     user.is_support != 1
                     ORDER BY id_user DESC");
                while ($r = mysqli_fetch_array($q)) {
                  $id_user = base64_encode($r['id_user']);
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
                          <li><a href="?act=<?= md5('user_edit')."&id_user=$id_user"?>"><i class="fa fa-pencil"></i>Ubah</a></li>
                          <?php
                          if ($_SESSION['id_level'] == 1) {
                          ?>
                            <li><a href="?act=<?= md5('user_delete')."&id_user=$id_user"?>" onclick="return confirm('Apakah anda yakin ?')"><i class="fa fa-trash"></i>Hapus</a></li>
                          <?php
                          }
                          ?>
                        </ul>
                      </div>
                    </td>
                    <td><?= $r['name'];?></td>
                    <td><?= $r['username'];?></td>
                    <td><?= $r['nm_level'];?></td>
                    <td><?= $r['nm_toko']??"<span class='text-muted'>None</span>";?></td>
                    <td><?= $r['nm_gudang']??"<span class='text-muted'>None</span>";?></td>
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