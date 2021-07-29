<?php
include "master/function/nota.php";
?>
<div class="content-wrapper">
  <?
 	$bc[] = array('title' => 'Barang Masuk', 'url' => '#', 'active' => '1');
	echo $lib->breadcrumbs("Data Barang Masuk",$bc);
?>
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-body">
            <a href="?act=<?= md5('barang_masuk_add')?>" class="btn btn-info"><i class="fa fa-plus"></i> Tambah Data</a>
            <hr>
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th rowspan="2" width="1">No.</th>
                  <th rowspan="2" width="50">Aksi</th>
                  <th rowspan="2">Tanggal</th>
                  <th rowspan="2">Nota</th>
                  <th colspan="2">Total</th>
                </tr>
                <tr>
                  <th>Lusin</th>
                  <th>Pcs</th>
                </tr>
              </thead>
              <tbody>
              <?php
                $i = 0;
                $q = mysqli_query($link,"SELECT 
                      barang_masuk.id_barang_masuk, 
                      barang_masuk.tanggal, 
                      sum(barang_masuk_detail.jumlah) AS total 
                      FROM 
                      barang_masuk 
                      INNER JOIN barang_masuk_detail ON barang_masuk_detail.id_barang_masuk = barang_masuk.id_barang_masuk 
                      GROUP BY barang_masuk.id_barang_masuk
                      ORDER BY barang_masuk.id_barang_masuk DESC
                      ") or die (mysqli_error());
                while ($r = mysqli_fetch_array($q)) {
                  $id_barang_masuk = base64_encode($r['id_barang_masuk']);
                  $id_toko = base64_encode($r['id_toko']);
                  $i++;
                  $nota = notaBarangMasuk($r['id_barang_masuk']);
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
                          <li><a href="?act=<?php echo md5('barang_masuk_detail')."&id_barang_masuk=$id_barang_masuk"?>"><i class="fa fa-eye"></i>Detail</a></li>
                          <?php
                          if ($_SESSION['id_level'] == 1) {
                          ?>
                            <li><a href="?act=<?php echo md5('barang_masuk_delete')."&id_barang_masuk=$id_barang_masuk"?>" onclick="return confirm('Apakah anda yakin ?')"><i class="fa fa-trash"></i>Hapus</a></li>
                          <?php
                          }
                          ?>
                        </ul>
                      </div>
                    </td>
                    <td><?= $r['tanggal'];?></td>
                    <td><?= $nota;?></td>
                    <td><?= number_format(lusin($r['total']));?></td>
                    <td><?= number_format(pcs($r['total']));?></td>
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