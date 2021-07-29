<?php
	$created_by = $_SESSION['id_user'];
	$post_time = date("Y-m-d H:i:s");

	$i = mysqli_query($link,"INSERT INTO surat_jalan_ekspedisi (
																				tanggal,
																				id_customer,
																				keterangan
																				)
																VALUES (
																				'$_POST[tanggal]',
																				'$_POST[id_customer]',
																				'$_POST[keterangan]'
																				)
									") or die (mysqli_error());

	echo "<script>alert('Berhasil Menambahkan Data');
			window.location.href='home.php?act=".md5('surat_jalan_ekspedisi')."';</script>";
?>
