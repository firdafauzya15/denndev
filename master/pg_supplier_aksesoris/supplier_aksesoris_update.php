<?php
	$u = mysqli_query($link,"UPDATE supplier_aksesoris SET nm_supplier_aksesoris = '".$_POST['nm_supplier_aksesoris']."', telp = '".$_POST['telp']."', pic = '".$_POST['pic']."' WHERE id_supplier_aksesoris = '".$_POST['id_supplier_aksesoris']."'") or die (mysqli_error());

	echo "<script>alert('Berhasil Mengubah Data');
			window.location.href='home.php?act=".md5('supplier_aksesoris')."';</script>";
?>
