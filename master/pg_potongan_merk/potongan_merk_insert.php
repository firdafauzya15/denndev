<?php
	$id_cmt = $_POST['id_cmt'];
	$id_brand = $_POST['id_brand'];
	$tanggal = $_POST['tanggal'];

	$kd_aksesoris = $_POST['kd_aksesoris'];
	$jumlah = $_POST['jumlah'];
	$uom = $_POST['uom'];
	$harga = $_POST['harga'];

	$created_by = $_SESSION['id_user'];
	$post_time = date("Y-m-d H:i:s");

	$i = mysqli_query($link,"INSERT INTO potongan_merk (
																				tanggal,
																				id_cmt,
																				id_brand,
																				created_by,
																				post_time,
																				status
																				)
																VALUES (
																				'$tanggal',
																				'$id_cmt',
																				'$id_brand',
																				'$created_by',
																				'$post_time',
																				'0'
																				)
									") or die (mysqli_error());

	$rB = mysqli_fetch_array(mysqli_query($link,"SELECT 
				id_potongan_merk 
				FROM 
				potongan_merk 
				WHERE 
				id_cmt = '$id_cmt' 
				AND tanggal = '$tanggal' 
				Order By id_potongan_merk DESC"));

	foreach ($kd_aksesoris as $k => $v) {
		# code...
		$iD = mysqli_query($link,"INSERT INTO potongan_merk_detail (
			id_potongan_merk,
			kd_aksesoris,
			jumlah,
			uom,
			harga
			)
			VALUES (
			'$rB[id_potongan_merk]',
			'$v',
			'$jumlah[$k]',
			'$uom[$k]',
			'$harga[$k]'
			)
		") or die (mysqli_error());

		$Ustock = mysqli_query($link,"UPDATE stok_aksesoris SET
			jumlah = jumlah-'$jumlah[$k]'
			WHERE
			kd_aksesoris = '$v'
		") or die (mysqli_error());	
	}

	$id_potongan_merk = base64_encode($rB['id_potongan_merk']);
	echo "<script>alert('Berhasil Menambahkan Data');
			window.location.href='home.php?act=".md5('potongan_merk_detail')."&id_potongan_merk=$id_potongan_merk';</script>";
?>
