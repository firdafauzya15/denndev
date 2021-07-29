<?php
$id_potongan_merk = base64_decode($_GET['id_potongan_merk']);
$q = mysqli_query($link,"SELECT 
											*
                      FROM 
                      potongan_merk 
                      Inner Join cmt ON cmt.id_cmt = potongan_merk.id_cmt 
                      WHERE potongan_merk.id_potongan_merk = '$id_potongan_merk'") or die (mysqli_error());
$r = mysqli_fetch_array($q);

$nol = base64_encode("0");
$satu = base64_encode("1");
$status = "<a href='?act=".md5('potongan_merk_approve')."&id_potongan_merk=$_GET[id_potongan_merk]&lns=$satu' title='Ubah Status' onclick='return confirm(\"Apakah anda yakin?\")'><span class='label label-warning'>Pending</span></a>";
if ($r['status'] == '1') {
  $status = "<a href='?act=".md5('potongan_merk_approve')."&id_potongan_merk=$_GET[id_potongan_merk]&lns=$nol' title='Ubah Status' onclick='return confirm(\"Apakah anda yakin?\")'><span class='label label-success'>Done</span></a>";
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Detail Potongan Merk
    </h1>
    <ol class="breadcrumb">
      <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Potongan Merk</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Data Potongan Merk</h3>
          </div><!-- /.box-header -->
          <br>
          <div class="box-body table-responsive">
	          <div class="row">
		          <div class="col-md-6">
			          <table class="table table-bordered">
			          	<tr>
			          		<td>Tanggal</td>
			          		<td><?= $r['tanggal'];?></td>
			          	</tr>
			          	<tr>
			          		<td>CMT</td>
			          		<td><?= $r['nm_cmt'];?></td>
			          	</tr>
			          	<tr>
			          		<td>Status</td>
			          		<td><?= $status;?></td>
			          	</tr>
                  <tr>
                    <td></td>
                    <td><a class="btn btn-warning" target="blank" href="master/pg_potongan_merk/print_potongan_merk.php?id=<?= $_GET['id_potongan_merk'];?>"><i class="glyphicon glyphicon-print icon-white"></i> Print</a></td>
                  </tr>
			          </table>
		          </div>
	          </div>
	          <hr>
	          <div class="row">
		          <div class="col-md-12">
			          <table class="table table-bordered">
			          	<tr>
			          		<td width="1">No</td>
			          		<td>Kode</td>
			          		<td>Nama</td>
			          		<td>Jumlah</td>
                    <td>Satuan</td>
			          		<td>Harga</td>
			          		<td>Total</td>
			          	</tr>
		              <?php
		                $i = 0;
		                $grandtotal = 0;
		                $q = mysqli_query($link,"SELECT 
		                      potongan_merk_detail.jumlah, 
		                      potongan_merk_detail.harga,
		                      (potongan_merk_detail.jumlah*potongan_merk_detail.harga) AS sub_total, 
		                      aksesoris.kd_aksesoris, 
		                      aksesoris.nm_aksesoris,
                          potongan_merk_detail.uom
		                      FROM 
		                      potongan_merk_detail 
		                      Inner Join aksesoris ON aksesoris.kd_aksesoris = potongan_merk_detail.kd_aksesoris
                      		WHERE potongan_merk_detail.id_potongan_merk = '$id_potongan_merk'
		                      ") or die (mysqli_error());
		                while ($r = mysqli_fetch_array($q)) {
		                	$i++;
		                	$grandtotal += $r['sub_total'];
		              ?>
					          	<tr>
					          		<td><?= $i;?></td>
					          		<td><?= $r['kd_aksesoris'];?></td>
					          		<td><?= $r['nm_aksesoris'];?></td>
					          		<td><?= $r['jumlah'];?></td>
                        <td><?= $r['uom'];?></td>
					          		<td><?= number_format($r['harga']);?></td>
					          		<td><?= number_format($r['sub_total']);?></td>
					          	</tr>
					        <?php
						      	}
						      ?>
						      <tr style="font-weight: bold;">
						      	<td colspan="5"></td>
					          <td><?= number_format($grandtotal);?></td>
						      </tr>
			          </table>
			          <hr>
                <b><u>Daftar Pembayaran</u></b> <br><br>
                <form action="home.php?act=<?php echo md5('potongan_merk_pembayaran_insert')?>" method="post">
                  <input type="hidden" name="id_potongan_merk" value="<?= $id_potongan_merk;?>">
                  <div class="row">
                    <div class="col-sm-2">
                      <div class="input-group date">
                        <input type="text" name="tanggal" class="form-control pull-right" id="datepicker" required placeholder="Tanggal">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-2">
                      <input type="number" name="nominal" class="form-control" id="inputEmail3" required placeholder="nominal">
                    </div>
                    <div class="col-sm-2">
                      <button type="submit" class="btn btn-primary" onclick="return confirm('Apakah anda yakin ?')">Simpan</button>
                    </div>
                  </div>
                </form>
                <br>
                <div class="row">
                  <div class="col-md-6">
                    <table class="table table-bordered">
                      <tr>
                        <th width="1">No.</th>
                        <th>Tanggal</th>
                        <th>Nominal</th>
                      </tr>
                      <?php
                      $i = 0;
                      $totalNominal = 0;
                      $potonganMerkPiutangs = mysqli_query($link,"SELECT * FROM potongan_merk_pembayaran WHERE id_potongan_merk = '$id_potongan_merk' ORDER BY id DESC") or die (mysqli_error());
                      while ($potonganMerkPiutang = mysqli_fetch_array($potonganMerkPiutangs)) { 
                        $i++;
                        $totalNominal += $potonganMerkPiutang['nominal'];
                      ?>
                        <tr>
                          <td><?= $i;?></td>
                          <td><?= $potonganMerkPiutang['tanggal'];?></td>
                          <td><?= number_format($potonganMerkPiutang['nominal']);?></td>
                        </tr>
                      <?php
                      }
                      ?>
                      <tr>
                        <th colspan="2" class="text-right">Total</th>
                        <th><?= number_format($totalNominal);?></th>
                      </tr>
                    </table>
                  </div>
                </div>
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