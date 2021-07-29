<?php
	$id_pembelian_bahan = base64_decode($_GET['id_pembelian_bahan']);
	$qB = mysqli_query($link,"SELECT * FROM pembelian_bahan_detail WHERE id_pembelian_bahan = '$id_pembelian_bahan'") or die (mysqli_error());
	while ($rB = mysqli_fetch_array($qB)) {

		$Ustock = mysqli_query($link,"UPDATE stok_bahan SET
							jumlah = jumlah-'$rB[jumlah]'
							WHERE
							kd_bahan = '$rB[kd_bahan]'
							") or die (mysqli_error());	

	}

	$h = mysqli_query($link,"DELETE FROM pembelian_bahan WHERE id_pembelian_bahan = '$id_pembelian_bahan'");
	$h2 = mysqli_query($link,"DELETE FROM pembelian_bahan_detail WHERE id_pembelian_bahan = '$id_pembelian_bahan'");

	echo "<script>alert('Berhasil Menghapus Data');
		window.location.href='home.php?act=".md5('pembelian_bahan')."';</script>"; 
?>