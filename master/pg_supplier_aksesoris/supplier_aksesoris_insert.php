<?php
	$i = mysqli_query($link,"INSERT INTO supplier_aksesoris VALUES ('0','".$_POST['nm_supplier_aksesoris']."','".$_POST['telp']."','".$_POST['pic']."','".$_SESSION['id_user']."','".date("Y-m-d H:i:s")."')") or die (mysqli_error());

	echo "<script>alert('Berhasil Menambahkan Data');
			window.location.href='home.php?act=".md5('supplier_aksesoris')."';</script>";

	
?>
