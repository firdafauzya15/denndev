<?php
	$kd_aksesoris = $_POST['kd_aksesoris'];

	$c = mysqli_num_rows(mysqli_query($link,"SELECT id_aksesoris FROM aksesoris WHERE kd_aksesoris = '$kd_aksesoris'"));
	if ($c > 0) {
		echo "<script>alert('Gagal Menyimpan, Kode aksesoris sudah ada, harap ganti kode aksesoris!');
				window.location.href='home.php?act=".md5('aksesoris_add')."';</script>";	
	} else {
		$i = mysqli_query($link,"INSERT INTO aksesoris VALUES ('0','$kd_aksesoris','".$_POST['nm_aksesoris']."','0','".$_SESSION['id_user']."','".date("Y-m-d H:i:s")."')") or die (mysqli_error());
		echo "<script>alert('Berhasil Menambahkan Data');
				window.location.href='home.php?act=".md5('aksesoris')."';</script>";

	}
?>
