<?php

$deleteBahan = mysqli_query($link,"DELETE FROM bahan WHERE id_bahan = '".base64_decode($_GET['id_bahan'])."'");

echo "<script>alert('Berhasil Menghapus Data');
	window.location.href='home.php?act=".md5('bahan_edit')."&id_bahan_header=$_GET[id_bahan_header]';</script>"; 
?>