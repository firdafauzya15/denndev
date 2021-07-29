<?php
	$id_toko = $_POST['id_toko'];
	$id_toko_tujuan = $_POST['id_toko_tujuan'];
	$tanggal = $_POST['tanggal'];

	$kd_produk_size = $_POST['kd_produk_size'];
	$lusin = $_POST['lusin'];
	$pcs = $_POST['pcs'];

	$created_by = $_SESSION['id_user'];
	$post_time = date("Y-m-d H:i:s");

	$i = mysqli_query($link,"INSERT INTO surat_jalan_toko (
																				tanggal,
																				id_toko,
																				id_toko_tujuan,
																				created_by,
																				post_time
																				)
																VALUES (
																				'$tanggal',
																				'$id_toko',
																				'$id_toko_tujuan',
																				'$created_by',
																				'$post_time'
																				)
									") or die (mysqli_error());

	$rB = mysqli_fetch_array(mysqli_query($link,"SELECT 
				id_surat_jalan_toko 
				FROM 
				surat_jalan_toko 
				WHERE 
				id_toko = '$id_toko' 
				AND id_toko_tujuan = '$id_toko_tujuan' 
				AND tanggal = '$tanggal' 
				Order By id_surat_jalan_toko DESC"));

	foreach ($kd_produk_size as $k => $v) {
		# code...
		$jumlah = ($lusin[$k] * 12) + $pcs[$k];
		$iD = mysqli_query($link,"INSERT INTO surat_jalan_toko_detail (
																					id_surat_jalan_toko,
																					kd_produk_size,
																					jumlah
																					)
																	VALUES (
																					'$rB[id_surat_jalan_toko]',
																					'$v',
																					'$jumlah'
																					)
										") or die (mysqli_error());

		$qStock = mysqli_query($link,"SELECT id_stok FROM stok WHERE id_toko = '$id_toko_tujuan' AND kd_produk_size = '$v'") or die (mysqli_error());
		$cStock = mysqli_num_rows($qStock);

		$Ustock = mysqli_query($link,"UPDATE stok SET
							jumlah = jumlah-'$jumlah'
							WHERE
							id_toko = '$id_toko'
							AND kd_produk_size = '$v'
							") or die (mysqli_error());	

		if ($cStock > 0) {
			$Ustock = mysqli_query($link,"UPDATE stok SET
								jumlah = jumlah+'$jumlah'
								WHERE
								id_toko = '$id_toko_tujuan'
								AND kd_produk_size = '$v'
								") or die (mysqli_error());	
		} else {

			$iStock = mysqli_query($link,"INSERT INTO stok (
																						id_toko,
																						kd_produk_size,
																						jumlah
																						)
																		VALUES (
																						'$id_toko_tujuan',
																						'$v',
																						'$jumlah'
																						)
											") or die (mysqli_error());
		}

	}

	echo "<script>alert('Berhasil Menambahkan Data');
			window.location.href='home.php?act=".md5('surat_jalan_toko')."';</script>";
?>
