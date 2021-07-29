<?php
	$id_pembelian_aksesoris = base64_decode($_GET['id_pembelian_aksesoris']);
	$qB = mysqli_query($link,"SELECT * FROM pembelian_aksesoris_detail WHERE id_pembelian_aksesoris = '$id_pembelian_aksesoris'") or die (mysqli_error());
	while ($rB = mysqli_fetch_array($qB)) {

		$Ustock = mysqli_query($link,"UPDATE stok_aksesoris SET
							jumlah = jumlah-'$rB[jumlah]'
							WHERE
							kd_aksesoris = '$rB[kd_aksesoris]'
							") or die (mysqli_error());	

	}

	$h = mysqli_query($link,"DELETE FROM pembelian_aksesoris WHERE id_pembelian_aksesoris = '$id_pembelian_aksesoris'");
	$h2 = mysqli_query($link,"DELETE FROM pembelian_aksesoris_detail WHERE id_pembelian_aksesoris = '$id_pembelian_aksesoris'");

	echo "<script>alert('Berhasil Menghapus Data');
		window.location.href='home.php?act=".md5('pembelian_aksesoris')."';</script>"; 
?>