<?php

	$deleteBahan = mysqli_query($link,"DELETE FROM bahan WHERE id_bahan_header = '".base64_decode($_GET['id_bahan_header'])."'");
	$deleteBahanHeader = mysqli_query($link,"DELETE FROM bahan_header WHERE id_bahan_header = '".base64_decode($_GET['id_bahan_header'])."'");

	echo "<script>alert('Berhasil Menghapus Data');
		window.location.href='home.php?act=".md5('bahan')."';</script>"; 
?>