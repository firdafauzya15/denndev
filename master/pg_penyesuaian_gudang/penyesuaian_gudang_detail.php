<?php

$id_penyesuaian_gudang = base64_decode($_GET['id_penyesuaian_gudang']);
$q = mysqli_query($link,"SELECT 
                      penyesuaian_gudang.id_penyesuaian_gudang, 
                      penyesuaian_gudang.tanggal
                      FROM 
                      penyesuaian_gudang 
                      WHERE penyesuaian_gudang.id_penyesuaian_gudang = '$id_penyesuaian_gudang'") or die (mysqli_error());
$r = mysqli_fetch_array($q);

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Detail Penyesuaian Gudang
    </h1>
    <ol class="breadcrumb">
      <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Penyesuaian Gudang</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Data Penyesuaian Gudang</h3>
          </div><!-- /.box-header -->
          <br>
          <div class="box-body">
	          <div class="row">
		          <div class="col-md-6">
			          <table class="table table-bordered"
			          	<tr>
			          		<td>Tanggal</td>
			          		<td><?= $r['tanggal'];?></td>
			          	</tr>
			          </table>
		          </div>
	          </div>
	          <hr>
	          <div class="row">
		          <div class="col-md-12">
			          <table class="table table-bordered">
                  <tr>
                    <th width="1">No.</th>
                    <th>Kode</th>
                    <th>Stok Lama</th>
                    <th>Selisih</th>
                    <th>Stok Baru</th>
                    <th>Total</th>
                  </tr>
                  <?php
                  $i = 0;
                  $total = 0;
                  $q = mysqli_query($link,"SELECT 
                        penyesuaian_gudang_detail.selisih,
                        penyesuaian_gudang_detail.stok_lama,
                        penyesuaian_gudang_detail.stok_baru,
                        penyesuaian_gudang_detail.kd_produk_size,
                        penyesuaian_gudang_detail.total
                        FROM 
                        penyesuaian_gudang_detail 
                        WHERE 
                        penyesuaian_gudang_detail.id_penyesuaian_gudang = '$id_penyesuaian_gudang'
                        ") or die (mysqli_error());
                  while ($r = mysqli_fetch_array($q)) {
                    $i++;
                    $total += $r['total'];
                  ?>
                    <tr>
                      <td><?= $i;?></td>
                      <td><?= $r['kd_produk_size'];?></td>
                      <td><?= $r['stok_lama'];?></td>
                      <td><?= $r['selisih'];?></td>
                      <td><?= $r['stok_baru'];?></td>
                      <td><?= number_format($r['total']);?></td>
                    </tr>
                  <?php
                  }
                  ?>
                  <tr style="font-weight: bold;">
                    <td colspan="5" class="text-right">Total</td>
                    <td><?= number_format($total);?></td>
                  </tr>
			          </table>
			          <hr>
			          <a class="btn btn-danger" onclick="window.history.back()"> Kembali</a>
		          </div>
	          </div>
          </div>
        </div><!-- /.box -->
      </div>
    </div><!-- /.row -->
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->