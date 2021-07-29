<?php

if ($_FILES['file']['name'] != '') {
	$upload_img = upload_img();
}  
$i = mysqli_query($link,"INSERT INTO qc (
	tanggal,
	id_cmt,
	id_potong,
	id_vendor,
	kd_produk,
	jumlah_penalty,
	keterangan,
	status,
	file
	)
	VALUES (
	'$_POST[tanggal]',
	'$_POST[id_cmt]',
	'0',
	'0',
	'$_POST[kd_produk]',
	'$_POST[jumlah_penalty]',
	'$_POST[keterangan]',
	'0',
	'$upload_img'
	)") or die (mysqli_error());


echo "<script>alert('Berhasil Menambahkan Data');
	window.location.href='home.php?act=".md5('qc')."';</script>";

?>