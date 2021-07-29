<?php
	$i = mysqli_query($link,"INSERT INTO gudang (nm_gudang,created_by,post_time)VALUES ('".$_POST['nm_gudang']."','".$_SESSION['id_user']."','".date("Y-m-d H:i:s")."')") or die (mysqli_error());
	echo "<script>alert('Berhasil Menambahkan Data'); window.location.href='home.php?act=".md5('gudang')."';</script>";
?>
