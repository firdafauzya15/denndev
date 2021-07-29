<?php
	$id_surat_jalan = base64_decode($_GET['id_surat_jalan']);
	$id_toko = base64_decode($_GET['id_toko']);

	$qB = mysqli_query($link,"SELECT * FROM surat_jalan_detail WHERE id_surat_jalan = '$id_surat_jalan'") or die (mysqli_error());
	while ($rB = mysqli_fetch_array($qB)) {

		$UstockGudang = mysqli_query($link,"UPDATE stok_gudang SET
			jumlah = jumlah+'$rB[jumlah]'
			WHERE
			kd_produk_size = '$rB[kd_produk_size]'
			") or die (mysqli_error());	

		$Ustock = mysqli_query($link,"UPDATE stok SET
			jumlah = jumlah-'$rB[jumlah]'
			WHERE
			id_toko = '$id_toko'
			AND kd_produk_size = '$rB[kd_produk_size]'
			") or die (mysqli_error());	

	}

	$h = mysqli_query($link,"DELETE FROM surat_jalan WHERE id_surat_jalan = '$id_surat_jalan'");
	$h2 = mysqli_query($link,"DELETE FROM surat_jalan_detail WHERE id_surat_jalan = '$id_surat_jalan'");

	echo "<script>alert('Berhasil Menghapus Data');
		window.location.href='home.php?act=".md5('surat_jalan')."';</script>"; 
?>