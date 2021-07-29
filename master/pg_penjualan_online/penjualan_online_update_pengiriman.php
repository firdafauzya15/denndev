<?php

	$nota = $_POST['nota'];
	$nm_pengirim = $_POST['nm_pengirim'];
	$bank = $_POST['bank'];
	$total_transfer = $_POST['total_transfer'];
	$no_resi = $_POST['no_resi'];
	$status = $_POST['status'];

	$u = mysqli_query($link,"UPDATE penjualan SET
										nm_pengirim = '$nm_pengirim',
										bank = '$bank',
										total_transfer = '$total_transfer',
										no_resi = '$no_resi',
										status = '$status'
										WHERE
										nota = '$nota'
										") or die (mysqli_error());

	$nota = base64_encode($nota);
	echo "<script>alert('Berhasil Mengubah Data');
			window.location.href='home.php?act=".md5('penjualan_online_detail')."&nota=$nota';</script>";
?>
