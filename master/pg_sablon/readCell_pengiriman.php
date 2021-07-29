<?php
include"../../lib/koneksi.php";
include"../function/convert_number.php";

$index = $_REQUEST["index"];
$nota = $_REQUEST["nota"];
$val = $_REQUEST["val"]; //Hasil dari Barcode Reader

$pecah = explode(" | ", $val);
$kd_produk_size = $pecah[0];


$q = mysqli_query($link,"SELECT 
      sablon_detail.id_sablon_detail, 
      sablon_detail.jumlah,
      sablon_detail.kd_produk_size, 
      produk.nm_produk 
      FROM 
      sablon_detail
      Inner Join produk ON produk.kd_produk = sablon_detail.kd_produk 
      WHERE 
      sablon_detail.nota = '$nota'
      AND sablon_detail.kd_produk_size = '$kd_produk_size'
      ") or die(mysqli_error());
$rs = mysqli_fetch_array($q);
$cs = mysqli_num_rows($q);
if ($cs > 0) {

  $rKD = mysqli_fetch_array(mysqli_query($link,"SELECT 
          sum(sablon_pengiriman.jumlah) AS terkirim
          FROM
          sablon_pengiriman
          WHERE 
          sablon_pengiriman.id_sablon_detail = '$rs[id_sablon_detail]'
          "));
  $sisa = $rs['jumlah'] - $rKD['terkirim'];
?>
  <input type="hidden" name="id_sablon_detail[]" value="<?= $rs['id_sablon_detail'];?>"/>
  <input type="hidden" name="jumlah_produksi[]" value="<?= $rs['jumlah'];?>"/>
  <input type="hidden" name="terkirim[]" value="<?= $rKD['terkirim'];?>"/>
  <table class="table table-bordered" id="tabtest<?= $index;?>"  style="margin-bottom: -2px;">
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
