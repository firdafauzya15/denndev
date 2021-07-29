<?php

	$id_penjualan = $_POST['id_penjualan'];
	$nota = base64_encode($_POST['nota']);
	$nm_customer = $_POST['nm_customer'];
	$alamat_customer = $_POST['alamat_customer'];
	$telp_customer = $_POST['telp_customer'];

	$u = mysqli_query($link,"UPDATE penjualan SET
										nm_customer = '$nm_customer',
										alamat_customer = '$alamat_customer',
										telp_customer = '$telp_customer'
										WHERE
										id_penjualan = '$id_penjualan'
										") or die (mysqli_error());

	echo "<script>alert('Berhasil Mengubah Data');
			window.location.href='home.php?act=".md5('penjualan_online_detail')."&nota=$nota';</script>";
?>
