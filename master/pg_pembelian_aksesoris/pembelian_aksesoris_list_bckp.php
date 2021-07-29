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
                  <th colspan='3'></th>
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
                    $jml = mysqli_num_rows($x);
                  $id_pembelian_aksesoris = base64_encode($r['id_pembelian_aksesoris']);
                  $id_supplier_aksesoris = base64_encode($r['id_supplier_aksesoris']);
                  $i++;
                  $a=1;
                  while ($y = mysqli_fetch_array($x)) {
                    if($a==1){
                      echo "<tr>";
                      echo "<td rowspan='".$jml."'>".$i."</td>";
                      echo "<td rowspan='".$jml."'>";
                      echo "<div class='btn-group'>";
                      echo "<button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown' aria-expanded='false'><i class='fa fa-cog'></i></button>";
                      echo "<button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown' aria-expanded='false'>";
                      echo "<span class='caret'></span><span class='sr-only'>Toggle Dropdown</span></button>";
                      echo "<ul class='dropdown-menu' role='menu'>";
                      echo '<li><a href="?act='.md5('pembelian_aksesoris_detail').'&id_pembelian_aksesoris='.$id_pembelian_aksesoris.'"><i class="fa fa-eye"></i>Detail</a></li>';
                      if ($_SESSION['id_level'] == 1) {
                        echo '<li><a href="?act='.md5('pembelian_aksesoris_delete').'&id_pembelian_aksesoris='.$id_pembelian_aksesoris.'id_supplier_aksesoris='.$id_supplier_aksesoris.'" onclick="return confirm(\'Apakah anda yakin ?\')"><i class="fa fa-trash"></i>Hapus</a></li>';
                      }
                      echo "";
                      echo "</ul>";
                      echo "</div>";
                      echo "</td>";
                      echo "<td rowspan='".$jml."'>".$r['tanggal']."</td>";
                      echo "<td rowspan='".$jml."'>".$r['nm_supplier_aksesoris']."</td>";
                      echo "<td>".$y['kd_aksesoris']."</td>";
                      echo "<td>".$y['jumlah']."</td>";
                      echo "<td>".$y['uom']."</td>";
                      echo "</tr>";
                    }else{
                      echo "<tr>";
                    
                      echo "<td>".$y['kd_aksesoris']."</td>";
                      echo "<td>".$y['jumlah']."</td>";
                      echo "<td>".$y['uom']."</td>";
                      echo "</tr>";
                    }
                      $a++;
                  }
              
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