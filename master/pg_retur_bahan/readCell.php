<?php
include"../../lib/koneksi.php";

$index = $_REQUEST["index"];
$val = $_REQUEST["val"]; //Hasil dari Barcode Reader

$pecah = explode(" | ", $val);
$kd_bahan = $pecah[0];

$q = mysqli_query($link,"SELECT
      bahan.kd_bahan,
      bahan.nm_bahan
      FROM
      stok_bahan
      Inner Join bahan On bahan.kd_bahan = stok_bahan.kd_bahan 
      WHERE 
      stok_bahan.kd_bahan = '$kd_bahan'
      ") or die(mysqli_error());
$rs = mysqli_fetch_array($q);
$cs = mysqli_num_rows($q);
if ($cs > 0) {
?>
  <table class="table table-bordered" id="tabtest<?= $index;?>"  style="margin-bottom: -2px;">
    <tr>
      <td width="20%"><input type="hidden" name="kd_bahan[]" value="<?= $rs['kd_bahan'];?>" /><?=$rs['kd_bahan']?></td>
      <td width="20%"><?=$rs['nm_bahan']?></td>
      <td width="20%">
        <select name="id_stok_bahan[]" required>
          <option value="">Pilih Stok</option>
          <?php
          $qB = mysqli_query($link,"SELECT kd_bahan,sum(jumlah)as jumlah FROM stok_bahan WHERE kd_bahan = '$rs[kd_bahan]' group by kd_bahan") or die (mysqli_error());
          while ($rB =  mysqli_fetch_array($qB)) {
          ?>
            <option value="<?= $rB['kd_bahan'];?>"><?= $rB['jumlah'];?></option>
          <?php
          }
          ?>
        </select>
      </td>
      <td width="20%"><input name="jumlah[]" type="number" step="any" required="required" style="width: 85px;" /></td>
      <td width="5%"><a href="javascript:void(0);" class="remCF" onclick="remove(<?= $index;?>)" ><i class="fa fa-remove"></i></a></td>
    </tr>
  </table>
<?php
}
?>
<div id="viewResult<?=$index?>">
</div>