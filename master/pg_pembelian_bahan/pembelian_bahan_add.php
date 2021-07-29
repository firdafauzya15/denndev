<div class="content-wrapper">
<?
 	$bc[] = array('title' => 'Pembelian Bahan', 'url' => 'home.php?act='.md5('pembelian_bahan'), 'active' => '0');
	$bc[] = array('title' => 'Pembelian Bahan Add', 'url' => '#', 'active' => '1');
	echo $lib->breadcrumbs("Data Pembelian Bahan",$bc);
?>

  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Tambah Pembelian Bahan</h3>
          </div>
          <form action="home.php?act=<?= md5('pembelian_bahan_insert')?>" method="post" class="form-horizontal">
            <div class="box-body">
              <div class="form-group">
                <label class="col-sm-2 control-label">Supplier Bahan</label>
                <div class="col-sm-4">
                  <select class="form-control select2" name="id_supplier_bahan" required>
                    <option value="">.:: Pilih Supplier Bahan ::.</option>
                    <?php
                      $q = mysqli_query($link,"SELECT * FROM supplier_bahan Order By nm_supplier_bahan ASC");
                      while ($r = mysqli_fetch_array($q)) {
                        echo "<option value='$r[id_supplier_bahan]'>$r[nm_supplier_bahan]</option>";
                      }
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Tanggal</label>
                <div class="col-sm-3">
                  <div class="input-group date">
                    <input type="text" name="tanggal" class="form-control pull-right" value="<?= date('Y-m-d');?>" id="datepicker">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Keterangan</label>
                <div class="col-sm-4">
                  <textarea name="keterangan" class="form-control"></textarea>
                </div>
              </div>
              <hr>
              <div class="form-group">
                <label class="col-sm-2 control-label">Daftar Bahan</label>
                <div class="col-sm-4">
                  <input type="text" class="form-control" id="readBarcode" name="readBarcode"  placeholder="Pencarian Bahan" onkeypress="onEnter(event)">
                </div>
                <div class="col-sm-2">
                  <input type="text" name="rowNumber" id="rowNumber" class="form-control" placeholder="Roll" value="1"  onkeypress="onEnter(event)">
                </div>
                <input type="text" id="indexCell" name="indexCell" value="0" style="display: none" />
              </div>  
              <div class="form-group">
                <label class="col-sm-2 control-label"></label>
                <div class="col-sm-10">
                  <table class="table table-bordered" style="margin-bottom: -3px;">
                    <tr>
                      <td width="20%">Kode</td>
                      <td width="20%">Nama</td>
                      <td width="20%">Jumlah</td>
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

  rObjRow=document.getElementById("rowNumber");
  valRow=rObjRow.value.trim();
  
  rObj.value="";rObj.focus(); iObj.value=newIndex;
  doRequested('viewResult'+index,'master/pg_pembelian_bahan/readCell.php?val='+valBarcode+'&valRow='+valRow+'&index='+newIndex,false);
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
          $qB = mysqli_query($link,"SELECT * FROM bahan_header Order By kd_bahan_header ASC");
          while($rB = mysqli_fetch_array($qB)){
            echo "'" . $rB['kd_bahan_header'] . " | " . $rB['nm_bahan_header'] . "',";
          }
          ?>
  ];
  
  $("input[name^='readBarcode']").autocomplete({
    source: availableAttributes
  }); 
    
});

// autocomplete enablement
</script>