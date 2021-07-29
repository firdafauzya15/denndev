<?php
	$u = mysqli_query($link,"UPDATE supplier_bahan SET nm_supplier_bahan = '".$_POST['nm_supplier_bahan']."', telp = '".$_POST['telp']."', pic = '".$_POST['pic']."' WHERE id_supplier_bahan = '".$_POST['id_supplier_bahan']."'") or die (mysqli_error());

	echo "<script>alert('Berhasil Mengubah Data');
			window.location.href='home.php?act=".md5('supplier_bahan')."';</script>";
?>
