<div class="content-wrapper">
<?
 	$bc[] = array('title' => 'Model', 'url' => 'home.php?act='.md5('model'), 'active' => '0');
	$bc[] = array('title' => 'Model Add', 'url' => '#', 'active' => '1');
	echo $lib->breadcrumbs("Data Model",$bc);
?>
  	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-info">
					<div class="box-header with-border">
						<h3 class="box-title">Tambah Model</h3> </div>
						<form action="home.php?act=<?= md5('model_insert')?>" method="post" class="form-horizontal">
							<div class="box-body">
								<div class="form-group">
									<label for="nm_model" class="col-sm-2 control-label">Nama Model</label>
									<div class="col-sm-6"><input type="text" name="nm_model" class="form-control" required></div>
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