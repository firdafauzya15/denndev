<?php
	$nota = $_POST['nota'];
	$tanggal = $_POST['tanggal'];
	$kd_produk = $_POST['kd_produk'];
	$kd_produk_size = $_POST['kd_produk_size'];
	$lusin = $_POST['lusin'];
	$pcs = $_POST['pcs'];

	$created_by = $_SESSION['id_user'];
	$post_time = date("Y-m-d H:i:s");

	foreach ($kd_produk_size as $k => $v) {

		$jumlah = ($lusin[$k] * 12) + $pcs[$k];

		$i = mysqli_query($link,"INSERT INTO spk_cutting_pengiriman (
			tanggal,
			nota,
			kd_produk,
			kd_produk_size,
			jumlah,
			lunas,
			created_by,
			post_time
			)
VALUES (
			'$tanggal',
			'$nota',
			'$kd_produk[$k]',
			'$v',
			'$jumlah',
			'0',
			'$created_by',
			'$post_time'
			)
") or die (mysqli_error());

	}

	$nota = base64_encode($nota);
	echo "<script>alert('Berhasil Menambahkan Data');
				window.location.href='home.php?act=".md5('spk_cutting_detail')."&nota=$nota';</script>";
?>