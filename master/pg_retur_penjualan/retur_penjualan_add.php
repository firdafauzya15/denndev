<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data Retur Penjualan
    </h1>
    <ol class="breadcrumb">
      <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Retur Penjualan</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Tambah Retur Penjualan</h3>
          </div><!-- /.box-header -->
          <!-- form start -->
          <form action="home.php?act=<?php echo md5('retur_penjualan_insert')?>" method="post" class="form-horizontal">
            <div class="box-body">
              <div class="form-group">
                <label class="col-sm-2 control-label">Toko</label>
                <div class="col-sm-4">
                  <select class="form-control select2" name="id_toko" required id="id_toko">
                    <option value="">.:: Pilih Toko ::.</option>
                    <?php
                      $qr = "";
                      $q = mysqli_query($link,"SELECT * FROM toko WHERE tipe = 'OFFLINE' $qr Order By nm_toko ASC");
                      while ($r = mysqli_fetch_array($q)) {
                        if ($_SESSION['id_level'] == '2') {
                          echo "<option value='$r[id_toko]' selected>$r[nm_toko]</option>";
                        } else { 
                          echo "<option value='$r[id_toko]'>$r[nm_toko]</option>";
                        }
                      }
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Tanggal</label>
                <div class="col-sm-3">
                  <div class="input-group date">
                    <input type="text" name="tanggal" class="form-control pull-right" readonly="readonly" value="<?= date('Y-m-d');?>">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Customer</label>
                <div class="col-sm-4">
                  <select class="form-control select2" name="id_customer" required id="id_customer">
                    <option value="">.:: Pilih Customer ::.</option>
                    <?php
                      $q = mysqli_query($link,"SELECT * FROM customer ORDER BY nm_customer ASC");
                      while ($r = mysqli_fetch_array($q)) {
                        echo "<option value='$r[id_customer]'>$r[nm_customer]</option>";
                      }
                    ?>
                  </select>
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
                      <td width="10%">Lusin</td>
                      <td width="10%">Pcs</td>
                      <td width="20%">Harga</td>
                      <td width="20%">Tersedia</td>
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
  
  rObj_toko=document.getElementById("id_toko");
  id_toko=rObj_toko.value.trim();

  rObj.value="";rObj.focus(); iObj.value=newIndex;
  doRequested('viewResult'+index,'master/pg_retur_penjualan/readCell.php?id_toko='+id_toko+'&val='+valBarcode+'&index='+newIndex,false);
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
    source: availableAttributes
  }); 
    
});

// autocomplete enablement
</script>