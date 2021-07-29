<?php
	$u = mysqli_query($link,"UPDATE model SET nm_model = '".$_POST['nm_model']."' WHERE id_model = '".$_POST['id_model']."'") or die (mysqli_error());

	echo "<script>alert('Berhasil Mengubah Data');
			window.location.href='home.php?act=".md5('model')."';</script>";
?>
