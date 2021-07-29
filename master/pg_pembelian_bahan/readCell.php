<?php
include"../../lib/koneksi.php";

$index = $_REQUEST["index"];
$val = $_REQUEST["val"]; //Hasil dari Barcode Reader
$valRow = $_REQUEST["valRow"]; //Hasil dari Barcode Reader

$pecah = explode(" | ", $val);
$kd_bahan = $pecah[0];

$bahans = mysqli_query($link,"SELECT
      bahan.kd_bahan,
      bahan.nm_bahan
      FROM
      bahan
      INNER JOIN bahan_header ON bahan_header.id_bahan_header = bahan.id_bahan_header
      WHERE 
      bahan_header.kd_bahan_header = '$kd_bahan'
      ") or die (mysqli_error());
$countBahan = mysqli_num_rows($bahans);
if ($countBahan > 0) {
  while($bahan = mysqli_fetch_array($bahans)) {
    for ($i = 1; $i <= $valRow; $i++) {
      $randCode = rand(111111, 999999);
?>
      <table class="table table-bordered" id="tabtest<?= $index;?><?= $randCode;?>"  style="margin-bottom: -2px;">
        <tr>
          <td width="20%"><input type="hidden" name="kd_bahan[]" value="<?= $bahan['kd_bahan'];?>" /><?= $bahan['kd_bahan']?></td>
          <td width="20%"><?= $bahan['nm_bahan']?></td>
          <td width="20%"><input name="jumlah[]" type="number" step="any" required="required" style="width: 85px;" /></td>
          <td width="20%"><input name="harga[]" type="number" required="required" style="width: 100px;" /></td>
          <td width="5%"><a href="javascript:void(0);" class="remCF" onclick="remove(<?= $index;?><?= $randCode;?>)" ><i class="fa fa-remove"></i></a></td>
        </tr>
      </table>
<?php
    }
  }
}
?>
<div id="viewResult<?=$index?>">
</div>
