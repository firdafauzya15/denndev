<?php
	$h = mysqli_query($link,"DELETE FROM customer WHERE id_customer = '".base64_decode($_GET['id_customer'])."'");

	echo "<script>alert('Berhasil Menghapus Data');
		window.location.href='home.php?act=".md5('customer')."';</script>"; 
?>