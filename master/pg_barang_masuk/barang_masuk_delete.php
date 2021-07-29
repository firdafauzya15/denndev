<?php
	$id_barang_masuk = base64_decode($_GET['id_barang_masuk']);

	$qB = mysqli_query($link,"SELECT * FROM barang_masuk_detail WHERE id_barang_masuk = '$id_barang_masuk'") or die (mysqli_error());
	while ($rB = mysqli_fetch_array($qB)) {

		$Ustock = mysqli_query($link,"UPDATE stok_gudang SET
							jumlah = jumlah-'$rB[jumlah]'
							WHERE
							kd_produk_size = '$rB[kd_produk_size]'
							") or die (mysqli_error());	

	}

	$h = mysqli_query($link,"DELETE FROM barang_masuk WHERE id_barang_masuk = '$id_barang_masuk'");
	$h2 = mysqli_query($link,"DELETE FROM barang_masuk_detail WHERE id_barang_masuk = '$id_barang_masuk'");

	echo "<script>alert('Berhasil Menghapus Data');
		window.location.href='home.php?act=".md5('barang_masuk')."';</script>"; 
?>