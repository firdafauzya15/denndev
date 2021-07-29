<?php
$i = mysqli_query($link,"INSERT INTO customer VALUES ('0','".$_POST['nm_customer']."','".$_POST['telp']."','".$_POST['alamat']."','".$_POST['keterangan']."','".$_SESSION['id_user']."','".date("Y-m-d H:i:s")."')") or die (mysqli_error());
	if ($_POST['act'] == 'penjualan') {
		echo "<script>alert('Berhasil Menambahkan Data');
				window.location.href='home.php?act=".md5('penjualan_add')."';</script>";
	} else if ($_POST['act'] == 'penjualan_online') {
		echo "<script>alert('Berhasil Menambahkan Data');
				window.location.href='home.php?act=".md5('penjualan_online_add')."';</script>";
	} else {
		echo "<script>alert('Berhasil Menambahkan Data');
				window.location.href='home.php?act=".md5('customer')."';</script>";
	}
?>
