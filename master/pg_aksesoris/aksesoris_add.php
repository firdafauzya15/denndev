<div class="content-wrapper">
<?
 	$bc[] = array('title' => 'Aksesoris', 'url' => 'home.php?act='.md5('aksesoris'), 'active' => '0');
	$bc[] = array('title' => 'Aksesoris Add', 'url' => '#', 'active' => '1');
	echo $lib->breadcrumbs("Data Aksesoris",$bc);
?>

  	<section class="content">
    	<div class="row">
      	<div class="col-md-12">
       	 	<div class="box box-info">
          		<div class="box-header with-border"><h3 class="box-title">Tambah Aksesoris</h3></div>
          		<form action="home.php?act=<?= md5('aksesoris_insert')?>" method="post" class="form-horizontal">
            		<div class="box-body">
              			<div class="form-group">
                			<label for="kd_aksesoris_header" class="col-sm-2 control-label">Kode Aksesoris</label>
                			<div class="col-sm-6"><input type="text" name="kd_aksesoris_header" class="form-control" required></div>
              			</div>
              			<div class="form-group">
                			<label for="nm_aksesoris_header" class="col-sm-2 control-label">Nama Aksesoris</label>
                			<div class="col-sm-6"><input type="text" name="nm_aksesoris_header" class="form-control" required></div>
              			</div>
        
              			<div class="form-group">
                			<label class="col-sm-2 control-label">Detail</label>
                			<div class="col-sm-6">
                  			<div class="table-responsive">
                    			<table class="table table-hover test">
										<thead>
											<tr>
												<th width="1">No</th>
												<th width="1"><a class="add_field_button btn btn-success"><i class="fa fa-plus-circle"></i></a></th>
												<th style="text-align: center;">Kode</th>
												<th style="text-align: center;">Nama</th>
											</tr>
										</thead>
										<tbody class="input_fields_wrap">
											<tr>
												<td>1</td>
												<td></td>
												<td><input type="text" name="kd_aksesoris[]" class="form-control" required></td>
												<td><input type="text" name="nm_aksesoris[]" class="form-control" required></td>
											</tr>
										</tbody>
                    			</table>
                  		</div>
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

<script>
  $(".add_field_button").click(function(){
     var id = $(".test tr").length;
      $(".test").append("<tr id='tr"+id+"'>"+
        "<td align='left' valign='middle'>"+id+"</td>"+
        "<td><a class='remove_field btn btn-danger'><i class='fa fa-minus-circle'></i></a></td>"+
        "<td><input type='text' name='kd_aksesoris[]' class='form-control' required></td>"+
        "<td><input type='text' name='nm_aksesoris[]' class='form-control' required></td>"+
        "</tr>");
  });

  $('body').on('focus',".js-example-basic-single", function(){
      $(this).select2();
  });
  
  $(".test").on('click','.remove_field',function(){
        $(this).parent().parent().remove();
  });
</script>