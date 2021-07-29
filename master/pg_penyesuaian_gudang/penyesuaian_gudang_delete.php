<?php
	$id_retur_surat_jalan = base64_decode($_GET['id_retur_surat_jalan']);

	$qB = mysqli_query($link,"SELECT * FROM retur_surat_jalan_detail WHERE id_retur_surat_jalan = '$id_retur_surat_jalan'") or die (mysqli_error());
	while ($rB = mysqli_fetch_array($qB)) {

		$Ustock = mysqli_query($link,"UPDATE stok SET
							jumlah = jumlah+'$rB[jumlah]'
							WHERE
							kd_produk_size = '$rB[kd_produk_size]'
							AND id_toko = '$rB[id_toko]'
							") or die (mysqli_error());	

		$UstockG = mysqli_query($link,"UPDATE stok_gudang SET
							jumlah = jumlah-'$rB[jumlah]'
							WHERE
							kd_produk_size = '$rB[kd_produk_size]'
							") or die (mysqli_error());	

	}

	$h = mysqli_query($link,"DELETE FROM retur_surat_jalan WHERE id_retur_surat_jalan = '$id_retur_surat_jalan'");
	$h2 = mysqli_query($link,"DELETE FROM retur_surat_jalan_detail WHERE id_retur_surat_jalan = '$id_retur_surat_jalan'");

	echo "<script>alert('Berhasil Menghapus Data');
		window.location.href='home.php?act=".md5('retur_surat_jalan')."';</script>"; 
?>