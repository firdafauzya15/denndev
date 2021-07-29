<?php
$kd_bahan = $_POST['kd_bahan'];
$nm_bahan = $_POST['nm_bahan'];

$created_by = $_SESSION['id_user'];
$post_time = date("Y-m-d H:i:s");

$c = mysqli_num_rows(mysqli_query($link,"SELECT id_bahan_header FROM bahan_header WHERE kd_bahan_header = '$_POST[kd_bahan_header]'"));
if ($c > 0) {
	echo "<script>alert('Gagal Menyimpan, Kode Bahan sudah ada, harap ganti kode bahan!');
			window.location.href='home.php?act=".md5('bahan_add')."';</script>";
			
} else {
	$saveBahanHeader = mysqli_query($link,"INSERT INTO bahan_header VALUES ('0','$_POST[id_satuan_bahan]','$_POST[kd_bahan_header]','$_POST[nm_bahan_header]')") or die (mysqli_error());
	echo $bahanHeaderId = mysqli_insert_id($link);
	foreach ($kd_bahan as $k => $v) {
		echo "INSERT INTO bahan VALUES ('0','".$bahanHeaderId."','$v','$nm_bahan[$k]','$created_by','$post_time')";
		$saveBahan = mysqli_query($link,"INSERT INTO bahan VALUES ('0','".$bahanHeaderId."','$v','$nm_bahan[$k]','$created_by','$post_time')") or die (mysqli_error());
	}
	echo "<script>alert('Berhasil Menambahkan Data');
			window.location.href='home.php?act=".md5('bahan')."';</script>";

}
?>
