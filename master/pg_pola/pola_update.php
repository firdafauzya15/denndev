<?php
	$u = mysqli_query($link,"UPDATE pola SET kd_pola = '".$_POST['kd_pola']."',nm_pola = '".$_POST['nm_pola']."'WHERE id_pola = '".$_POST['id_pola']."'") or die (mysqli_error());

	echo "<script>alert('Berhasil Mengubah Data');
			window.location.href='home.php?act=".md5('pola')."';</script>";
?>
