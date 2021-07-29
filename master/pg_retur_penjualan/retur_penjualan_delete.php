<?php
	$nota = base64_decode($_GET['nota']);

	$returPenjualan = mysqli_fetch_array(mysqli_query($link,"SELECT id_toko FROM retur_penjualan WHERE nota = '$nota'"));

	$qB = mysqli_query($link,"SELECT * FROM retur_penjualan_detail WHERE nota = '$nota'") or die (mysqli_error());
	while ($rB = mysqli_fetch_array($qB)) {

		$Ustock = mysqli_query($link,"UPDATE stok SET
							jumlah = jumlah-'$rB[jumlah]'
							WHERE
							kd_produk_size = '$rB[kd_produk_size]'
							AND id_toko = '$returPenjualan[id_toko]'
							") or die (mysqli_error());	

	}

	$h = mysqli_query($link,"DELETE FROM retur_penjualan WHERE nota = '$nota'");
	$h2 = mysqli_query($link,"DELETE FROM retur_penjualan_detail WHERE nota = '$nota'");

	echo "<script>alert('Berhasil Menghapus Data');
		window.location.href='home.php?act=".md5('retur_penjualan')."';</script>"; 
?>