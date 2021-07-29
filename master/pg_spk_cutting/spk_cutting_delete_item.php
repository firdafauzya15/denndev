<?php
	$id_spk_cutting_pengiriman = base64_decode($_GET['id_spk_cutting_pengiriman']);
	$h = mysqli_query($link,"DELETE FROM spk_cutting_pengiriman WHERE id_spk_cutting_pengiriman = '$id_spk_cutting_pengiriman'");

	echo "<script>alert('Berhasil Menghapus Data');
		window.location.href='home.php?act=".md5('spk_cutting')."';</script>"; 
?>