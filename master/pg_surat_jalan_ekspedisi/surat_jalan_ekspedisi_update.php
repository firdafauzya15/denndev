<?php

	$u = mysqli_query($link,"UPDATE surat_jalan_ekspedisi SET
										tanggal = '$_POST[tanggal]',
										id_customer = '$_POST[id_customer]',
										keterangan = '$_POST[keterangan]'
										WHERE
										id_surat_jalan_ekspedisi = '$_POST[id_surat_jalan_ekspedisi]'
										") or die (mysqli_error());

	echo "<script>alert('Berhasil Mengubah Data');
			window.location.href='home.php?act=".md5('surat_jalan_ekspedisi')."';</script>";
?>