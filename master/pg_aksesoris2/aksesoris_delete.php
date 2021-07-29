<?php
	$h = mysqli_query($link,"DELETE FROM aksesoris WHERE id_aksesoris = '".base64_decode($_GET['id_aksesoris'])."'");

	echo "<script>alert('Berhasil Menghapus Data');
		window.location.href='home.php?act=".md5('aksesoris')."';</script>"; 
?>