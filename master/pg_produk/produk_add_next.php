<div class="content-wrapper">
  <section class="content-header">
    <h1>Data Produk</h1>
    <ol class="breadcrumb">
      <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Produk</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-info">
          <div class="box-header with-border"><h3 class="box-title">Tambah Produk</h3></div>
          <form action="home.php?act=<?php echo md5('produk_insert')?>" method="post" class="form-horizontal" enctype="multipart/form-data">
            <input type="hidden" name="id_tipe_produk" value="<?= $_GET['id_tipe_produk'];?>">
            <input type="hidden" name="id_brand" value="<?= $_GET['id_brand'];?>">
            <input type="hidden" name="id_pola" value="<?= $_GET['id_pola'];?>">
            <input type="hidden" name="kd_produk" value="<?= $_GET['kd_produk'];?>">
            <input type="hidden" name="nm_produk" value="<?= $_GET['nm_produk'];?>">
            <input type="hidden" name="harga_modal" value="<?= $_GET['harga_modal'];?>">
            <div class="box-body">
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Foto</label>
                <div class="col-sm-6">
                  <input type="file" name="file" id="inputEmail3">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Detail</label>
              <div class="col-sm-6">
                <table class="table">
                  <tr>
                    <th>Warna</th>
                    <th>Harga Jual</th>
                  </tr>
                  <?php
                  $id_size = $_GET['id_size'];
                  foreach ($id_size as $key => $value) {
                    $size = mysqli_fetch_array(mysqli_query($link,"SELECT * FROM size WHERE id_size = '$value'"));
                    echo "<tr>";
                    echo "<td>$_GET[kd_produk]-$size[nm_size]</td>";
                    echo "<td>";
                    echo "<input type='hidden' name='id_size[]' value='$value' class='form-control'>";
                    echo "<input type='number' name='harga_jual[]' class='form-control'>";
                    echo "</td>";
                    echo "</tr>";
                  }
                  ?>
                </table>
              </div>
            </div>

            <div class="box-footer">
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label"></label>
                <div class="col-sm-6">
                  <button type="submit" class="btn btn-primary" onclick="return confirm('Apakah anda yakin ?')">Simpan</button>
                </div>
              </div>
            </div><!-- /.box-footer -->
          </form>
        </div><!-- /.box -->
      </div>
    </div><!-- /.row -->

  </section><!-- /.content -->
</div><!-- /.content-wrapper -->