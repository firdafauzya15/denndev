<?php
	$nota = $_POST['nota'];
	$tanggal = $_POST['tanggal'];
	$nominal = $_POST['nominal'];
	$id_metode = $_POST['id_metode'];

	$i = mysqli_query($link,"INSERT INTO penjualan_piutang (
																				nota,
																				tanggal,
																				nominal,
																				id_metode
																				)
																VALUES (
																				'$nota',
																				'$tanggal',
																				'$nominal',
																				'$id_metode'
																				)
									") or die (mysqli_error());

	$nota = base64_encode($nota);
	echo "<script>alert('Berhasil Menambahkan Data');
			window.location.href='home.php?act=".md5('penjualan_piutang_detail')."&nota=$nota';</script>";
?>