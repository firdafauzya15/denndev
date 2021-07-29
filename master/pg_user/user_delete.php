<?php
	$h = mysqli_query($link,"DELETE FROM user WHERE id_user = '".base64_decode($_GET['id_user'])."'");

	echo "<script>alert('Berhasil Menghapus User');
		window.location.href='home.php?act=".md5('user')."';</script>"; 
?>