<?php

$id_qc = base64_decode($_GET['id_qc']);
$lns = base64_decode($_GET['lns']);
$u = mysqli_query($link,"UPDATE qc SET
	status = '$lns'
	WHERE
	id_qc = '$id_qc'
") or die (mysqli_error());

echo "<script>alert('Berhasil Mengubah Data');
	window.location.href='home.php?act=".md5('qc')."';</script>";

?>