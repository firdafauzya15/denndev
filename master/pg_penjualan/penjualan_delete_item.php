<?php
	$id_penjualan_detail = base64_decode($_GET['id_penjualan_detail']);
	$id_toko = base64_decode($_GET['id_toko']);

	$qB = mysqli_query($link,"SELECT * FROM penjualan_detail WHERE id_penjualan_detail = '$id_penjualan_detail'") or die (mysqli_error());
	while ($rB = mysqli_fetch_array($qB)) {

		$Ustock = mysqli_query($link,"UPDATE stok SET
							jumlah = jumlah+'$rB[jumlah]'
							WHERE
							id_toko = '$id_toko'
							AND kd_produk_size = '$rB[kd_produk_size]'
							") or die (mysqli_error());	

	}

	$h2 = mysqli_query($link,"DELETE FROM penjualan_detail WHERE id_penjualan_detail = '$id_penjualan_detail'");

	echo "<script>alert('Berhasil Menghapus Data');
		window.location.href='home.php?act=".md5('penjualan')."';</script>"; 
?>