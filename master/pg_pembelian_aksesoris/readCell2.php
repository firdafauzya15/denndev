<?php
include"../../lib/koneksi.php";

$index = $_REQUEST["index"];
$val = $_REQUEST["val"]; //Hasil dari Barcode Reader

$pecah = explode("|", $val);
$kd_aksesoris = $pecah[0];

$q = mysqli_query($link,"SELECT
      aksesoris.kd_aksesoris,
      aksesoris.nm_aksesoris
      FROM
      aksesoris
      WHERE 
      kd_aksesoris = '$kd_aksesoris'
      ") or die(mysqli_error());
$rs = mysqli_fetch_array($q);
$cs = mysqli_num_rows($q);
if($cs > 0){
?>

    <tr>
      <td width="20%"><input type="hidden" name="kd_aksesoris[]" value="<?= $rs['kd_aksesoris'];?>" /><?=$rs['kd_aksesoris']?></td>
      <td width="20%"><?=$rs['nm_aksesoris']?></td>
      <td width="20%"><input name="jumlah[]" type="number" step="any" required="required" style="width:100px;" /></td>
      <td width="15%">
      <select class="form-control" name="uom[]" required>
          <option value="pcs">Pcs</option>
          <option value="lusin">Lusin</option>
          <option value="gross">Gross</option>
          <option value="kodi">Kodi</option>
        </select>
      </td>
      <td width="20%"><input name="harga[]" type="number" required="required" style="width: 100px;" /></td>
      <td width="5%"><a href="javascript:void(0);" class="remCF" onclick="remove(<?= $index;?>)" ><i class="fa fa-remove"></i></a></td>
    </tr>
<?php
}
?>
<div id="viewResult<?=$index?>">
</div>
