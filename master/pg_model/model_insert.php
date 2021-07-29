<?php

	$i = mysqli_query($link,"INSERT INTO model VALUES ('0','".$_POST['nm_model']."','".$_SESSION['id_user']."','".date("Y-m-d H:i:s")."')") or die (mysqli_error());
	echo "<script>alert('Berhasil Menambahkan Data');
			window.location.href='home.php?act=".md5('model')."';</script>";
?>
