<div class="content-wrapper">
<?
 	$bc[] = array('title' => 'Keluar Merk', 'url' => '#', 'active' => '1');
	echo $lib->breadcrumbs("Data Keluar Merk ke CMT",$bc);
?>

  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-body">
            <a href="?act=<?= md5('potongan_merk_add')?>" class="btn btn-info"><i class="fa fa-plus"></i> Tambah Data</a><hr>
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th width="1">No.</th>
                  <th width="50">Aksi</th>
                  <th>Tanggal</th>
                  <th>CMT</th>
                  <th>Brand</th>
                  <th width="1">Status</th>
                </tr>
              </thead>
              <tbody>
              <?php
                $i = 0;
                $q = mysqli_query($link,"SELECT 
                  *
                  FROM 
                  potongan_merk 
                  INNER JOIN cmt ON cmt.id_cmt = potongan_merk.id_cmt 
                  left JOIN brand on brand.id_brand = potongan_merk.id_brand
                  GROUP BY potongan_merk.id_potongan_merk
                  ORDER BY potongan_merk.id_potongan_merk DESC
                ") or die (mysqli_error());
                while ($r = mysqli_fetch_array($q)) {
                 
          

                  $id_potongan_merk = base64_encode($r['id_potongan_merk']);
                  $id_cmt = base64_encode($r['id_cmt']);
                  $i++;

                  $nol = base64_encode("0");
                  $satu = base64_encode("1");
                  $status = "<a href='?act=".md5('potongan_merk_approve')."&id_potongan_merk=$id_potongan_merk&lns=$satu' title='Ubah Status' onclick='return confirm(\"Apakah anda yakin?\")'><span class='label label-warning'>Pending</span></a>";
                  if ($r['status'] == '1') {
                    $status = "<a href='?act=".md5('potongan_merk_approve')."&id_potongan_merk=$id_potongan_merk&lns=$nol' title='Ubah Status' onclick='return confirm(\"Apakah anda yakin?\")'><span class='label label-success'>Done</span></a>";
                  }
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
                          <li><a href="?act=<?php echo md5('potongan_merk_detail')."&id_potongan_merk=$id_potongan_merk"?>"><i class="fa fa-eye"></i>Detail</a></li>
                          <?php
                          if ($_SESSION['id_level'] == 1) {
                          ?>
                            <li><a href="?act=<?php echo md5('potongan_merk_delete')."&id_potongan_merk=$id_potongan_merk&id_cmt=$id_cmt"?>" onclick="return confirm('Apakah anda yakin ?')"><i class="fa fa-trash"></i>Hapus</a></li>
                          <?php
                          }
                          ?>
                        </ul>
                      </div>
                    </td>
                    <td><?= $r['tanggal'];?></td>
                    <td><?= $r['nm_cmt'];?></td>
                    <td><?= $r['nm_brand'];?></td>
                    <td><?= $status;?></td>
                  </tr>
              <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>