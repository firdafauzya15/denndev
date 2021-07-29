<?php
	$nota = $_POST['nota'];
	$tanggal = $_POST['tanggal'];
	$id_sablon_detail = $_POST['id_sablon_detail'];
	$lusin = $_POST['lusin'];
	$pcs = $_POST['pcs'];
	$jumlah_produksi = $_POST['jumlah_produksi'];
	$terkirim = $_POST['terkirim'];

	$created_by = $_SESSION['id_user'];
	$post_time = date("Y-m-d H:i:s");

	foreach ($id_sablon_detail as $k => $v) {

		$jumlah = ($lusin[$k] * 12) + $pcs[$k];
		$i = mysqli_query($link,"INSERT INTO sablon_pengiriman_bs (
																					id_sablon_detail,
																					tanggal,
																					jumlah,
																					created_by,
																					post_time
																					)
																	VALUES (
																					'$v',
																					'$tanggal',
																					'$jumlah',
																					'$created_by',
																					'$post_time'
																					)
										") or die (mysqli_error());

	}

	$nota = base64_encode($nota);
	echo "<script>alert('Berhasil Menambahkan Data');
				window.location.href='home.php?act=".md5('sablon_detail')."&nota=$nota';</script>";
?>