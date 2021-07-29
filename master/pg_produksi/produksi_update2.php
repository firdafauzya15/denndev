<?php
$nota = $_POST['nota'];
$notes = $_POST['notes'];

$result = mysqli_query($link,"UPDATE produksi SET
		notes = '$notes'
		WHERE
		nota = '$nota'
	") or die (mysqli_error());

if ($result) {
	$nota = base64_encode($nota);
	echo "<script>alert('Berhasil Mengubah Data');
		window.location.href='home.php?act=".md5('produksi_detail')."&nota=$nota';</script>";
} else {
	echo "<script>alert('Error');
		window.location.href='home.php?act=".md5('produksi_detail')."&nota=$nota';</script>";
}
?>
