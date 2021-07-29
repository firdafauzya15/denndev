<?php
if ($_POST['cari'] != "") {
  $paramsSearch = "?id_supplier_bahan=$_POST[id_supplier_bahan]&dari=$_POST[dari]&sampai=$_POST[sampai]&cari=$_POST[cari]";
} else {
  $paramsSearch = "";
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data Laporan Pembelian Bahan
    </h1>
    <ol class="breadcrumb">
      <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Pembelian Bahan</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-body">
            <form action="#" method="post" class="form-horizontal">
              <div class="row">
                <div class="col-md-2">
                  <select class="form-control select2" name="id_supplier_bahan">
                    <option value="">.:: Pilih Supplier ::.</option>
                    <?php
                      $q = mysqli_query($link,"SELECT * FROM supplier_bahan Order By nm_supplier_bahan ASC");
                      while ($r = mysqli_fetch_array($q)) {
                        if ($_POST['id_supplier_bahan'] == $r['id_supplier_bahan']) {
                          echo "<option value='$r[id_supplier_bahan]' selected>$r[nm_supplier_bahan]</option>";
                        } else {
                          echo "<option value='$r[id_supplier_bahan]'>$r[nm_supplier_bahan]</option>";
                        }
                      }
                    ?>
                  </select>
                </div>
                <div class="col-md-2">
                  <div class="input-group date">
                    <input type="text" name="dari" class="form-control pull-right" id="datepicker" required placeholder="Dari" value="<?= $_POST['dari'];?>">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="input-group date">
                    <input type="text" name="sampai" class="form-control pull-right" id="datepicker2" required placeholder="Sampai" value="<?= $_POST['sampai'];?>">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                  </div>
                </div>
                <div class="col-md-1">
                  <input type="submit" class="btn btn-primary" value="cari" name="cari">
                </div>
              </div>
            </form>
            <hr>
            <a class="btn btn-warning" href="#" onClick="MyWindow=window.open('master/pg_laporan/laporan_pembelian_bahan/print_laporan_pembelian_bahan.php<?= $paramsSearch;?>','MyWindow','width=794,height=842'); return false;"><i class="glyphicon glyphicon-print icon-white"></i> Print</a>
            <hr>
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th width="1">No.</th>
                  <th>Tanggal</th>
                  <th>Supplier</th>
                  <th>Harga</th>
                </tr>
              </thead>
              <tbody>
              <?php
                $i = 0;
                $total_harga = 0;
                $where = "";
                $limit = "LIMIT 100";

                if (isset($_POST['cari'])) {

                  $where = "WHERE";
                  if ($_POST['dari'] != '' AND $_POST['sampai'] != '') {
                    $where.= "(date(pembelian_bahan.tanggal) >= '$_POST[dari]') AND (date(pembelian_bahan.tanggal) <= '$_POST[sampai]')";
                  } else {
                    $where.= "pembelian_bahan.tanggal != ''";
                  }
                  if ($_POST['id_supplier_bahan'] != '') {
                    $where.= "AND pembelian_bahan.id_supplier_bahan = '$_POST[id_supplier_bahan]'";
                  } else {
                    $where.= "AND pembelian_bahan.id_supplier_bahan != ''";
                  }
                  $limit = "";

                }

                $q = mysqli_query($link,"SELECT 
                      pembelian_bahan.id_pembelian_bahan, 
                      pembelian_bahan.tanggal, 
                      sum(pembelian_bahan_detail.jumlah*pembelian_bahan_detail.harga) AS sub_total, 
                      supplier_bahan.nm_supplier_bahan
                      FROM 
                      pembelian_bahan 
                      Inner Join pembelian_bahan_detail ON pembelian_bahan_detail.id_pembelian_bahan = pembelian_bahan.id_pembelian_bahan 
                      Inner Join supplier_bahan ON supplier_bahan.id_supplier_bahan = pembelian_bahan.id_supplier_bahan 
                      $where
                      Group By pembelian_bahan.id_pembelian_bahan
                      Order By pembelian_bahan.id_pembelian_bahan DESC
                      $limit
                      ") or die (mysqli_error());
                while ($r = mysqli_fetch_array($q)) {
                  $i++;
                  $id_pembelian_bahan = base64_encode($r['id_pembelian_bahan']);
                  $total_harga += $r['sub_total'];
              ?>
                  <tr>
                    <td><?= $i;?></td>
                    <td><a href="?act=<?php echo md5('pembelian_bahan_detail')."&id_pembelian_bahan=$id_pembelian_bahan"?>" target="blank"><?= $r['tanggal'];?></a></td>
                    <td><?= $r['nm_supplier_bahan'];?></td>
                    <td><?= number_format($r['sub_total']);?></td>
                  </tr>
              <?php
                }
              ?>
                <tr style="font-weight: bold;">
                  <td colspan="3" align="right">Total</td>
                  <td><?= number_format($total_harga);?></td>  
                </tr>
              </tbody>
            </table>
          </div><!-- /.box-body -->
        </div><!-- /.box -->
      </div><!-- /.col -->
    </div><!-- /.row -->

  </section><!-- /.content -->
</div><!-- /.content-wrapper -->