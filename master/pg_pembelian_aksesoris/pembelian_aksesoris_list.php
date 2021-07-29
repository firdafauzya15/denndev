<div class="content-wrapper">
<?
 	$bc[] = array('title' => 'Pembelian Aksesoris', 'url' => '#', 'active' => '1');
	echo $lib->breadcrumbs("Data Pembelian Aksesoris",$bc);
?>

  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-body">
            <a href="?act=<?= md5('pembelian_aksesoris_add')?>" class="btn btn-info"><i class="fa fa-plus"></i> Tambah Data</a>
            <hr>
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th width="1">No.</th>
                  <th width="50">Aksi</th>
                  <th>Tanggal</th>
                  <th>Supplier</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
              <?php
                $i = 0;
                $q = mysqli_query($link,"SELECT 
                      pembelian_aksesoris.id_pembelian_aksesoris, 
                      pembelian_aksesoris.id_supplier_aksesoris, 
                      pembelian_aksesoris.tanggal, 
                      supplier_aksesoris.nm_supplier_aksesoris
                      FROM 
                      pembelian_aksesoris 
                      INNER JOIN supplier_aksesoris ON supplier_aksesoris.id_supplier_aksesoris = pembelian_aksesoris.id_supplier_aksesoris 
                      Group By pembelian_aksesoris.id_pembelian_aksesoris
                      Order By pembelian_aksesoris.id_pembelian_aksesoris DESC
                      ") or die (mysqli_error());
                while ($r = mysqli_fetch_array($q)) {
                    $x = mysqli_query($link,"SELECT * FROM pembelian_aksesoris_detail where id_pembelian_aksesoris='".$r['id_pembelian_aksesoris']."'");

                  $id_pembelian_aksesoris = base64_encode($r['id_pembelian_aksesoris']);
                  $id_supplier_aksesoris = base64_encode($r['id_supplier_aksesoris']);
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
                          <li><a href="?act=<?= md5('pembelian_aksesoris_detail')."&id_pembelian_aksesoris=$id_pembelian_aksesoris"?>"><i class="fa fa-eye"></i>Detail</a></li>
                          <?php
                          if ($_SESSION['id_level'] == 1) {
                          ?>
                            <li><a href="?act=<?= md5('pembelian_aksesoris_delete')."&id_pembelian_aksesoris=$id_pembelian_aksesoris&id_supplier_aksesoris=$id_supplier_aksesoris"?>" onclick="return confirm('Apakah anda yakin ?')"><i class="fa fa-trash"></i>Hapus</a></li>
                          <?php
                          }
                          ?>
                        </ul>
                      </div>
                    </td>
                    <td><?= $r['tanggal'];?></td>
                    <td><?= $r['nm_supplier_aksesoris'];?></td>
                    <td>
                    <table class="table table-bordered">
                      <?php
                        while ($y = mysqli_fetch_array($x)) {
                          echo "<tr><td width='300px'>".$y['kd_aksesoris']."</td><td width='100px'>".$y['jumlah']."</td><td>".$y['uom']."</td></tr>";
                        }
                      ?>
                        </table>
                    </td>
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