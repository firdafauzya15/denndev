<?php

$user = mysqli_query($link,"SELECT * FROM user WHERE username = '".$_POST['username']."'") or die (mysqli_error());
if (mysqli_num_rows($user) == 0) {
	$result = mysqli_query($link,"INSERT INTO user VALUES ('0','".$_POST['name']."','".$_POST['username']."','".md5($_POST['password'])."','".$_POST['password']."','','".$_POST['id_level']."','".(($_POST['id_toko']=='.:: Pilih Toko ::.')?'0':$_POST['id_toko'])."','".(($_POST['id_gudang']=='.:: Pilih Gudang ::.')?'0':$_POST['id_gudang'])."','1','0')") or die (mysqli_error());
	echo "<script>alert('Berhasil Menambahkan User');
	window.location.href='home.php?act=".md5('user')."';</script>";
} else {
	echo "<script>alert('Gagal, Username sudah digunakan');
	window.location.href='home.php?act=".md5('user')."';</script>";
}

?>
