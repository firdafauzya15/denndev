<?php
include"../../lib/koneksi.php";

$index = $_REQUEST["index"];
$val = $_REQUEST["val"]; //Hasil dari Barcode Reader

$pecah = explode(" | ", $val);
$kd_pola = $pecah[0];

$q = mysqli_query($link,"SELECT
      pola.id_pola,
      pola.kd_pola,
      pola.nm_pola
      FROM
      pola
      WHERE 
      pola.kd_pola = '$kd_pola'
      ") or die(mysqli_error());
$rs = mysqli_fetch_array($q);
$cs = mysqli_num_rows($q);
if($cs > 0){
?>
  <table class="table table-bordered" id="tabpola<?= $index;?>"  style="margin-bottom: -2px;">
    <tr>
      <td width="20%">
        <input type="hidden" name="id_pola[]" value="<?= $rs['id_pola'];?>" />
        <?=$rs['kd_pola']?>
      </td>
      <td width="20%"><?=$rs['nm_pola']?></td>
      <td width="5%"><a href="javascript:void(0);" class="remCF" onclick="removePola(<?= $index;?>)" ><i class="fa fa-remove"></i></a></td>
    </tr>
  </table>
<?php
}
?>
<div id="viewResultPola<?=$index?>">
</div>