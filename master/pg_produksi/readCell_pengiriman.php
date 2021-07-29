<?php
include"../../lib/koneksi.php";
include"../function/convert_number.php";

$index = $_REQUEST["index"];
$nota = $_REQUEST["nota"];
$val = $_REQUEST["val"]; //Hasil dari Barcode Reader

$pecah = explode(" | ", $val);
$kd_produk_size = $pecah[0];

$q = mysqli_query($link,"SELECT 
      id_produksi_detail, 
      kd_produk_size, 
      nm_produk 
      FROM 
      produksi_detail
      INNER JOIN produk ON produk.kd_produk = produksi_detail.kd_produk 
      WHERE 
      produksi_detail.nota = '$nota'
      AND produksi_detail.kd_produk_size = '$kd_produk_size'
      ") or die(mysqli_error());
$rs = mysqli_fetch_array($q);
$cs = mysqli_num_rows($q);
if ($cs > 0) {

    $rPD = mysqli_fetch_array(mysqli_query($link,"SELECT 
            sum(produksi_detail.jumlah) AS produksi
            FROM
            produksi_detail
            WHERE 
            produksi_detail.nota = '$nota'
            AND produksi_detail.kd_produk_size = '$rs[kd_produk_size]'
            GROUP BY produksi_detail.kd_produk 
            "));

    $rKD = mysqli_fetch_array(mysqli_query($link,"SELECT 
            sum(produksi_pengiriman.jumlah) AS terkirim
            FROM
            produksi_pengiriman
            WHERE 
            produksi_pengiriman.id_produksi_detail = '$rs[id_produksi_detail]'
            "));

    $sisa = $rPD['produksi'] - $rKD['terkirim'];
?>
  <input type="hidden" name="id_produksi_detail[]" value="<?= $rs['id_produksi_detail'];?>"/>
  <input type="hidden" name="jumlah_produksi[]" value="<?= $rPD['produksi'];?>"/>
  <input type="hidden" name="terkirim[]" value="<?= $rKD['terkirim'];?>"/>
  <table class="table table-bordered" id="tabtest<?= $index;?>" style="margin-bottom: -2px;">
    <tr>
      <td width="20%"><?=$rs['kd_produk_size']?></td>
      <td width="20%"><?=$rs['nm_produk']?></td>
      <td width="10%"><input name="lusin[]" type="number" required="required" style="width: 60px;" /></td>
      <td width="10%"><input name="pcs[]" type="number" required="required" style="width: 60px;" /></td>
      <td width="10%"><?= number_format(lusin($sisa));?></td>
      <td width="10%"><?= number_format(pcs($sisa));?></td>
      <td width="5%"><a href="javascript:void(0);" class="remCF" onclick="remove(<?= $index;?>)" ><i class="fa fa-remove"></i></a></td>
    </tr>
  </table>
<?php
}
?>
<div id="viewResult<?=$index?>">
</div>