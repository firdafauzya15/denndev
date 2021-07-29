<div class="content-wrapper">
<?
 	$bc[] = array('title' => 'Sablon', 'url' => 'home.php?act='.md5('sablon'), 'active' => '0');
	$bc[] = array('title' => 'Sablon Add', 'url' => '#', 'active' => '1');
	echo $lib->breadcrumbs("Data Sablon",$bc);
?>
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Tambah Sablon / Bordir</h3>
          </div>
          <form action="#" method="get" class="form-horizontal">                                                                                                               
            <input type="hidden" name="act" value="<?= md5('sablon_add');?>">
            <div class="box-body">
              <div class="form-group">
                <label class="col-sm-2 control-label">Nota SPK Cutting</label>
                <div class="col-sm-3">
                  <select class="form-control select2" name="nota_spk" id="nota_spk" required onchange="submit()">
                    <option value="">.:: Pilih Nota ::.</option>
                    <?php
                      $q = mysqli_query($link,"SELECT nota, qty FROM spk_cutting ORDER BY id_spk_cutting ASC");
                      // $q = mysqli_query($link,"SELECT nota, qty FROM spk_cutting where nota not in(select nota_spk from sablon) ORDER BY id_spk_cutting ASC");
                      while ($r = mysqli_fetch_assoc($q)) {
                        $selected = ($r['nota'] == $_GET['nota_spk']) ? 'selected' : '';
                        echo '<option value="' . $r['nota'] . '" ' . $selected . '>' . $r['nota'] . '</option>';
                      }
                    ?>
                  </select>
                </div>
              </div>
            </div>
          </form>
          <?php
          if (isset($_GET['nota_spk'])) {
          ?>
            <form action="home.php?act=<?php echo md5('sablon_add_next')?>" method="post" class="form-horizontal">
              <input type="hidden" name="nota_spk" value="<?= $_GET['nota_spk'];?>">
              <div class="box-body">
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
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Jatuh Tempo</label>
                  <div class="col-sm-3">
                    <div class="input-group date">
                      <input type="text" name="jatuh_tempo" class="form-control pull-right" id="datepicker2" value="<?= date('Y-m-d');?>">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                    </div>
                  </div>
                </div>          
                <div class="form-group">
                  <label class="col-sm-2 control-label">Nota</label>
                  <div class="col-sm-3">
                    <input type="text" name="nota" class="form-control" id="inputEmail3" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Vendor</label>
                  <div class="col-sm-3">
                    <select class="form-control select2" name="vendor" required>
                      <option value="">.:: Pilih Vendor ::.</option>
                      <?php
                        $q = mysqli_query($link,"SELECT * FROM vendor ORDER BY nm_vendor ASC");
                        while ($r = mysqli_fetch_assoc($q)) {
                          echo "<option value='$r[id_vendor]|$r[nm_vendor]'>$r[nm_vendor]</option>";
                        }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Harga Vendor</label>
                  <div class="col-sm-2">
                    <input type="number" name="harga" class="form-control" id="inputEmail3" required>
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
                        <td width="20%">Model</td>
                        <td width="20%">Nama</td>
                        <td width="20%">Keterangan</td>
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
                    <button type="submit" class="btn btn-primary" onclick="return confirm('Apakah anda yakin ?')">Lanjut</button>
                    <a class="btn btn-danger" onclick="window.history.back()">Batal</a>
                  </div>
                </div>
              </div><!-- /.box-footer -->
            </form>
          <?php
          }
          ?>
        </div><!-- /.box -->
      </div>
    </div><!-- /.row -->
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->


<script language="javascript" src="js/utilities.js"></script> 
<script language="javascript">
function onEnter(e) {
  var key=e.keyCode || e.which;
  if(key==13){
    showCell();
  }
}

function showCell() {
  iObj=document.getElementById("indexCell");
  index=iObj.value.trim();
  newIndex=eval(index)+1;
  
  rObj=document.getElementById("readBarcode");
  valBarcode=rObj.value.trim();

  rSpk=document.getElementById("nota_spk");
  valSpk=rSpk.value.trim();

  rObj.value="";rObj.focus(); iObj.value=newIndex;
  doRequested('viewResult'+index,'master/pg_sablon/readCell.php?val='+valBarcode+'&valSpk='+valSpk+'&index='+newIndex,false);
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
          $result = mysqli_query($link,"SELECT 
            produk.kd_produk,
            produk.nm_produk
            FROM 
            spk_cutting_pengiriman 
            INNER JOIN produk ON produk.kd_produk = spk_cutting_pengiriman.kd_produk
            WHERE 
            spk_cutting_pengiriman.nota = '$_GET[nota_spk]'
            GROUP BY spk_cutting_pengiriman.kd_produk
            ORDER BY spk_cutting_pengiriman.kd_produk ASC
            ");
          while ($row = mysqli_fetch_assoc($result)) {
            echo "'" . $row['kd_produk'] . " | " . $row['nm_produk'] . "',";
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