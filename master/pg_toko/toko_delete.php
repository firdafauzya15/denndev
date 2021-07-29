<?php
	$h = mysqli_query($link,"DELETE FROM toko WHERE id_toko = '".base64_decode($_GET['id_toko'])."'");
	echo "<script>alert('Berhasil Menghapus Data');
		window.location.href='home.php?act=".md5('toko')."';</script>"; 
?>