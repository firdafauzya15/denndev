<?php

	$nota = base64_decode($_GET['nota']);

	$u = mysqli_query($link,"UPDATE penjualan SET
										pending = '0'
										WHERE
										nota = '$nota'
										") or die (mysqli_error());

	echo "<script>alert('Berhasil Melunasi');
			window.location.href='home.php?act=".md5('penjualan_pending')."';</script>";
?>
