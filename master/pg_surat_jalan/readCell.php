<?php
include"../../lib/koneksi.php";
include"../function/convert_number.php";

$index = $_REQUEST["index"];
$val = $_REQUEST["val"]; //Hasil dari Barcode Reader

$pecah = explode(" | ", $val);
$kd_produk_size = $pecah[0];

$q = mysqli_query($link,"SELECT
      stok_gudang.jumlah,
      produk_size.kd_produk_size,
      produk.nm_produk
      FROM
      produk_size
      Inner Join stok_gudang ON stok_gudang.kd_produk_size = produk_size.kd_produk_size
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
      <td width="20%"><input type="hidden" name="kd_produk_size[]" value="<?= $rs['kd_produk_size'];?>" /><?=$rs['kd_produk_size']?></td>
      <td width="20%"><?=$rs['nm_produk']?></td>
      <td width="10%"><input name="lusin[]" type="number" class="form-control" required="required"/></td>
      <td width="10%"><input name="pcs[]" type="number" class="form-control" required="required"/></td>
      <td width="5%"><?= lusin($rs['jumlah']);?></td>
      <td width="5%"><?= pcs($rs['jumlah']);?></td>
      <td width="5%"><a href="javascript:void(0);" class="remCF" onclick="remove(<?= $index;?>)" ><i class="fa fa-remove"></i></a></td>
    </tr>
  </table>
<?php
}
?>
<div id="viewResult<?=$index?>">
</div>
