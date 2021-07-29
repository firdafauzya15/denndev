<?php
$nota = $_POST['nota'];
$mode = $_GET['mode'];
$keterangan = $_POST['keterangan'];
$notes = $_POST['notes'];
$harga = $_POST['harga'];

if($mode=='keterangan'){
	$result = mysqli_query($link,"UPDATE produksi SET
	keterangan = '$keterangan'
	WHERE
	nota = '$nota'
") or die (mysqli_error());
}elseif($mode=='notes'){
	$result = mysqli_query($link,"UPDATE produksi SET
	notes = '$notes'
	WHERE
	nota = '$nota'
") or die (mysqli_error());
}elseif($mode=='harga'){
	$result = mysqli_query($link,"UPDATE produksi SET
	harga_revisi = '$harga'
	WHERE
	nota = '$nota'
") or die (mysqli_error());
}


if ($result) {
	$nota = base64_encode($nota);
	echo "<script>alert('Berhasil Mengubah Data');
		window.location.href='home.php?act=".md5('produksi_detail')."&nota=$nota';</script>";
} else {
	echo "<script>alert('Error');
		window.location.href='home.php?act=".md5('produksi_detail')."&nota=$nota';</script>";
}
?>
