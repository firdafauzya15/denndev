<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data Surat Jalan antar Toko
    </h1>
    <ol class="breadcrumb">
      <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Surat Jalan antar Toko</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Tambah Surat Jalan antar Toko</h3>
          </div><!-- /.box-header -->
          <!-- form start -->
          <form action="home.php?act=<?php echo md5('surat_jalan_toko_insert')?>" method="post" class="form-horizontal">
            <div class="box-body">
              <div class="form-group">
                <label class="col-sm-2 control-label">Toko Awal</label>
                <div class="col-sm-4">
                  <select class="form-control select2" name="id_toko" required>
                    <option value="">.:: Pilih Toko ::.</option>
                    <?php
                      $q = mysqli_query($link,"SELECT * FROM toko Order By nm_toko ASC");
                      while ($r = mysqli_fetch_array($q)) {
                        echo "<option value='$r[id_toko]'>$r[nm_toko]</option>";
                      }
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Toko Tujuan</label>
                <div class="col-sm-4">
                  <select class="form-control select2" name="id_toko_tujuan" required>
                    <option value="">.:: Pilih Toko ::.</option>
                    <?php
                      $q = mysqli_query($link,"SELECT * FROM toko Order By nm_toko ASC");
                      while ($r = mysqli_fetch_array($q)) {
                        echo "<option value='$r[id_toko]'>$r[nm_toko]</option>";
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
              <hr>
              <div class="form-group">
                <label class="col-sm-2 control-label">Daftar Produk</label>
                <div class="col-sm-4"><input type="text" class="form-control" id="readBarcode" name="readBarcode" onkeypress="onEnter(event)"></div>
                <input type="text" id="indexCell" name="indexCell" value="0" style="display:none" />
              </div><!-- /.form-group -->
              <div class="form-group">
                <label class="col-sm-2 control-label"></label>
                <div class="col-sm-10">
                  <table class="table table-bordered" style="margin-bottom: -3px;">
                    <tr>
                      <td width="20%">Kode</td>
                      <td width="20%">Nama</td>
                      <td width="20%">Lusin</td>
                      <td width="20%">Pcs</td>
                      <td width="5%">Aksi</td>
                    </tr>                  
                  </table>
                  <div id="viewResult0">
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
  doRequested('viewResult'+index,'master/pg_surat_jalan_toko/readCell.php?val='+valBarcode+'&index='+newIndex,false);
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
          $qB = mysqli_query($link,"SELECT
                kd_produk_size, 
                nm_produk 
                FROM 
                produk_size 
                Inner Join produk ON produk.kd_produk = produk_size.kd_produk 
                Order By kd_produk_size ASC
                ");
          while($rB = mysqli_fetch_array($qB)){
            echo "'" . $rB['kd_produk_size'] . " | " . $rB['nm_produk'] . "',";
          }
          ?>
  ];
  
  $("input[name^='readBarcode']").autocomplete({
    source: function(request, response) {
      var results = $.ui.autocomplete.filter(availableAttributes, request.term);
      response(results.slice(0, 10));
    }
  }); 
    
});

// autocomplete enablement
</script>