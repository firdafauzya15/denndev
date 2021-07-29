<?php
	$u = mysqli_query($link,"UPDATE vendor SET nm_vendor = '".$_POST['nm_vendor']."',telp = '".$_POST['telp']."',pic = '".$_POST['pic']."' WHERE id_vendor = '".$_POST['id_vendor']."'") or die (mysqli_error());

	echo "<script>alert('Berhasil Mengubah Data');
			window.location.href='home.php?act=".md5('vendor')."';</script>";
?>
