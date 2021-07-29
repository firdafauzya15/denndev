<div class="content-wrapper">
<?
 	$bc[] = array('title' => 'Brand', 'url' => 'home.php?act='.md5('brand'), 'active' => '0');
	$bc[] = array('title' => 'Brand Add', 'url' => '#', 'active' => '1');
	echo $lib->breadcrumbs("Data Brand",$bc);
?>
  	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-info">
					<div class="box-header with-border">
						<h3 class="box-title">Tambah Brand</h3> </div>
						<form action="home.php?act=<?= md5('brand_insert')?>" method="post" class="form-horizontal">
							<div class="box-body">
								<div class="form-group">
									<label for="nm_brand" class="col-sm-2 control-label">Nama Brand</label>
									<div class="col-sm-6"><input type="text" name="nm_brand" class="form-control"required></div>
								</div>
								<div class="form-group">
                				<label class="col-sm-2 control-label">Gudang</label>
									<div class="col-sm-4">
										<select class="form-control select2" name="gudang" required>
											<option>.:: Pilih Gudang ::.</option>
											<?php
												$q = mysqli_query($link,"SELECT * FROM gudang Order By nm_gudang ASC");
												while ($r = mysqli_fetch_array($q)) {
													echo "<option value='$r[id_gudang]'>$r[nm_gudang]</option>";
												}
											?>
										</select>
									</div>
								</div>
							</div>
							<div class="box-footer">
								<div class="form-group">
									<div class="col-sm-2"></div>
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