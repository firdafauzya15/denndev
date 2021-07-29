<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Import Data
    </h1>
    <ol class="breadcrumb">
      <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Import Data</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">CSV File</h3>
          </div><!-- /.box-header -->
          <!-- form start -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-4">
                  <h4>1. Import Penjualan</h4>
                  <hr>
                  <form action="home.php?act=<?php echo md5('import_insert')?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="status" value="penjualan">
                    <div class="form-group">
                      <label for="exampleInputFile">File</label>
                      <input type="file" name="file" id="exampleInputFile" required="required">
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-primary" onclick="return confirm('Apakah anda yakin ?')">Simpan</button>
                  </form>
                </div>
                <div class="col-md-4">
                  <h4>2. Import Detail Penjualan</h4>
                  <hr>
                  <form action="home.php?act=<?php echo md5('import_insert')?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="status" value="detail_penjualan">
                    <div class="form-group">
                      <label for="exampleInputFile">File</label>
                      <input type="file" name="file" id="exampleInputFile" required="required">
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-primary" onclick="return confirm('Apakah anda yakin ?')">Simpan</button>
                  </form>
                </div>
              </div>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
      </div>
    </div><!-- /.row -->

  </section><!-- /.content -->
</div><!-- /.content-wrapper -->