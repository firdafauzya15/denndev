<?php
	$nota = base64_decode($_GET['nota']);
	$qB = mysqli_query($link,"SELECT * FROM spk_cutting_detail WHERE nota = '$nota'") or die (mysqli_error());
	while ($rB = mysqli_fetch_array($qB)) {

		$Ustock = mysqli_query($link,"UPDATE stok_bahan SET
							jumlah = jumlah+'$rB[jumlah]'
							WHERE
							id_stok_bahan = '$rB[id_stok_bahan]'
							") or die (mysqli_error());	

	}

	$h = mysqli_query($link,"DELETE FROM spk_cutting WHERE nota = '$nota'");
	$h2 = mysqli_query($link,"DELETE FROM spk_cutting_detail WHERE nota = '$nota'");
	$h3 = mysqli_query($link,"DELETE FROM spk_cutting_pola WHERE nota = '$nota'");

	echo "<script>alert('Berhasil Menghapus Data');
		window.location.href='home.php?act=".md5('spk_cutting')."';</script>"; 
?>