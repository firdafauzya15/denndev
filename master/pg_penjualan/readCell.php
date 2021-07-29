<?php
include"../../lib/koneksi.php";
include"../function/convert_number.php";
$index = $_REQUEST["index"];
$val = $_REQUEST["val"]; //Hasil dari Barcode Reader
$id_toko = $_REQUEST["id_toko"];

$pecah = explode(" | ", $val);
$kd_produk_size = $pecah[0];

$q = mysqli_query($link,"SELECT
  stok.jumlah,
  produk_size.kd_produk_size,
  produk_size.harga_jual,
  produk.harga_modal,
  produk.nm_produk
  FROM
  stok
  Inner Join produk_size On produk_size.kd_produk_size = stok.kd_produk_size
  Inner Join produk ON produk.kd_produk = produk_size.kd_produk
  WHERE 
  produk_size.kd_produk_size = '$kd_produk_size'
  AND stok.id_toko = '$id_toko'
") or die(mysqli_error());
$rs = mysqli_fetch_array($q);
$cs = mysqli_num_rows($q);
if ($cs > 0) {
?>
  <table class="table table-bordered" id="tabtest<?= $index;?>"  style="margin-bottom: -2px;">
    <tr>
      <td width="20%">
        <input type="hidden" name="kd_produk_size[]" value="<?= $rs['kd_produk_size'];?>" />
        <input type="hidden" name="harga_modal[]" value="<?= $rs['harga_modal'];?>" />
        <?=$rs['kd_produk_size']?>
      </td>
      <td width="20%"><?=$rs['nm_produk']?></td>
      <td width="10%"><input name="lusin[]" class="form-control" type="number" value="0" required="required"/></td>
      <td width="10%"><input name="pcs[]" class="form-control" type="number" value="6" required="required"/></td>
      <td width="20%">
        <input name="harga_jual[]" type="hidden" value="<?= $rs['harga_jual'];?>" required="required" style="width: 85px;" />
        <?= number_format($rs['harga_jual'],0,',','.')?>
      </td>
      <td width="5%"><?= lusin($rs['jumlah']);?></td>
      <td width="5%"><?= pcs($rs['jumlah']);?></td>
      <td width="10%"><a href="javascript:void(0);" class="remCF" onclick="remove(<?= $index;?>)" ><i class="fa fa-remove"></i></a></td>
    </tr>
  </table>
<?php
}
?>
<div id="viewResult<?=$index?>">
</div>
