<?php
	$h = mysqli_query($link,"DELETE FROM vendor WHERE id_vendor = '".base64_decode($_GET['id_vendor'])."'");

	echo "<script>alert('Berhasil Menghapus Data');
		window.location.href='home.php?act=".md5('vendor')."';</script>"; 
?>