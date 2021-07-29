<?php
	$u = mysqli_query($link,"UPDATE cmt SETnm_cmt = '".$_POST['nm_cmt']."',telp = '".$_POST['telp']."',pic = '".$_POST['pic']."'WHEREid_cmt = '".$_POST['id_cmt']."'") or die (mysqli_error());
	echo "<script>alert('Berhasil Mengubah Data'); window.location.href='home.php?act=".md5('cmt')."';</script>";
?>
