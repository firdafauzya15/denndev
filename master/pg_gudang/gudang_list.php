<div class="content-wrapper">
<?
 	$bc[] = array('title' => 'Gudang', 'url' => '#', 'active' => '1');
	echo $lib->breadcrumbs("Data Gudang",$bc);
?>

  	<section class="content">
    	<div class="row">
      	<div class="col-xs-12">
        	<div class="box">
          	<div class="box-body">
            	<a href="?act=<?php echo md5('gudang_add')?>" class="btn btn-info"><i class="fa fa-plus"></i> Tambah Data</a><hr>
           		<table id="example1" class="table table-bordered table-striped">
              	<thead>
                	<tr>
                  	<th width="1">No.</th>
                  	<th width="50">Aksi</th>
                  	<th>Nama</th>
                	</tr>
              	</thead>
              	<tbody>
              	<?php
                	$i = 0;
                	$q = mysqli_query($link,"SELECT * FROM gudang ORDER BY id_gudang DESC");
                	while ($r = mysqli_fetch_array($q)) {
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
                          	<?php
								if ($_SESSION['id_level'] != 5) {
									echo '<li><a href="?act='.md5('gudang_edit').'&id_gudang='.$id_gudang.'"><i class="fa fa-pencil"></i>Ubah</a></li>';
									if ($_SESSION['id_level'] == 1) {
									echo '<li><a href="?act='.md5('gudang_delete').'&id_gudang='.$id_gudang.'" onclick="return confirm(\'Apakah anda yakin ?\')"><i class="fa fa-trash"></i>Hapus</a></li>';
									}
								}
                          ?>
                        </ul>
                      </div>
                    </td>
                    <td><?= $r['nm_gudang'];?></td>
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