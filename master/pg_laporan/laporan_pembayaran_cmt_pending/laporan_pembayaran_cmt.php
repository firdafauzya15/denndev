<?php
$cari = $_POST['cari'];
$id_cmt = $_POST['id_cmt'];
$dari = $_POST['dari'];
$sampai = $_POST['sampai'];
if ($_POST['cari'] != "") {
  $paramsSearch = "?id_cmt=$_POST[id_cmt]&dari=$_POST[dari]&sampai=$_POST[sampai]&cari=$_POST[cari]";
} else {
  $paramsSearch = "";
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data Laporan Pembayaran Produksi CMT Pending
    </h1>
    <ol class="breadcrumb">
      <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Produksi CMT</li>
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
                  <select class="form-control select2" name="id_cmt">
                    <option value="">.:: Pilih CMT ::.</option>
                    <?php
                      $q = mysqli_query($link,"SELECT * FROM cmt Order By nm_cmt ASC");
                      while ($r = mysqli_fetch_array($q)) {
                        if ($id_cmt == $r['id_cmt']) {
                          echo "<option value='$r[id_cmt]' selected>$r[nm_cmt]</option>";
                        } else {
                          echo "<option value='$r[id_cmt]'>$r[nm_cmt]</option>";
                        }
                      }
                    ?>
                  </select>
                </div>
                <div class="col-md-2">
                  <div class="input-group date">
                    <input type="text" name="dari" class="form-control pull-right" id="datepicker" placeholder="Dari" value="<?= $dari;?>">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="input-group date">
                    <input type="text" name="sampai" class="form-control pull-right" id="datepicker2" placeholder="Sampai" value="<?= $sampai;?>">
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
            <form action="" id="formAct" method="post">
              <input type="hidden" name="id_cmt" value="<?= $_POST['id_cmt'];?>">
              <button type="button" id="printBatch" class="btn btn-warning"><span class="fa fa-print"></span> Print</button>
              <br><br>
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th width="1">No.</th>
                    <th width="1"><input type="checkbox" onclick="toggle(this);" /></th>
                    <th>Tanggal</th>
                    <th>Nota Sablon</th>
                    <th>Nota</th>
                    <th>CMT</th>
                    <th>Harga</th>
                    <th>Penyesuaian Harga</th>
                    <th width="1">Lusin</th>
                    <th width="1">Pcs</th>
                    <th>Total</th>
                    <th width="1">Lunas</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  $i = 0;
                  $total_harga = 0;
                  $q_where = "";
                  $q_cmt = "";
                  $q_date = "";
                  $limit = "LIMIT 100";

                  if (isset($cari)) {

                    $q_where = "WHERE";

                    if ($id_cmt == '') {
                      $q_cmt = "produksi.id_cmt != '' AND";
                    } else {
                      $q_cmt = "produksi.id_cmt = '$id_cmt' AND";
                    }

                    if ($dari == '' OR $sampai == '') {
                      $q_date = "produksi_pengiriman.tanggal != '' AND produksi_pengiriman.tanggal != ''";
                    } else {
                      $q_date = "(date(produksi_pengiriman.tanggal) >= '$dari') AND (date(produksi_pengiriman.tanggal) <= '$sampai')";
                    }
                    
                    $limit = "";

                  }

                  $q = mysqli_query($link,"SELECT 
                        produksi_pengiriman.id_produksi_pengiriman, 
                        produksi_pengiriman.jumlah + produksi_pengiriman_bs.jumlah as jumlah, 
                        produksi_pengiriman.tanggal,
                        produksi_pengiriman.lunas,
                        produksi.id_produksi, 
                        produksi.nota,
                        produksi.nota_sablon,
                        produksi.harga,
                        produksi.harga_revisi,
                        cmt.nm_cmt
                        FROM 
                        produksi_pengiriman
                        INNER JOIN produksi_detail ON produksi_detail.id_produksi_detail = produksi_pengiriman.id_produksi_detail
                        INNER JOIN produksi_pengiriman_bs ON produksi_pengiriman_bs.id_produksi_detail = produksi_detail.id_produksi_detail
                        INNER JOIN produksi ON produksi.nota = produksi_detail.nota
                        INNER JOIN cmt ON cmt.id_cmt = produksi.id_cmt
                        $q_where
                        $q_cmt
                        $q_date
                        and produksi_pengiriman.lunas='0'
                        Group By produksi_pengiriman.id_produksi_pengiriman
                        Order By produksi_pengiriman.id_produksi_pengiriman DESC
                        $limit
                        ") or die (mysqli_error());
                  while ($r = mysqli_fetch_array($q)) {
                    $i++;
                    $id_produksi_pengiriman = base64_encode($r['id_produksi_pengiriman']);
                    $nota = base64_encode($r['nota']);
                    $nol = base64_encode("0");
                    $satu = base64_encode("1");
                    if($r['harga_revisi']>0){
                      $subtotal = (lusin($r['jumlah']) * $r['harga_revisi']) + (pcs($r['jumlah']) * ($r['harga_revisi']/12));
                    }else{
                      $subtotal = (lusin($r['jumlah']) * $r['harga']) + (pcs($r['jumlah']) * ($r['harga']/12));
                    }
                   
                    $total_harga += $subtotal;

                    $lunas = "<a href='?act=".md5('laporan_pembayaran_cmt_approve')."&id_produksi_pengiriman=$id_produksi_pengiriman&lns=$satu' title='Lunasi Pembayaran $r[nota]' onclick='return confirm(\"Apakah anda yakin?\")'><span class='label label-warning'>Pending</span></a>";
                    if ($r['lunas'] == '1') {
                      $lunas = "<a href='?act=".md5('laporan_pembayaran_cmt_approve')."&id_produksi_pengiriman=$id_produksi_pengiriman&lns=$nol' title='Batalkan Pelunasan $r[nota]' onclick='return confirm(\"Apakah anda yakin?\")'><span class='label label-success'>Done</span></a>";
                    }
                ?>
                    <tr>
                      <td><?= $i;?></td>
                      <td><input type="checkbox" name="ids[]" value="<?= $r['id_produksi_pengiriman'];?>"></td>
                      <td><?= $r['tanggal'];?></td>
                      <td><?= $r['nota_sablon'];?></td>
                      <td><a href="?act=<?php echo md5('produksi_detail')."&nota=$nota"?>" target="blank" title="Detail Produksi CMT"><?= $r['nota'];?></a></td>
                      <td><?= $r['nm_cmt'];?></td>
                      <td><?= number_format($r['harga']);?></td>
                      <td><?= number_format($r['harga_revisi']);?></td>
                      <td><?= number_format(lusin($r['jumlah']));?></td>
                      <td><?= number_format(pcs($r['jumlah']));?></td>
                      <td><?= number_format($subtotal);?></td>
                      <td><?= $lunas;?></td>
                    </tr>
                <?php
                  }
                ?>
                  <tr style="font-weight: bold;">
                    <td colspan="10" align="right">Total</td>
                    <td><?= number_format($total_harga);?></td>  
                    <td></td>
                  </tr>
                </tbody>
              </table>
            </form>
          </div><!-- /.box-body -->
        </div><!-- /.box -->
      </div><!-- /.col -->
    </div><!-- /.row -->

  </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<script>
var form = document.getElementById('formAct');
/*
document.getElementById('lanjut').onclick = function() {
  form.action = "home.php?module=<?php echo "$url&act=".md5("preview_manpenjualan");?>";
  form.target = '_self';
  form.submit();
}
*/

document.getElementById('printBatch').onclick = function() {
  window.open('', 'formpopup', 'width=794,height=842,resizeable,scrollbars');
  form.action = "master/pg_laporan/laporan_pembayaran_cmt/print_laporan_pembayaran_cmt.php";
  form.target = 'formpopup';
  form.submit();
}
</script>