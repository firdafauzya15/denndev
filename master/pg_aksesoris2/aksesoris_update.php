<?php
	$u = mysqli_query($link,"UPDATE aksesoris SET kd_aksesoris = '".$_POST['kd_aksesoris']."', nm_aksesoris = '".$_POST['nm_aksesoris']."' WHERE id_aksesoris = '".$_POST['id_aksesoris']."' ") or die (mysqli_error());
	echo "<script>alert('Berhasil Mengubah Data');
			window.location.href='home.php?act=".md5('aksesoris')."';</script>";
?>
