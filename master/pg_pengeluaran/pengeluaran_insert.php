<?php
	$created_by = $_SESSION['id_user'];
	$post_time = date("Y-m-d H:i:s");

	$i = mysqli_query($link,"INSERT INTO pengeluaran (
																				tanggal,
																				id_toko,
																				nominal,
																				keterangan
																				)
																VALUES (
																				'$_POST[tanggal]',
																				'$_POST[id_toko]',
																				'$_POST[nominal]',
																				'$_POST[keterangan]'
																				)
									") or die (mysqli_error());

	echo "<script>alert('Berhasil Menambahkan Data');
			window.location.href='home.php?act=".md5('pengeluaran')."';</script>";
?>
