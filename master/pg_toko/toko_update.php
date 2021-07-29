<?php

	if ($_FILES['file']['name'] == "") {
		$upload_img = $_POST['file_lama'];
	} else {
		$upload_img = upload_img();
		unlink("./upload/$_POST[file_lama]"); // Remove the uploaded file from the PHP temp folder
	}

	$u = mysqli_query($link,"UPDATE toko SET nm_toko = '".$_POST['nm_toko']."',alamat = '".$_POST['alamat']."',prefix_nota = '".$_POST['prefix_nota']."',file = '$upload_img' WHERE id_toko = '".$_POST['id_toko']."'") or die (mysqli_error());

	echo "<script>alert('Berhasil Mengubah Data');
			window.location.href='home.php?act=".md5('toko')."';</script>";
?>
