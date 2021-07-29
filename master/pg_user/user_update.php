<?php
	$u = mysqli_query($link,"UPDATE user SET name = '".$_POST['name']."', id_level = '".$_POST['id_level']."',username = '".$_POST['username']."',password = '".md5($_POST['password'])."',password_read = '".$_POST['password']."' WHERE id_user = '".$_POST['id_user']."'") or die (mysqli_error());

	echo "<script>alert('Berhasil Mengubah user');
			window.location.href='home.php?act=".md5('user')."';</script>";
?>
