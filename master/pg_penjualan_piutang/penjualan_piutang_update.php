<?php
	$nota = base64_decode($_GET['nota']);
	$lns = base64_decode($_GET['lns']);
	$u = mysqli_query($link,"UPDATE penjualan SET
										status = '$lns'
										WHERE
										nota = '$nota'
										") or die (mysqli_error());

	echo "<script>alert('Berhasil Mengubah Data');
			window.location.href='home.php?act=".md5('penjualan_piutang')."';</script>";
?>
