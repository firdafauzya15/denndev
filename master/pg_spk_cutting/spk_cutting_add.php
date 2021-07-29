<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data SPK Cutting
    </h1>
    <ol class="breadcrumb">
      <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">SPK Cutting</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Tambah SPK Cutting</h3>
          </div><!-- /.box-header -->
          <!-- form start -->
          <form action="home.php?act=<?php echo md5('spk_cutting_insert')?>" method="post" class="form-horizontal">
            <div class="box-body">
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Tanggal</label>
                <div class="col-sm-3">
                  <div class="input-group date">
                    <input type="text" name="tanggal" class="form-control pull-right"  id="datepicker" value="<?= date('Y-m-d');?>">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Tukang Potong</label>
                <div class="col-sm-4">
                  <select class="form-control select2" name="id_potong" required >
                    <?php
                      $q = mysqli_query($link,"SELECT * FROM potong ORDER BY nm_potong ASC");
                      while ($r = mysqli_fetch_array($q)) {
                        echo "<option value='$r[id_potong]'>$r[nm_potong]</option>";
                      }
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Detail Seri</label>
                <div class="col-sm-4">
                  <input type="text" name="suffix" class="form-control" id="inputEmail3" required>
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Harga</label>
                <div class="col-sm-2">
                  <input type="number" name="harga" class="form-control" id="inputEmail3" value ='0'required>
                </div>
              </div>
              <hr>
              <div class="form-group">
                <label class="col-sm-2 control-label">Daftar Bahan</label>
                <div class="col-sm-4">
                  <input type="text" class="form-control" id="readBarcode" name="readBarcode"  placeholder="Pencarian Bahan" onkeypress="onEnter(event,'bahanInput')">
                </div>
                <div class="col-sm-2">
                  <input type="text" name="rowNumber" id="rowNumber" class="form-control" placeholder="Roll"  onkeypress="onEnter(event,'bahanInput')">
                </div>
                <input type="text" id="indexCell" name="indexCell" value="0" style="display: none" />
              </div><!-- /.form-group -->
              <div class="form-group">
                <label class="col-sm-2 control-label"></label>
                <div class="col-sm-10">
                  <table class="table table-bordered" style="margin-bottom: -3px;">
                    <tr>
                      <td width="20%">Kode</td>
                      <td width="20%">Nama</td>
                      <td width="20%">Stok</td>
                      <td width="20%">Jumlah</td>
                      <td width="5%">Aksi</td>
                    </tr>                  
                  </table>
                  <div id="viewResult0">
                  </div>
                </div>
              </div><!-- /.form-group -->
              <hr>
              <div class="form-group">
                <label class="col-sm-2 control-label">Daftar Pola</label>
                <div class="col-sm-4"><input type="text" class="form-control" id="readPola" name="readPola" onkeypress="onEnter(event,'polaInput')" placeholder="Cari Pola"></div>
                <input type="text" id="indexCellPola" name="indexCellPola" value="0" style="display:none" />
              </div><!-- /.form-group -->
              <div class="form-group">
                <label class="col-sm-2 control-label"></label>
                <div class="col-sm-10">
                  <table class="table table-bordered" style="margin-bottom: -3px;">
                    <tr>
                      <td width="20%">Kode</td>
                      <td width="20%">Nama</td>
                      <td width="5%">Aksi</td>
                    </tr>                  
                  </table>
                  <div id="viewResultPola0">
                  </div>
                </div>
              </div><!-- /.form-group -->
            </div><!-- /.box-body -->

            <div class="box-footer">
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label"></label>
                <div class="col-sm-6">
                  <button type="submit" class="btn btn-primary" onclick="return confirm('Apakah anda yakin ?')">Simpan</button>
                  <a class="btn btn-danger" onclick="window.history.back()">Batal</a>
                </div>
              </div>
            </div><!-- /.box-footer -->
          </form>
        </div><!-- /.box -->
      </div>
    </div><!-- /.row -->

  </section><!-- /.content -->
</div><!-- /.content-wrapper -->


<script language="javascript" src="js/utilities.js"></script> 
<script language="javascript">
function onEnter(e, act){
  var key=e.keyCode || e.which;
  if(key==13){
    if (act == 'bahanInput') {
      showCell();
    } else {
      showCellPola();
    }
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
  doRequested('viewResult'+index,'master/pg_spk_cutting/readCell.php?val='+valBarcode+'&valRow='+valRow+'&index='+newIndex,false);
}

function showCellPola(){
  iObj=document.getElementById("indexCellPola");
  index=iObj.value.trim();
  newIndex=eval(index)+1;
  
  rObj=document.getElementById("readPola");
  valBarcode=rObj.value.trim();

  rObj.value="";rObj.focus(); iObj.value=newIndex;
  doRequested('viewResultPola'+index,'master/pg_spk_cutting/readCellPola.php?val='+valBarcode+'&index='+newIndex,false);
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
function removePola(a){
  row = "#tabpola"+a+"";
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
    
  var availableAttributesPola = [
          <?php
          $qB = mysqli_query($link,"SELECT kd_pola, nm_pola FROM pola Order By kd_pola ASC");
          while($rB = mysqli_fetch_array($qB)){
            echo "'" . $rB['kd_pola'] . " | " . $rB['nm_pola'] . "',";
          }
          ?>
  ];
  
  $("input[name^='readBarcode']").autocomplete({
    source: availableAttributes
  }); 
  
  $("input[name^='readPola']").autocomplete({
    source: availableAttributesPola
  }); 
    
});

// autocomplete enablement
</script>