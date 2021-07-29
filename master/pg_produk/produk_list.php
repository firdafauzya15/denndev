<div class="content-wrapper">
<?
 	$bc[] = array('title' => 'Produk', 'url' => '#', 'active' => '1');
	echo $lib->breadcrumbs("Data Produk",$bc);
?>
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-body">
            <?php if ($_SESSION['id_level'] != 11) { ?>
              <a href="?act=<?= md5('produk_add')?>" class="btn btn-info"><i class="fa fa-plus"></i> Tambah Data</a><hr>
            <?php } ?>
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th width="1">No.</th>
                  <th width="50">Aksi</th>
                  <th width="1">Gambar</th>
                  <th>Brand</th>
                  <th>Pola</th>
                  <th>Kode Produk</th>
                  <th>Model</th>
                  <th>Nama Produk</th>
                  
                  <th width="1">Tipe</th>
                </tr>
              </thead>
              <tbody>
              <?php
                $i = 0;
                $q = mysqli_query($link,"SELECT *, produk.file AS file FROM  produk INNER JOIN model on model.id_model = produk.id_model INNER JOIN pola ON pola.id_pola = produk.id_pola INNER JOIN brand ON brand.id_brand = produk.id_brand ORDER BY id_produk DESC") or die (mysqli_error());
                while ($r = mysqli_fetch_array($q)) {
                  $id_produk = base64_encode($r['id_produk']);
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
                          <li><a href="?act=<?= md5('produk_detail')."&id_produk=$id_produk"?>"><i class="fa fa-eye"></i>Detail</a></li>
                          <?php
                            if ($_SESSION['id_level'] != 5) {
                              echo '<li><a href="?act='.md5('produk_edit').'&id_produk='.$id_produk.'"><i class="fa fa-pencil"></i>Ubah</a></li>';
                              if ($_SESSION['id_level'] == 1) {
                              echo '<li><a href="?act='.md5('produk_delete').'&id_produk='.$id_produk.'" onclick="return confirm(\'Apakah anda yakin ?\')"><i class="fa fa-trash"></i>Hapus</a></li>';
                              }
                            }
                          ?>
                        </ul>
                      </div>
                    </td>
                    
                    <td><?= $r['file']==""?"<span class='text-muted'>None</span>": "<img src='upload/".$r['file']."' height='50' width='50'>"?>
                    </td>
                    <td><?= $r['nm_brand'];?></td>
                    <td><?= $r['kd_pola'];?></td>
                    <td><?= $r['kd_produk'];?></td>
                    <td><?= $r['id_model']==""?"<span class='text-muted'>None</span>":$r['nm_model'];?></td>
                    <td><?= $r['nm_produk'];?></td>
                    
                    <td><?= $r['id_tipe_produk'] == '2'? "<span class='label label-success'>Barang Jadi</span>":"<span class='label label-warning'>Barang Produksi</span>"?></td>
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