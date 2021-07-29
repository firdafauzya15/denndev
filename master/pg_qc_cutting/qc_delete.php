<?php

$id_qc = base64_decode($_GET['id_qc']);
$qcDelete = mysqli_query($link,"DELETE FROM qc WHERE id_qc = '$id_qc'");

echo "<script>alert('Berhasil Menghapus Data');
	window.location.href='home.php?act=".md5('qc')."';</script>"; 

?>