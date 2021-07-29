<?php

if ($_FILES['file']['name'] == "") {
	$upload_img = $_POST['file_lama'];
} else {
$upload_img = upload_img();
	unlink("./upload/$_POST[file_lama]"); // Remove the uploaded file from the PHP temp folder
}

$u = mysqli_query($link,"UPDATE qc SET
	tanggal = '$_POST[tanggal]',
	id_cmt = '$_POST[id_cmt]',
	kd_produk = '$_POST[kd_produk]',
	jumlah_penalty = '$_POST[jumlah_penalty]',
	keterangan = '$_POST[keterangan]',
	file = '$upload_img'
	WHERE
	id_qc = '$_POST[id_qc]'
") or die (mysqli_error());

echo "<script>alert('Berhasil Mengubah Data');
	window.location.href='home.php?act=".md5('qc')."';</script>";

?>