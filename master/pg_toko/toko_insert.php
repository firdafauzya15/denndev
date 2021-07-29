<?php
	if ($_FILES['file']['name'] != '') {
		$upload_img = upload_img();
	}  
	$i = mysqli_query($link,"INSERT INTO toko VALUES ('".$_POST['nm_toko']."','".$_POST['alamat']."','$upload_img','".$_POST['tipe']."','".$_POST['prefix_nota']."','".$_SESSION['id_user']."','".date("Y-m-d H:i:s")."')") or die (mysqli_error());

	echo "<script>alert('Berhasil Menambahkan Data');
			window.location.href='home.php?act=".md5('toko')."';</script>";
?>
