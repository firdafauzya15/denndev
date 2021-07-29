<?php
include"../../lib/koneksi.php";

$index = $_REQUEST["index"];
$val = $_REQUEST["val"]; //Hasil dari Barcode Reader

$hapus_spasi = preg_replace("/\s+/", "", $val);
$pecah = explode("-", $hapus_spasi);
$kd_produk = $pecah[0];

$q = mysqli_query($link,"SELECT
      produk.kd_produk,
      produk.nm_produk
      FROM
      produk
      WHERE 
      produk.kd_produk = '$kd_produk'
      ") or die(mysqli_error());
$rs = mysqli_fetch_array($q);
$cs = mysqli_num_rows($q);
if($cs > 0){
?>
  <table class="table table-bordered" id="tabtest<?= $index;?>"  style="margin-bottom: -2px;">
    <tr>
      <td width="20%"><input type="hidden" name="kd_produk[]" value="<?= $rs['kd_produk'];?>" /><?=$rs['kd_produk']?></td>
      <td width="20%"><?=$rs['nm_produk']?></td>
      <td width="5%"><a href="javascript:void(0);" class="remCF" onclick="remove(<?= $index;?>)" ><i class="fa fa-remove"></i></a></td>
    </tr>
  </table>
<?php
}
?>
<div id="viewResult<?=$index?>">
</div>
