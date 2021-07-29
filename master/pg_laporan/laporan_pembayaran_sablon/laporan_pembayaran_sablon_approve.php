<?php
	$id_sablon_pengiriman = base64_decode($_GET['id_sablon_pengiriman']);
	$lns = base64_decode($_GET['lns']);
	$u = mysqli_query($link,"UPDATE sablon_pengiriman SET
										lunas = '$lns'
										WHERE
										id_sablon_pengiriman = '$id_sablon_pengiriman'
										") or die (mysqli_error());

	echo "<script>alert('Berhasil Mengubah Data');
			window.location.href='home.php?act=".md5('laporan_pembayaran_sablon')."';</script>";
?>
