<?php
	$u = mysqli_query($link,"UPDATE gudang SET nm_gudang = '".$_POST['nm_gudang']."' WHERE id_gudang = '".$_POST['id_gudang']."'") or die (mysqli_error());
	echo "<script>alert('Berhasil Mengubah Data'); window.location.href='home.php?act=".md5('gudang')."';</script>";
?>
