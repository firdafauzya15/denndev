<?php
	$id_produk = base64_decode($_GET['id_produk']);
	$q = mysqli_query($link,"SELECT * FROM produk WHERE id_produk = '$id_produk'");
	$r = mysqli_fetch_array($q);

	$tipe = "<span class='label label-warning'>Barang Produksi</span>";
	if ($r['id_tipe_produk'] == '2') {
		$tipe = "<span class='label label-success'>Barang Jadi</span>";
	}
?>
<div class="content-wrapper">
<?
 	$bc[] = array('title' => 'Produk', 'url' => 'home.php?act='.md5('produk'), 'active' => '0');
	$bc[] = array('title' => 'Produk Edit', 'url' => '#', 'active' => '1');
	echo $lib->breadcrumbs("Data Produk",$bc);
?>
  	<section class="content">
    	<div class="row">
      	<div class="col-md-12">
        		<div class="box box-info">
         		 <div class="box-header with-border"><h3 class="box-title">Ubah Produk</h3></div>
          		<form action="home.php?act=<?= md5('produk_update')?>" method="post" class="form-horizontal" enctype="multipart/form-data">
            		<input type="hidden" name="id_produk" value="<?= $id_produk;?>">
            		<input type="hidden" name="kd_produk_lama" value="<?= $r['kd_produk'];?>">
            		<input type="hidden" name="id_pola" value="<?= $r['id_pola'];?>">
            		<input type="hidden" name="file_lama" value="<?= $r['file'];?>">
           		 	<div class="box-body">
              			<?php
              				$disabled = "";
								if ($_SESSION['id_level'] == 9 OR $_SESSION['id_level'] == 11) {
									$disabled = "disabled='disabled'";
								}
              			?>
              			<div class="form-group">
                			<label class="col-sm-2 control-label">Tipe</label>
   							<div class="col-sm-6"><?= $tipe;?></div>
              			</div>
              			<div class="form-group">
                			<label class="col-sm-2 control-label">Brand</label>
                			<div class="col-sm-6">
                  			<select class="form-control select2" name="id_brand" required <?= $disabled;?>>
                    				<option>.:: Pilih Brand ::.</option>
                    				<?php
                      				$qE = mysqli_query($link,"SELECT * FROM brand Order By nm_brand ASC");
                      				while ($rE = mysqli_fetch_array($qE)) {
                        				if ($r['id_brand'] == $rE['id_brand']) {
                          					echo "<option value='$rE[id_brand]' selected>$rE[nm_brand]</option>";
                       				 	} else {
                          					echo "<option value='$rE[id_brand]'>$rE[nm_brand]</option>";
                       					}
                     				}
                    				?>
                  			</select>
                			</div>
              			</div>
              			<div class="form-group">
                			<label class="col-sm-2 control-label">Pola</label>
                			<div class="col-sm-6">
                  			<select class="form-control select2" disabled="disabled">
                   			 	<option>.:: Pilih Pola ::.</option>
                    				<?php
											$qE = mysqli_query($link,"SELECT * FROM pola Order By nm_pola ASC");
											while ($rE = mysqli_fetch_array($qE)) {
												if ($r['id_pola'] == $rE['id_pola']) {
												echo "<option value='$rE[id_pola]' selected>$rE[kd_pola] - $rE[nm_pola]</option>";
												} else {
												echo "<option value='$rE[id_pola]'>$rE[kd_pola] - $rE[nm_pola]</option>";
												}
											}
										?>
                 	 			</select>
               	 		</div>
              			</div>
						  <div class="form-group">
                        <label class="col-sm-2 control-label">Model</label>
                        <div class="col-sm-6">
                           <select class="form-control select2" name="id_model" required>
                              <option>.:: Pilih Model ::.</option>
                              <?php
                                 $q = mysqli_query($link,"SELECT * FROM model Order By nm_model ASC");
                                 while ($r = mysqli_fetch_array($q)) {
                                    echo "<option value='$r[id_model]'>$r[nm_model]</option>";
                                 }
                              ?>
                           </select>
                        </div>
                     </div>
              			<div class="form-group">
                			<label for="inputEmail3" class="col-sm-2 control-label">Kode produk</label>
                			<div class="col-sm-6">
                  			<input type="text" name="kd_produk" class="form-control" id="inputEmail3" value="<?= $r['kd_produk'];?>" required readonly="readonly">
               	 		</div>
              			</div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Nama Produk</label>
                <div class="col-sm-6">
                  <input type="text" name="nm_produk" class="form-control" id="inputEmail3" value="<?= $r['nm_produk'];?>" required <?= $disabled;?>>
                </div>
              </div>
              <?php
              if ($r['id_tipe_produk'] == '2') {
              ?>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Harga Modal</label>
                  <div class="col-sm-3">
                    <input type="number" name="harga_modal" class="form-control" id="inputEmail3" value="<?= $r['harga_modal'];?>" required <?= $disabled;?>>
                  </div>
                </div>
              <?php
              }
              ?>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Foto</label>
                <div class="col-sm-6">
                  <img src="upload/<?= $r['file'];?>" height="100" width="100">
                  <hr>
                  <input type="file" name="file" id="inputEmail3">
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Detail</label>
                <div class="col-sm-6">
                  <table class="table">
                    <tr>
                      <th>Kode</th>
                      <th>Harga Jual</th>
                    </tr>
                    <?php
                    $produkSizes = mysqli_query($link,"SELECT * FROM produk_size WHERE kd_produk = '$r[kd_produk]'") or die (mysqli_error());
                    while ($produkSize = mysqli_fetch_array($produkSizes)) {
                      $size = mysqli_fetch_array(mysqli_query($link,"SELECT * FROM size WHERE id_size = '$produkSize[id_size]'"));
                      echo "<tr>";
                      echo "<td>$produkSize[kd_produk_size]</td>";
                      echo "<td>";
                      echo "<input type='hidden' name='id_produk_size[]' value='$produkSize[id_produk_size]' class='form-control'  $disabled>";
                      echo "<input type='number' name='harga_jual[]' value='$produkSize[harga_jual]' class='form-control' $disabled>";
                      echo "</td>";
                      echo "</tr>";
                    }
                    ?>
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