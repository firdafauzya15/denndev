<div class="content-wrapper">
<?
 	$bc[] = array('title' => 'Pola', 'url' => '#', 'active' => '1');
	echo $lib->breadcrumbs("Data Pola",$bc);
?>

  <section class="content">
    	<div class="row">
      	<div class="col-xs-12">
        	<div class="box">
          	<div class="box-body">
            <a href="?act=<?= md5('pola_add')?>" class="btn btn-info"><i class="fa fa-plus"></i> Tambah Data</a><hr>
            <table id="example1" class="table table-bordered table-striped">
              	<thead>
                	<tr>
                    <th width="1">No.</th>
                    <th width="50">Aksi</th>
                    <th width="1">Gambar</th>
                    <th>Kode</th>
                    <th>Nama</th>
                  </tr>
              </thead>
              <tbody>
              <?php
                	$i = 0;
                	$q = mysqli_query($link,"SELECT * FROM pola ORDER BY id_pola DESC");
                	while ($r = mysqli_fetch_array($q)) {
							$id_pola = base64_encode($r['id_pola']);
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
                            echo '<li><a href="?act='.md5('pola_edit').'&id_pola='.$id_pola.'"><i class="fa fa-pencil"></i>Ubah</a></li>';
                            if ($_SESSION['id_level'] == 1) {
                            echo '<li><a href="?act='.md5('pola_delete').'&id_pola='.$id_pola.'" onclick="return confirm(\'Apakah anda yakin ?\')"><i class="fa fa-trash"></i>Hapus</a></li>';
                            }
                          }
                        ?>
                        </ul>
                      </div>
                    </td>
                    <td><?= $r['file']==""?"<span class='text-muted'>None</span>": "<img src='upload/".$r['file']."' height='50' width='50'>"?>
                    <td><?= $r['kd_pola'];?></td>
                    <td><?= $r['nm_pola'];?></td>
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