<?php
	$nota = base64_decode($_GET['nota']);

	$h = mysqli_query($link,"DELETE FROM sablon WHERE nota = '$nota'");
	$h2 = mysqli_query($link,"DELETE FROM sablon_detail WHERE nota = '$nota'");

	echo "<script>alert('Berhasil Menghapus Data');
		window.location.href='home.php?act=".md5('sablon')."';</script>"; 
?>