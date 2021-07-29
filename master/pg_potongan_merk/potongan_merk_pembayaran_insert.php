<?php

$id_potongan_merk = $_POST['id_potongan_merk'];
$tanggal = $_POST['tanggal'];
$nominal = $_POST['nominal'];
$x = mysqli_query($link,"update potongan_merk set status='1' where id_potongan_merk='".$id_potongan_merk."'");

$i = mysqli_query($link,"INSERT INTO potongan_merk_pembayaran (
	id_potongan_merk,
	tanggal,
	nominal
	)
	VALUES (
	'$id_potongan_merk',
	'$tanggal',
	'$nominal'
	)
") or die (mysqli_error());

$id_potongan_merk = base64_encode($id_potongan_merk);
echo "<script>alert('Berhasil Menambahkan Data');
	window.location.href='home.php?act=".md5('potongan_merk_detail')."&id_potongan_merk=$id_potongan_merk';</script>";

?>