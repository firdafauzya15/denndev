<?php
	$u = mysqli_query($link,"UPDATE customer SET nm_customer = '".$_POST['nm_customer']."',telp = '".$_POST['telp']."',alamat = '".$_POST['alamat']."',keterangan = '".$_POST['keterangan']."' WHERE id_customer = '".$_POST['id_customer']."'") or die (mysqli_error());

	echo "<script>alert('Berhasil Mengubah Data');
			window.location.href='home.php?act=".md5('customer')."';</script>";
?>
