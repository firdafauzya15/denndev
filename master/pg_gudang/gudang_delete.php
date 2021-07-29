<?php
	$h = mysqli_query($link,"DELETE FROM gudang WHERE id_gudang = '".base64_decode($_GET['id_gudang'])."'");
	echo "<script>alert('Berhasil Menghapus Data'); window.location.href='home.php?act=".md5('gudang')."';</script>"; 
?>