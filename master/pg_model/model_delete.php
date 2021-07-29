<?php
	$h = mysqli_query($link,"DELETE FROM model WHERE id_model = '".base64_decode($_GET['id_model'])."'");
	echo "<script>alert('Berhasil Menghapus Data');
		window.location.href='home.php?act=".md5('model')."';</script>"; 
?>