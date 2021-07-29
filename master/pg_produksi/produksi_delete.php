<?php
	$nota = base64_decode($_GET['nota']);
	$qB = mysqli_query($link,"SELECT * FROM produksi_aksesoris WHERE nota = '$nota'") or die (mysqli_error());
	while ($rB = mysqli_fetch_array($qB)) {

		$Ustock = mysqli_query($link,"UPDATE stok_aksesoris SET
							jumlah = jumlah+'$rB[jumlah]'
							WHERE
							kd_aksesoris = '$rB[kd_aksesoris]'
							") or die (mysqli_error());	

	}

	$h = mysqli_query($link,"DELETE FROM produksi WHERE nota = '$nota'");
	$h2 = mysqli_query($link,"DELETE FROM produksi_detail WHERE nota = '$nota'");
	$h2 = mysqli_query($link,"DELETE FROM produksi_aksesoris WHERE nota = '$nota'");

	echo "<script>alert('Berhasil Menghapus Data');
		window.location.href='home.php?act=".md5('produksi')."';</script>"; 
?>