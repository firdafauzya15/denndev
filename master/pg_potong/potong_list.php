<div class="content-wrapper">
  <section class="content-header">
    <h1>Data Tukang Potong</h1>
    <ol class="breadcrumb">
      <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Tukang Potong</li>
    </ol>
  </section>

  <section class="content">
  <div class="row">
    <div class="col-xs-12">
        <div class="box">
          <div class="box-body">
            <a href="?act=<?php echo md5('potong_add')?>" class="btn btn-info"><i class="fa fa-plus"></i> Tambah Data</a>
            <hr>
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th width="1">No.</th>
                  <th width="50">Aksi</th>
                  <th>Nama</th>
                  <th>Telp</th>
                  <th>PIC</th>
                </tr>
              </thead>
              <tbody>
              <?php
                $i = 0;
                $q = mysqli_query($link,"SELECT * FROM potong ORDER BY id_potong DESC");
                while ($r = mysqli_fetch_array($q)) {
                  $id_potong = base64_encode($r['id_potong']);
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
                            echo '<li><a href="?act='.md5('potong_edit').'&id_potong='.$id_potong.'"><i class="fa fa-pencil"></i>Ubah</a></li>';
                            if ($_SESSION['id_level'] == 1) {
                              echo '<li><a href="?act='.md5('potong_delete').'&id_potong='.$id_potong.'" onclick="return confirm(\'Apakah anda yakin ?\')"><i class="fa fa-trash"></i>Hapus</a></li>';
                            }
                          }
                        ?>
                        </ul>
                      </div>
                    </td>
                    <td><?= $r['nm_potong'];?></td>
                    <td><?= $r['telp'];?></td>
                    <td><?= $r['pic'];?></td>
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