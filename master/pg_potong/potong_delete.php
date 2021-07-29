<?php
	$h = mysqli_query($link,"DELETE FROM potong WHERE id_potong = '".base64_decode($_GET['id_potong'])."'");

	echo "<script>alert('Berhasil Menghapus Data');
		window.location.href='home.php?act=".md5('potong')."';</script>"; 
?>