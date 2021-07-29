<?php
	$lib->query("UPDATE brand SET nm_brand = '".$_POST['nm_brand']."' WHERE id_brand = '".$_POST['id_brand']."'");

	echo "<script>alert('Berhasil Mengubah Data');
			window.location.href='home.php?act=".md5('brand')."';</script>";
?>
