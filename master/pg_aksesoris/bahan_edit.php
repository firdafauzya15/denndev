<?php
  $id_bahan_header = base64_decode($_GET['id_bahan_header']);
  $q = mysqli_query($link,"SELECT * FROM bahan_header WHERE id_bahan_header = '$id_bahan_header'");
  $r = mysqli_fetch_array($q);
?>
<div class="content-wrapper">
<?
 	$bc[] = array('title' => 'Bahan', 'url' => 'home.php?act='.md5('bahan'), 'active' => '0');
	$bc[] = array('title' => 'Bahan Edit', 'url' => '#', 'active' => '1');
	echo $lib->breadcrumbs("Data Bahan",$bc);
?>
  	<section class="content">
    	<div class="row">
      	<div class="col-md-12">
        		<div class="box box-info">
          		<div class="box-header with-border"><h3 class="box-title">Ubah Bahan</h3></div>
          		<form action="home.php?act=<?= md5('bahan_update')?>" method="post" class="form-horizontal">
            		<input type="hidden" name="id_bahan_header" value="<?= $id_bahan_header;?>">
            		<div class="box-body">
              			<div class="form-group">
               	 		<label for="kd_bahan_header" class="col-sm-2 control-label">Kode Bahan</label>
                			<div class="col-sm-6">
                  			<input type="text" name="kd_bahan_header" class="form-control" readonly="readonly" value="<?= $r['kd_bahan_header'];?>" required>
                			</div>
              			</div>
              			<div class="form-group">
                			<label for="nm_bahan_header" class="col-sm-2 control-label">Nama Bahan</label>
								<div class="col-sm-6">
									<input type="text" name="nm_bahan_header" class="form-control" value="<?= $r['nm_bahan_header'];?>" required>
								</div>
              			</div>
              			<div class="form-group">
                			<label class="col-sm-2 control-label">Satuan</label>
                			<div class="col-sm-2">
                  			<select class="form-control select2" name="id_satuan_bahan" required>
                    				<option value="">.:: Pilih Satuan ::.</option>
                    				<?php
                      				$qE = mysqli_query($link,"SELECT * FROM _satuan_bahan Order By id_satuan_bahan ASC");
                      				while ($rE = mysqli_fetch_array($qE)) {
										if ($r['id_satuan_bahan'] == $rE['id_satuan_bahan']) {
											echo "<option value='$rE[id_satuan_bahan]' selected>$rE[nm_satuan_bahan]</option>";
										} else {
											echo "<option value='$rE[id_satuan_bahan]'>$rE[nm_satuan_bahan]</option>";
										}
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
                        			<?php
                        				$i =  0;
                        				$bahans = mysqli_query($link,"SELECT * FROM bahan WHERE id_bahan_header = '$id_bahan_header'");
                        				while ($bahan = mysqli_fetch_array($bahans)) { 
                          					$i++;
                          					$id_bahan = base64_encode($bahan['id_bahan']);
                        			?>
                          				<tr>
													<td><?= $i;?></td>
													<td><a href="?act=<?php echo md5('bahan_delete_item')."&id_bahan=$id_bahan&id_bahan_header=$_GET[id_bahan_header]"?>" onclick="return confirm('Apakah anda yakin ?')" class="btn btn-danger"><i class="fa fa-minus-circle"></i></a></td>
													<td>
														<?= $bahan['kd_bahan'];?>
														<input type="hidden" name="kd_bahan[]" value="<?= $bahan['kd_bahan'];?>" class="form-control" required>
													</td>
													<td>
														<?= $bahan['nm_bahan'];?>
														<input type="hidden" name="nm_bahan[]" value="<?= $bahan['nm_bahan'];?>" class="form-control" required>
													</td>
                          				</tr>
                        			<?php } ?>
                      			</tbody>
                   	 		</table>
                  		</div>
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