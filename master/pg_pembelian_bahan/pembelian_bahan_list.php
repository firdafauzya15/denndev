<?php include "master/function/nota.php"; ?>
<div class="content-wrapper">
<?
 	$bc[] = array('title' => 'Pembelian Bahan', 'url' => '#', 'active' => '1');
	echo $lib->breadcrumbs("Data Pembelian Bahan",$bc);
?>
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-body">
            <a href="?act=<?= md5('pembelian_bahan_add')?>" class="btn btn-info"><i class="fa fa-plus"></i> Tambah Data</a>
            <hr>
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th width="1">No.</th>
                  <th width="50">Aksi</th>
                  <th>Tanggal</th>
                  <th>Nota</th>
                  <th>Supplier</th>
                  <th>Keterangan</th>
                </tr>
              </thead>
              <tbody>
              <?php
                $i = 0;
                $q = mysqli_query($link,"SELECT 
                      pembelian_bahan.id_pembelian_bahan, 
                      pembelian_bahan.id_supplier_bahan, 
                      pembelian_bahan.tanggal, 
                      pembelian_bahan.keterangan, 
                      supplier_bahan.nm_supplier_bahan
                      FROM 
                      pembelian_bahan 
                      INNER JOIN supplier_bahan ON supplier_bahan.id_supplier_bahan = pembelian_bahan.id_supplier_bahan 
                      GROUP BY pembelian_bahan.id_pembelian_bahan
                      ORDER BY pembelian_bahan.id_pembelian_bahan DESC
                      ") or die (mysqli_error());
                while ($r = mysqli_fetch_array($q)) {
                  $id_pembelian_bahan = base64_encode($r['id_pembelian_bahan']);
                  $id_supplier_bahan = base64_encode($r['id_supplier_bahan']);
                  $nota = notaPembelianBahan($r['id_pembelian_bahan']);
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
                          <li><a href="?act=<?php echo md5('pembelian_bahan_detail')."&id_pembelian_bahan=$id_pembelian_bahan"?>"><i class="fa fa-eye"></i>Detail</a></li>
                          <?php
                          if ($_SESSION['id_level'] == 1) {
                          ?>
                            <li><a href="?act=<?php echo md5('pembelian_bahan_delete')."&id_pembelian_bahan=$id_pembelian_bahan&id_supplier_bahan=$id_supplier_bahan"?>" onclick="return confirm('Apakah anda yakin ?')"><i class="fa fa-trash"></i>Hapus</a></li>
                          <?php
                          }
                          ?>
                        </ul>
                      </div>
                    </td>
                    <td><?= $r['tanggal'];?></td>
                    <td><?= $nota;?></td>
                    <td><?= $r['nm_supplier_bahan'];?></td>
                    <td><?= $r['keterangan'];?></td>
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