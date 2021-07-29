<?php
	$id_supplier_bahan = $_POST['id_supplier_bahan'];
	$tanggal = $_POST['tanggal'];
	$jatuh_tempo = date('Y-m-d', strtotime("+3 months", strtotime($tanggal)));
	$keterangan = $_POST['keterangan'];

	$kd_bahan = $_POST['kd_bahan'];
	$jumlah = $_POST['jumlah'];
	$harga = $_POST['harga'];

	$created_by = $_SESSION['id_user'];
	$post_time = date("Y-m-d H:i:s");

	$i = mysqli_query($link,"INSERT INTO pembelian_bahan (
																				tanggal,
																				jatuh_tempo,
																				id_supplier_bahan,
																				keterangan,
																				created_by,
																				post_time
																				)
																VALUES (
																				'$tanggal',
																				'$jatuh_tempo',
																				'$id_supplier_bahan',
																				'$keterangan',
																				'$created_by',
																				'$post_time'
																				)
									") or die (mysqli_error());

	$rB = mysqli_fetch_array(mysqli_query($link,"SELECT 
				id_pembelian_bahan 
				FROM 
				pembelian_bahan 
				WHERE 
				id_supplier_bahan = '$id_supplier_bahan' 
				AND tanggal = '$tanggal' 
				Order By id_pembelian_bahan DESC"));

	foreach ($kd_bahan as $k => $v) {
		# code...
		$iD = mysqli_query($link,"INSERT INTO pembelian_bahan_detail (
																					id_pembelian_bahan,
																					kd_bahan,
																					jumlah,
																					harga
																					)
																	VALUES (
																					'$rB[id_pembelian_bahan]',
																					'$v',
																					'$jumlah[$k]',
																					'$harga[$k]'
																					)
										") or die (mysqli_error());

		$iStock = mysqli_query($link,"INSERT INTO stok_bahan (
																					kd_bahan,
																					jumlah
																					)
																	VALUES (
																					'$v',
																					'$jumlah[$k]'
																					)
										") or die (mysqli_error());

	}

	$id_pembelian_bahan = base64_encode($rB['id_pembelian_bahan']);
	echo "<script>alert('Berhasil Menambahkan Data');
			window.location.href='home.php?act=".md5('pembelian_bahan_detail')."&id_pembelian_bahan=$id_pembelian_bahan';</script>";
?>
