<?php
	$id_potong = $_POST['id_potong'];
	$tanggal = $_POST['tanggal'];
	$harga = $_POST['harga'];
	$suffix = $_POST['suffix'];

	$id_stok_bahan = $_POST['id_stok_bahan'];
	$kd_bahan = $_POST['kd_bahan'];
	$jumlah = $_POST['jumlah'];

	$id_pola = $_POST['id_pola'];

	$created_by = $_SESSION['id_user'];
	$post_time = date("Y-m-d H:i:s");

	$query = "SELECT id_spk_cutting FROM spk_cutting Order By id_spk_cutting DESC";  
	if ($result = mysqli_query($link,$query) or die(mysqli_error())) {
		$row = mysqli_fetch_assoc($result);
		$count = $row['id_spk_cutting'];
		$count = $count + 1;
		$code_no = str_pad($count, 6, "0", STR_PAD_LEFT);
		$nota = 'SPK' . $code_no . '-' . $suffix;
	}

	$i = mysqli_query($link,"INSERT INTO spk_cutting (
		id_potong,
		tanggal,
		nota,
		harga,
		qty,
		lunas,
		created_by,
		post_time
		)
VALUES (
		'$id_potong',
		'$tanggal',
		'$nota',
		'$harga',
		'0','0',
		'$created_by',
		'$post_time'
		)
") or die (mysqli_error());

	foreach ($kd_bahan as $k => $v) {

		$iD = mysqli_query($link,"INSERT INTO spk_cutting_detail (
																					nota,
																					id_stok_bahan,
																					kd_bahan,
																					jumlah
																					)
																	VALUES (
																					'$nota',
																					'$id_stok_bahan[$k]',
																					'$v',
																					'$jumlah[$k]'
																					)
										") or die (mysqli_error());

		$Ustock = mysqli_query($link,"UPDATE stok_bahan SET
							jumlah = jumlah-'$jumlah[$k]'
							WHERE
							id_stok_bahan = '$id_stok_bahan[$k]'
							") or die (mysqli_error());	

	}

	foreach ($id_pola as $k => $v) {
		# code...
		$iD = mysqli_query($link,"INSERT INTO spk_cutting_pola (
																					nota,
																					id_pola
																					)
																	VALUES (
																					'$nota',
																					'$v'
																					)
										") or die (mysqli_error());

	}

	$nota = base64_encode($nota);
	echo "<script>alert('Berhasil Menambahkan Data');
			window.location.href='home.php?act=".md5('spk_cutting_detail')."&nota=$nota';</script>";
?>
