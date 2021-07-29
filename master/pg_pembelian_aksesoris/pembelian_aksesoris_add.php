<div class="content-wrapper">
<?
 	$bc[] = array('title' => 'Pembelian Aksesoris', 'url' => 'home.php?act='.md5('pembelian_aksesoris'), 'active' => '0');
	$bc[] = array('title' => 'Pembelian Aksesoris Add', 'url' => '#', 'active' => '1');
	echo $lib->breadcrumbs("Data Pembelian Aksesoris",$bc);
?>
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Tambah Pembelian Aksesoris</h3>
          </div>
          <form action="home.php?act=<?= md5('pembelian_aksesoris_insert')?>" method="post" class="form-horizontal">
            <div class="box-body">
              <div class="form-group">
                <label class="col-sm-2 control-label">Supplier Aksesoris</label>
                <div class="col-sm-4">
                  <select class="form-control select2" name="id_supplier_aksesoris" required>
                    <option>.:: Pilih Supplier Aksesoris ::.</option>
                    <?php
                      $q = mysqli_query($link,"SELECT * FROM supplier_aksesoris Order By nm_supplier_aksesoris ASC");
                      while ($r = mysqli_fetch_array($q)) {
                        echo "<option value='$r[id_supplier_aksesoris]'>$r[nm_supplier_aksesoris]</option>";
                      }
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Tanggal</label>
                <div class="col-sm-3">
                  <div class="input-group date">
                    <input type="text" name="tanggal" class="form-control pull-right" id="datepicker" value="<?= date('Y-m-d');?>">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                  </div>
                </div>
              </div>
              <hr>
              <div class="form-group">
                <label class="col-sm-2 control-label">Daftar aksesoris</label>
                <div class="col-sm-4"><input type="text" class="form-control" id="readBarcode" name="readBarcode" onkeypress="onEnter(event)"></div>
                <div class="col-sm-2">
                  <input type="text" name="rowNumber" id="rowNumber" class="form-control" placeholder="Roll" value="1"  onkeypress="onEnter(event)">
                </div>  
                <input type="text" id="indexCell" name="indexCell" value="0" style="display:none" />
              </div>
                
              <div class="form-group">
                <label class="col-sm-2 control-label"></label>
                <div class="col-sm-10">
                  <table class="table table-bordered" style="margin-bottom: -3px;">
                    <tr>
                      <td width="20%">Kode</td>
                      <td width="20%">Nama</td>
                      <td width="20%">Jumlah</td>
                      <td width="20%">Satuan</td>
                      <td width="20%">Harga</td>
                      <td width="5%">Aksi</td>
                    </tr>              
                  </table>
                  <div id="viewResult0"> 
                  </div>
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


<script language="javascript" src="js/utilities.js"></script> 
<script language="javascript">
function onEnter(e){
  var key=e.keyCode || e.which;
  if(key==13){
    showCell();
  }
}

function showCell(){
  iObj=document.getElementById("indexCell");
  index=iObj.value.trim();
  newIndex=eval(index)+1;
  
  rObj=document.getElementById("readBarcode");
  valBarcode=rObj.value.trim();

  rObj.value="";rObj.focus(); iObj.value=newIndex;
  doRequested('viewResult'+index,'master/pg_pembelian_aksesoris/readCell.php?val='+valBarcode+'&index='+newIndex,false);
}


</script>

<script type="text/javascript"> 

function stopRKey(evt) { 
  var evt = (evt) ? evt : ((event) ? event : null); 
  var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null); 
  if ((evt.keyCode == 13) && (node.type=="text"))  {return false;} 
} 

document.onkeypress = stopRKey; 
</script>

<script>
function remove(a){
  row = "#tabtest"+a+"";
  $(row).remove();
  //alert(row);
  }
</script>


 <script>
 $(document).ready(function() {
    
  var availableAttributes = [
          <?php
          $qB = mysqli_query($link,"SELECT kd_aksesoris, nm_aksesoris FROM aksesoris Order By kd_aksesoris ASC");
          while($rB = mysqli_fetch_array($qB)){
            echo "'" . $rB['kd_aksesoris'] . " | " . $rB['nm_aksesoris'] . "',";
          }
          ?>
  ];
  
  $("input[name^='readBarcode']").autocomplete({
    source: availableAttributes
  }); 
    
});

// autocomplete enablement
</script>