<?php

	$id_stok = $_POST['id_stok'];
	$jumlah = $_POST['jumlah'];

	$u = mysqli_query($link,"UPDATE stok SET
										jumlah = '$jumlah'
										WHERE
										id_stok = '$id_stok'
										") or die (mysqli_error());

	echo "<script>alert('Berhasil Mengubah Data');
			window.location.href='home.php?act=".md5('laporan_stok')."';</script>";
?>
