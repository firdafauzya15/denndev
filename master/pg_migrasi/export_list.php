<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Export Data
    </h1>
    <ol class="breadcrumb">
      <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Export Data</li>
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
            <form action="#" method="post" class="form-horizontal" enctype="multipart/form-data">
            <div class="box-body">
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Data Produk</label>
                <div class="col-sm-6">
                  <a href="master/pg_migrasi/export_produk/" class="btn btn-warning" title="Data Produk" target="blank"> Export Data</a>
                </div>
              </div>
              <hr>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Data Detail Produk</label>
                <div class="col-sm-6">
                  <a href="master/pg_migrasi/export_detail_produk/" class="btn btn-warning" title="Data Detail Produk" target="blank"> Export Data</a>
                </div>
              </div>
              <hr>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Data Stok Toko</label>
                <div class="col-sm-6">
                  <a href="master/pg_migrasi/export_stok_toko/" class="btn btn-warning" title="Data Stok Toko" target="blank"> Export Data</a>
                </div>
              </div>
            </div><!-- /.box-body -->
          </form>
        </div><!-- /.box -->
      </div>
    </div><!-- /.row -->

  </section><!-- /.content -->
</div><!-- /.content-wrapper -->