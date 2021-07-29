<?php
	$id_retur_bahan = base64_decode($_GET['id_retur_bahan']);
	$qB = mysqli_query($link,"SELECT * FROM retur_bahan_detail WHERE id_retur_bahan = '$id_retur_bahan'") or die (mysqli_error());
	while ($rB = mysqli_fetch_array($qB)) {

		$Ustock = mysqli_query($link,"UPDATE stok_bahan SET
							jumlah = jumlah+'$rB[jumlah]'
							WHERE
							id_stok_bahan = '$rB[id_stok_bahan]'
							") or die (mysqli_error());	

	}

	$h = mysqli_query($link,"DELETE FROM retur_bahan WHERE id_retur_bahan = '$id_retur_bahan'");
	$h2 = mysqli_query($link,"DELETE FROM retur_bahan_detail WHERE id_retur_bahan = '$id_retur_bahan'");

	echo "<script>alert('Berhasil Menghapus Data');
		window.location.href='home.php?act=".md5('retur_bahan')."';</script>"; 
?>