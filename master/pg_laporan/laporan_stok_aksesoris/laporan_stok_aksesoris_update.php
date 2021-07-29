<?php

	$id_stok_aksesoris = $_POST['id_stok_aksesoris'];
	$jumlah = $_POST['jumlah'];

	$u = mysqli_query($link,"UPDATE stok_aksesoris SET
										jumlah = '$jumlah'
										WHERE
										id_stok_aksesoris = '$id_stok_aksesoris'
										") or die (mysqli_error());

	echo "<script>alert('Berhasil Mengubah Data');
			window.location.href='home.php?act=".md5('laporan_stok_aksesoris')."';</script>";
?>
