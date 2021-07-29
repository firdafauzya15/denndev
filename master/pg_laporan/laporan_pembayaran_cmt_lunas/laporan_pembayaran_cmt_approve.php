<?php
	$id_produksi_pengiriman = base64_decode($_GET['id_produksi_pengiriman']);
	$lns = base64_decode($_GET['lns']);
	$u = mysqli_query($link,"UPDATE produksi_pengiriman SET
										lunas = '$lns'
										WHERE
										id_produksi_pengiriman = '$id_produksi_pengiriman'
										") or die (mysqli_error());

	echo "<script>alert('Berhasil Mengubah Data');
			window.location.href='home.php?act=".md5('laporan_pembayaran_cmt')."';</script>";
?>
