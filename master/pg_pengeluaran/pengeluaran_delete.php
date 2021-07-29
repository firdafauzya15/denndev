<?php
	$id_pengeluaran = base64_decode($_GET['id_pengeluaran']);
	$h = mysqli_query($link,"DELETE FROM pengeluaran WHERE id_pengeluaran = '$id_pengeluaran'");

	echo "<script>alert('Berhasil Menghapus Data');
		window.location.href='home.php?act=".md5('pengeluaran')."';</script>"; 
?>