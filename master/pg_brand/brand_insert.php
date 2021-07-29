<?php
	mysqli_query($link,"INSERT INTO brand VALUES ('0','".$_POST['nm_brand']."','".$_POST['gudang']."','".$_SESSION['id_user']."','".date("Y-m-d H:i:s")."')") or die (mysqli_error());
	echo "<script>alert('Berhasil Menambahkan Data');
		  window.location.href='home.php?act=".md5('brand')."';</script>";
?>
