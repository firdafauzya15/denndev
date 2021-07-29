<div class="content-wrapper">
<?
 	$bc[] = array('title' => 'Gudang', 'url' => 'home.php?act='.md5('gudang'), 'active' => '0');
	$bc[] = array('title' => 'Gudang Add', 'url' => '#', 'active' => '1');
	echo $lib->breadcrumbs("Data Gudang",$bc);
?>
  	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-info">
					<div class="box-header with-border">
						<h3 class="box-title">Tambah Gudang</h3> </div>
						<form action="home.php?act=<?= md5('gudang_insert')?>" method="post" class="form-horizontal">
							<div class="box-body">
								<div class="form-group">
									<label for="inputEmail3" class="col-sm-2 control-label">Nama Gudang</label>
									<div class="col-sm-6"><input type="text" name="nm_gudang" class="form-control" required></div>
								</div>
							</div>
							<div class="box-footer">
								<div class="form-group">
									<label for="inputEmail3" class="col-sm-2 control-label"></label>
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