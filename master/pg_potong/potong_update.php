<?php
	$u = mysqli_query($link,"UPDATE potong SET nm_potong = '".$_POST['nm_potong']."', telp = '".$_POST['telp']."', pic = '".$_POST['pic']."' WHERE id_potong = '".$_POST['id_potong']."'") or die (mysqli_error());
	echo "<script>alert('Berhasil Mengubah Data');
			window.location.href='home.php?act=".md5('potong')."';</script>";
?>
