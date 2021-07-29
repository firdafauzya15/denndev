<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data QC SPK Cutting
    </h1>
    <ol class="breadcrumb">
      <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">qc SPK Cutting</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Tambah QC SPK Cutting</h3>
          </div><!-- /.box-header -->
          <!-- form start -->
          <form action="home.php?act=<?php echo md5('qc_cutting_insert')?>" method="post" class="form-horizontal" enctype="multipart/form-data">
            <div class="box-body">
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Tanggal</label>
                <div class="col-sm-3">
                  <div class="input-group date">
                    <input type="text" name="tanggal" class="form-control pull-right" id="datepicker">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Potong</label>
                <div class="col-sm-4">
                  <select class="form-control select2" name="id_potong" required id="id_cmt">
                    <?php
                      $cmts = mysqli_query($link,"SELECT * FROM potong ORDER BY nm_potong ASC");
                      while ($cmt = mysqli_fetch_array($cmts)) {
                        echo "<option value='$cmt[id_potong]'>$cmt[nm_potong]</option>";
                      }
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Kode Produk</label>
                <div class="col-sm-3">
                  <input type="text" name="kd_produk" class="form-control" id="inputEmail3" required>
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Jumlah Penalty</label>
                <div class="col-sm-3">
                  <input type="text" name="jumlah_penalty" class="form-control" id="inputEmail3" required>
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Keterangan</label>
                <div class="col-sm-6">
                  <textarea name="keterangan" class="form-control"></textarea>
                </div>
              </div>
              <!-- <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Foto</label>
                <div class="col-sm-6">
                  <input type="file" name="file" id="inputEmail3">
                </div>
              </div> -->
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

<script>
$(document).ready(function() {
  
var availableAttributes = [
        <?php
        $qB = mysqli_query($link,"SELECT
              kd_produk 
              FROM 
              produk 
              Order By kd_produk ASC
              ");
        while($rB = mysqli_fetch_array($qB)){
          echo "'" . $rB['kd_produk'] . "',";
        }
        ?>
];

$("input[name^='kd_produk']").autocomplete({
  source: function(request, response) {
    var results = $.ui.autocomplete.filter(availableAttributes, request.term);
    response(results.slice(0, 10));
  }
}); 
  
});

// autocomplete enablement
</script>