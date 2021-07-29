<?php

	$id_stok_gudang = $_POST['id_stok_gudang'];
	$jumlah = $_POST['jumlah'];

	$u = mysqli_query($link,"UPDATE stok_gudang SET
										jumlah = '$jumlah'
										WHERE
										id_stok_gudang = '$id_stok_gudang'
										") or die (mysqli_error());

	echo "<script>alert('Berhasil Mengubah Data');
			window.location.href='home.php?act=".md5('laporan_stok_gudang')."';</script>";
?>
