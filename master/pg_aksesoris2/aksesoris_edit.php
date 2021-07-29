<?php
		$id_aksesoris = base64_decode($_GET['id_aksesoris']);
		$q = mysqli_query($link,"SELECT * FROM aksesoris WHERE id_aksesoris = '$id_aksesoris'");
		$r = mysqli_fetch_array($q);
?>
<div class="content-wrapper">
<?
 	$bc[] = array('title' => 'Aksesoris', 'url' => 'home.php?act='.md5('aksesoris'), 'active' => '0');
	$bc[] = array('title' => 'Aksesoris Edit', 'url' => '#', 'active' => '1');
	echo $lib->breadcrumbs("Data Aksesoris",$bc);
?>

	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-info">
					<div class="box-header with-border"><h3 class="box-title">Ubah Aksesoris</h3></div>
					<form action="home.php?act=<?= md5('aksesoris_update')?>" method="post" class="form-horizontal">
						<input type="hidden" name="id_aksesoris" value="<?= $id_aksesoris;?>">
						<div class="box-body">
							<div class="form-group">
								<label for="kd_aksesoris" class="col-sm-2 control-label">Kode Aksesoris</label>
								<div class="col-sm-6">
									<input type="text" name="kd_aksesoris" class="form-control" value="<?= $r['kd_aksesoris'];?>" required>
								</div>
							</div>
							<div class="form-group">
								<label for="nm_aksesoris" class="col-sm-2 control-label">Nama Aksesoris</label>
								<div class="col-sm-6">
									<input type="text" name="nm_aksesoris" class="form-control" value="<?= $r['nm_aksesoris'];?>" required>
								</div>
							</div>
						</div>

						<div class="box-footer">
							<div class="form-group">
								<label class="col-sm-2 control-label"></label>
								<div class="col-sm-6">
									<button type="submit" class="btn btn-primary">Simpan</button>
									<a class="btn btn-danger" onclick="window.history.back()">Batal</a>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
</div>