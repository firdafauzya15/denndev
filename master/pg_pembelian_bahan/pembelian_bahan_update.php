<?php

	$id_pembelian_bahan = $_POST['id_pembelian_bahan'];
	$keterangan = $_POST['keterangan'];

	$u = mysqli_query($link,"UPDATE pembelian_bahan SET
										keterangan = '$keterangan'
										WHERE
										id_pembelian_bahan = '$id_pembelian_bahan'
										") or die (mysqli_error());

	echo "<script>alert('Berhasil Mengubah Data');
			window.location.href='home.php?act=".md5('pembelian_bahan')."';</script>";
?>
