<?php

	$id_stok_bahan = $_POST['id_stok_bahan'];
	$jumlah = $_POST['jumlah'];

	$u = mysqli_query($link,"UPDATE stok_bahan SET
										jumlah = '$jumlah'
										WHERE
										id_stok_bahan = '$id_stok_bahan'
										") or die (mysqli_error());

	echo "<script>alert('Berhasil Mengubah Data');
			window.location.href='home.php?act=".md5('laporan_stok_bahan')."';</script>";
?>
