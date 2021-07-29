<?php
	$id_potongan_merk = base64_decode($_GET['id_potongan_merk']);
	$qB = mysqli_query($link,"SELECT * FROM potongan_merk_detail WHERE id_potongan_merk = '$id_potongan_merk'") or die (mysqli_error());
	while ($rB = mysqli_fetch_array($qB)) {

		$Ustock = mysqli_query($link,"UPDATE stok_aksesoris SET
							jumlah = jumlah+'$rB[jumlah]'
							WHERE
							kd_aksesoris = '$rB[kd_aksesoris]'
							") or die (mysqli_error());	

	}

	$h = mysqli_query($link,"DELETE FROM potongan_merk WHERE id_potongan_merk = '$id_potongan_merk'");
	$h2 = mysqli_query($link,"DELETE FROM potongan_merk_detail WHERE id_potongan_merk = '$id_potongan_merk'");

	echo "<script>alert('Berhasil Menghapus Data');
		window.location.href='home.php?act=".md5('potongan_merk')."';</script>"; 
?>