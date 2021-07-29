<?php
	$h = mysqli_query($link,"DELETE FROM pola WHERE id_pola = '".base64_decode($_GET['id_pola'])."'");

	echo "<script>alert('Berhasil Menghapus Data');
		window.location.href='home.php?act=".md5('pola')."';</script>"; 
?>