<div class="content-wrapper">
<?
 	$bc[] = array('title' => 'Bahan', 'url' => 'home.php?act='.md5('bahan'), 'active' => '0');
	$bc[] = array('title' => 'Bahan Add', 'url' => '#', 'active' => '1');
	echo $lib->breadcrumbs("Data Bahan",$bc);
?>

  	<section class="content">
    	<div class="row">
      	<div class="col-md-12">
       	 	<div class="box box-info">
          		<div class="box-header with-border"><h3 class="box-title">Tambah Bahan</h3></div>
          		<form action="home.php?act=<?= md5('bahan_insert')?>" method="post" class="form-horizontal">
            		<div class="box-body">
              			<div class="form-group">
                			<label for="kd_bahan_header" class="col-sm-2 control-label">Kode Bahan</label>
                			<div class="col-sm-6"><input type="text" name="kd_bahan_header" class="form-control" required></div>
              			</div>
              			<div class="form-group">
                			<label for="nm_bahan_header" class="col-sm-2 control-label">Nama Bahan</label>
                			<div class="col-sm-6"><input type="text" name="nm_bahan_header" class="form-control" required></div>
              			</div>
              			<div class="form-group">
                			<label class="col-sm-2 control-label">Satuan</label>
                			<div class="col-sm-2">
                  			<select class="form-control select2" name="id_satuan_bahan" required>
                    				<option value="">.:: Pilih Satuan ::.</option>
                    				<?php
                      				$q = mysqli_query($link,"SELECT * FROM _satuan_bahan Order By id_satuan_bahan ASC");
                      				while ($r = mysqli_fetch_array($q)) {
                          				echo "<option value='$r[id_satuan_bahan]'>$r[nm_satuan_bahan]</option>";
                      				}
                    				?>
                  			</select>
                			</div>
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
												<td><input type="text" name="kd_bahan[]" class="form-control" required></td>
												<td><input type="text" name="nm_bahan[]" class="form-control" required></td>
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
									<button type="submit" class="btn btn-primary" onclick="return confirm('Apakah anda yakin ?')">Simpan</button>
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
        "<td><input type='text' name='kd_bahan[]' class='form-control' id='inputEmail3' required></td>"+
        "<td><input type='text' name='nm_bahan[]' class='form-control' id='inputEmail3' required></td>"+
        "</tr>");
  });

  $('body').on('focus',".js-example-basic-single", function(){
      $(this).select2();
  });
  
  $(".test").on('click','.remove_field',function(){
        $(this).parent().parent().remove();
  });
</script>