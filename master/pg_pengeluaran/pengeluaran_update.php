<?php

	$u = mysqli_query($link,"UPDATE pengeluaran SET
										tanggal = '$_POST[tanggal]',
										id_toko = '$_POST[id_toko]',
										nominal = '$_POST[nominal]',
										keterangan = '$_POST[keterangan]'
										WHERE
										id_pengeluaran = '$_POST[id_pengeluaran]'
										") or die (mysqli_error());

	echo "<script>alert('Berhasil Mengubah Data');
			window.location.href='home.php?act=".md5('pengeluaran')."';</script>";
?>