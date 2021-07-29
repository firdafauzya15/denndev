<?php

	$id_brand = $_POST['id_brand'];
	$nm_brand = $_POST['nm_brand'];

	$u = mysqli_query($link,"UPDATE brand SET
										nm_brand = '$nm_brand'
										WHERE
										id_brand = '$id_brand'
										") or die (mysqli_error());

	echo "<script>alert('Berhasil Mengubah Data');
			window.location.href='home.php?act=".md5('brand')."';</script>";
?>
