<?php
	$id_spk_cutting_pengiriman = base64_decode($_GET['id_spk_cutting_pengiriman']);
	$lns = base64_decode($_GET['lns']);
	$u = mysqli_query($link,"UPDATE spk_cutting_pengiriman SET
										lunas = '$lns'
										WHERE
										id_spk_cutting_pengiriman = '$id_spk_cutting_pengiriman'
										") or die (mysqli_error());

	echo "<script>alert('Berhasil Mengubah Data');
			window.location.href='home.php?act=".md5('laporan_pembayaran_cutting')."';</script>";
?>
