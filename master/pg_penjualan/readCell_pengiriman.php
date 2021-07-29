<?php
include"../../lib/koneksi.php";

$index = $_REQUEST["index"];
$nota = $_REQUEST["nota"];
$val = $_REQUEST["val"]; //Hasil dari Barcode Reader

$pecah = explode(" | ", $val);
$kd_produk_size = $pecah[0];


$q = mysqli_query($link,"SELECT 
      produk_size.kd_produk, 
      produk_size.kd_produk_size, 
      produk.nm_produk 
      FROM 
      produk_size
      Inner Join produk ON produk.kd_produk = produk_size.kd_produk 
      WHERE
      produk_size.kd_produk_size = '$kd_produk_size'
      ") or die(mysqli_error());
$rs = mysqli_fetch_array($q);
$cs = mysqli_num_rows($q);
if ($cs > 0) {
?>
  <table class="table table-bordered" id="tabtest<?= $index;?>"  style="margin-bottom: -2px;">
    <tr>
      <td width="20%">
        <?=$rs['kd_produk_size']?>
        <input type="hidden" name="kd_produk[]" value="<?= $rs['kd_produk'];?>">
        <input type="hidden" name="kd_produk_size[]" value="<?= $rs['kd_produk_size'];?>">
      </td>
      <td width="20%"><?=$rs['nm_produk']?></td>
      <td width="20%"><input name="jumlah[]" type="number" required="required" style="width: 85px;" /></td>
      <td width="5%"><a href="javascript:void(0);" class="remCF" onclick="remove(<?= $index;?>)" ><i class="fa fa-remove"></i></a></td>
    </tr>
  </table>
<?php
}
?>
<div id="viewResult<?=$index?>">
</div>
