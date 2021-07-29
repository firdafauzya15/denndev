<?php
	$lib->query("DELETE FROM brand WHERE id_brand = '".base64_decode($_GET['id_brand'])."'");
	echo "<script>alert('Berhasil Menghapus Data');
		window.location.href='home.php?act=".md5('brand')."';</script>"; 
?>