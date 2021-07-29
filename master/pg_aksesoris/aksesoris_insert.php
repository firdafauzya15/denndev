<?php
$kd_aksesoris = $_POST['kd_aksesoris'];
$nm_aksesoris = $_POST['nm_aksesoris'];
$c = mysqli_num_rows(mysqli_query($link,"SELECT id_aksesoris_header FROM aksesoris_header WHERE kd_aksesoris_header = '$_POST[kd_aksesoris_header]'"));
if ($c > 0) {
	echo "<script>alert('Gagal Menyimpan, Kode Aksesoris sudah ada, harap ganti kode Aksesoris!');
			window.location.href='home.php?act=".md5('aksesoris_add')."';</script>";
			
} else {
	$saveAksesorisHeader = mysqli_query($link,"INSERT INTO aksesoris_header VALUES ('0','".$_POST['kd_aksesoris_header']."','".$_POST['nm_aksesoris_header']."','".$_SESSION['id_user']."','".date("Y-m-d H:i:s")."')") or die (mysqli_error());
	$aksesorisHeaderId = mysqli_insert_id($link);
	echo count($kd_aksesoris);
	foreach ($kd_aksesoris as $k => $v) {
		echo "INSERT INTO aksesoris_detail VALUES ('0','".$aksesorisHeaderId."','$v','$nm_aksesoris[$k]')";
		$saveBahan = mysqli_query($link,"INSERT INTO aksesoris_detail VALUES ('0','".$aksesorisHeaderId."','$v','$nm_aksesoris[$k]')") or die (mysqli_error());
	}
	echo "<script>alert('Berhasil Menambahkan Data');
			window.location.href='home.php?act=".md5('aksesoris')."';</script>";
}
?>
