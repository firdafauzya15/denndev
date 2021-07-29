<?php
	$h = mysqli_query($link,"DELETE FROM cmt WHERE id_cmt = '".base64_decode($_GET['id_cmt'])."'");

	echo "<script>alert('Berhasil Menghapus Data');
		window.location.href='home.php?act=".md5('cmt')."';</script>"; 
?>