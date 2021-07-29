<?php
$created_by = $_SESSION['id_user'];
$post_time = date("Y-m-d H:i:s");
$kd_bahan = $_POST['kd_bahan'];
$nm_bahan = $_POST['nm_bahan'];

$saveBahanHeader = mysqli_query($link,"UPDATE bahan_header SET
		kd_bahan_header = '$_POST[kd_bahan_header]',
		nm_bahan_header = '$_POST[nm_bahan_header]',
		id_satuan_bahan = '$_POST[id_satuan_bahan]'
		WHERE
		id_bahan_header = '$_POST[id_bahan_header]'
		") or die (mysqli_error());

foreach ($kd_bahan as $k => $v) {
	$bahanCount =  mysqli_num_rows(mysqli_query($link,"SELECT id_bahan FROM bahan WHERE id_bahan_header = '$_POST[id_bahan_header]' AND kd_bahan = '$v'"));
	if ($bahanCount == 0) {
		$saveBahan = mysqli_query($link,"INSERT INTO bahan (id_bahan_header, kd_bahan, nm_bahan, created_by, post_time) 
			VALUES ('$_POST[id_bahan_header]','$v','$nm_bahan[$k]','$created_by','$post_time')") or die (mysqli_error());
	}
}

echo "<script>alert('Berhasil Mengubah Data');
		window.location.href='home.php?act=".md5('bahan')."';</script>";
?>
