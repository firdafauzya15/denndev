<?php

	$nota = $_POST['nota'];
	$id_produksi_detail = $_POST['id_produksi_detail'];
	$jumlah = $_POST['jumlah'];

	foreach ($id_produksi_detail as $k => $v) {
		# code...
		$u = mysqli_query($link,"UPDATE produksi_detail SET
											jumlah = '$jumlah[$k]'
											WHERE
											id_produksi_detail = '$v'
											") or die (mysqli_error());
	}

	$nota = base64_encode($nota);
	echo "<script>alert('Berhasil Mengubah Data');
			window.location.href='home.php?act=".md5('produksi_detail')."&nota=$nota';</script>";
?>
