<?php
	$id_kategori = base64_decode($_GET['id_kategori']);
	$h = mysqli_query($link,"DELETE FROM kategori WHERE id_kategori = '$id_kategori'");
	$h2 = mysqli_query($link,"DELETE FROM kategori_size WHERE id_kategori = '$id_kategori'");

	echo "<script>alert('Berhasil Menghapus Data');
		window.location.href='home.php?act=".md5('kategori')."';</script>"; 
?>