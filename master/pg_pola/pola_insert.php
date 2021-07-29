<?php
if ($_FILES['file']['name'] != '') {
	$upload_img = upload_img();
}  

$i = mysqli_query($link,"INSERT INTO pola VALUES ('0','".$_POST['kd_pola']."','".$_POST['nm_pola']."','$upload_img','".$_SESSION['id_user']."','".date("Y-m-d H:i:s")."')") or die (mysqli_error());

echo "<script>alert('Berhasil Menambahkan Data');
	window.location.href='home.php?act=".md5('pola')."';</script>";
?>
