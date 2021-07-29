<?php

$id_potongan_merk = base64_decode($_GET['id_potongan_merk']);
$lns = base64_decode($_GET['lns']);
$u = mysqli_query($link,"UPDATE potongan_merk SET
	status = '$lns'
	WHERE
	id_potongan_merk = '$id_potongan_merk'
") or die (mysqli_error());

echo "<script>alert('Berhasil Mengubah Data');
	window.location.href='home.php?act=".md5('potongan_merk')."';</script>";

?>