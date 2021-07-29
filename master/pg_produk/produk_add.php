<div class="content-wrapper">
<?
 	$bc[] = array('title' => 'Produk', 'url' => 'home.php?act='.md5('produk'), 'active' => '0');
	$bc[] = array('title' => 'Produk Add', 'url' => '#', 'active' => '1');
	echo $lib->breadcrumbs("Data Produk",$bc);
?>

   <section class="content">
      <div class="row">
         <div class="col-md-12">
            <div class="box box-info">
               <div class="box-header with-border"><h3 class="box-title">Tambah Produk</h3></div>
               <form action="#" method="get" class="form-horizontal" enctype="multipart/form-data">
                  <input type="hidden" name="act" value="57bc0af2fc65ac4144df548493f49056">
                  <div class="box-body">
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Tipe</label>
                        <div class="col-sm-6">
                           <select class="form-control select2" name="id_tipe_produk" required onchange="submit()">
                              <option>.:: Pilih Tipe ::.</option>
                              <?php
                                 $q = mysqli_query($link,"SELECT * FROM _tipe_produk Order By id_tipe_produk ASC");
                                 while ($r = mysqli_fetch_array($q)) {
                                    echo "<option value='$r[id_tipe_produk]' ".(($_GET['id_tipe_produk'] == $r['id_tipe_produk'])?"selected":"").">$r[nm_tipe_produk]</option>";
                                 }
                              ?>
                           </select>
                        </div>
                     </div>
                  </div><hr>
               </form>
               <?php
                  if (isset($_GET['id_tipe_produk'])) {
               ?>
               <form action="home.php?act=<?= md5('produk_insert')?>" method="post" class="form-horizontal" enctype="multipart/form-data">
                  <input type="hidden" name="id_tipe_produk" value="<?= $_GET['id_tipe_produk'];?>">
                  <div class="box-body">
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Brand</label>
                        <div class="col-sm-6">
                           <select class="form-control select2" name="id_brand" required>
                              <option>.:: Pilih Brand ::.</option>
                              <?php
                                 $q = mysqli_query($link,"SELECT * FROM brand Order By nm_brand ASC");
                                 while ($r = mysqli_fetch_array($q)) {
                                    echo "<option value='$r[id_brand]'>$r[nm_brand]</option>";
                                 }
                              ?>
                           </select>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Pola</label>
                        <div class="col-sm-6">
                           <select class="form-control select2" name="id_pola" required>
                              <option>.:: Pilih Pola ::.</option>
                              <?php
                                 $q = mysqli_query($link,"SELECT * FROM pola Order By nm_pola ASC");
                                 while ($r = mysqli_fetch_array($q)) {
                                    echo "<option value='$r[id_pola]'>$r[kd_pola] - $r[nm_pola]</option>";
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
                        <label for="kd_produk" class="col-sm-2 control-label">Kode Produk</label>
                        <div class="col-sm-6">
                           <input type="text" name="kd_produk" class="form-control" required>
                        </div>
                     </div>
                     <div class="form-group">
                        <label for="nm_produk" class="col-sm-2 control-label">Nama Produk</label>
                        <div class="col-sm-6">
                           <input type="text" name="nm_produk" class="form-control" required>
                        </div>
                     </div>
                     <?php
                        if ($_GET['id_tipe_produk'] == '2') {
                     ?>
                     <div class="form-group">
                        <label for="harga_modal" class="col-sm-2 control-label">Harga Modal</label>
                        <div class="col-sm-3">
                           <input type="number" name="harga_modal" class="form-control" required>
                        </div>
                     </div>
                     
                     <?php } ?>   
                     
                     <div class="form-group">
                        <label for="harga_jual" class="col-sm-2 control-label">Harga Jual</label>
                        <div class="col-sm-3">
                           <input type="number" name="harga_jual" class="form-control" value="0" required>
                        </div>
                     </div>

                     <div class="form-group">
                        <label for="file" class="col-sm-2 control-label">Foto</label>
                        <div class="col-sm-6">
                           <input type="file" name="file">
                        </div>
                     </div>
                  </div>

                  <div class="box-footer">
                     <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label"></label>
                        <div class="col-sm-6">
                           <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                     </div>
                  </div>
               </form>
               <?php } ?>
            </div>
         </div>
      </div>
   </section>
</div>