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

	$invalid = 0;
	mysqli_query($link,"UPDATE sablon set tgl_balikan = '".$tanggal."' where nota = '".$nota."'");
	foreach ($jumlah_produksi as $k => $v) {
		# code...
		$jumlah = ($lusin[$k] * 12) + $pcs[$k];
		$jumlah_kirim = $terkirim[$k] + $jumlah;
		if ($jumlah_kirim > $jumlah_produksi[$k]) {
			$invalid += 1;
		}
	}

	foreach ($id_sablon_detail as $k => $v) {

		if ($invalid > 0) {
			# no command
		} else {
		
			$i = mysqli_query($link,"INSERT INTO sablon_pengiriman (
																						id_sablon_detail,
																						tanggal,
																						jumlah,
																						lunas,
																						created_by,
																						post_time
																						)
																		VALUES (
																						'$v',
																						'$tanggal',
																						'$jumlah',
																						'0',
																						'$created_by',
																						'$post_time'
																						)
											") or die (mysqli_error());

		}

	}

	$nota = base64_encode($nota);
	if ($invalid > 0) {
		echo "<script>alert('PENGIRIMAN GAGAL, terdapat item yang jumlah kirim melebihi jumlah produksi!');
					window.location.href='home.php?act=".md5('sablon_detail')."&nota=$nota';</script>";
	} else {
		echo "<script>alert('Berhasil Menambahkan Data');
					window.location.href='home.php?act=".md5('sablon_detail')."&nota=$nota';</script>";
	}
?>