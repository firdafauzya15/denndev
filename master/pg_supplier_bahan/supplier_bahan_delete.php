<?php
	$h = mysqli_query($link,"DELETE FROM supplier_bahan WHERE id_supplier_bahan = '".base64_decode($_GET['id_supplier_bahan'])."'");

	echo "<script>alert('Berhasil Menghapus Data');
		window.location.href='home.php?act=".md5('supplier_bahan')."';</script>"; 
?>