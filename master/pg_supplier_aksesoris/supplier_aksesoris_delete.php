<?php
	$h = mysqli_query($link,"DELETE FROM supplier_aksesoris WHERE id_supplier_aksesoris = '".base64_decode($_GET['id_supplier_aksesoris'])."'");

	echo "<script>alert('Berhasil Menghapus Data');
		window.location.href='home.php?act=".md5('supplier_aksesoris')."';</script>"; 
?>