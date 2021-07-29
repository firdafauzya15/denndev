<?php
include"../../lib/koneksi.php";

$index = $_REQUEST["index"];
$val = $_REQUEST["val"]; //Hasil dari Barcode Reader
$valSpk = $_REQUEST["valSpk"]; //Hasil dari Barcode Reader
$nota_spk = $valSpk;

$pecah = explode(" | ", $val);
$kd_produk = $pecah[0];
"SELECT
produk.kd_produk,
produk.nm_produk,
model.nm_model
FROM
produk
INNER JOIN spk_cutting_pengiriman ON spk_cutting_pengiriman.kd_produk = produk.kd_produk
INNER JOIN model on produk.id_model = model.id_model
WHERE 
produk.kd_produk = '$kd_produk'
AND spk_cutting_pengiriman.nota = '$nota_spk'
";
$q = mysqli_query($link,"SELECT
      produk.kd_produk,
      produk.nm_produk,
      model.nm_model
      FROM
      produk
      INNER JOIN spk_cutting_pengiriman ON spk_cutting_pengiriman.kd_produk = produk.kd_produk
      INNER JOIN model on produk.id_model = model.id_model
      WHERE 
      produk.kd_produk = '$kd_produk'
      AND spk_cutting_pengiriman.nota = '$nota_spk'
      ") or die(mysqli_error());
$rs = mysqli_fetch_array($q);
$cs = mysqli_num_rows($q);
if($cs > 0){
?>
  <table class="table table-bordered" id="tabtest<?= $index;?>"  style="margin-bottom: -2px;">
    <tr>
      <td width="20%"><input type="hidden" name="kd_produk[]" value="<?= $rs['kd_produk'];?>" /><?=$rs['kd_produk']?></td>
      <td width="20%"><?=$rs['nm_model']?></td>
      <td width="20%"><?=$rs['nm_produk']?></td>
      <td width="20%"><textarea name="keterangan[]"></textarea></td>
      <td width="5%"><a href="javascript:void(0);" class="remCF" onclick="remove(<?= $index;?>)" ><i class="fa fa-remove"></i></a></td>
    </tr>
  </table>
<?php
}
?>
<div id="viewResult<?=$index?>">
</div>
