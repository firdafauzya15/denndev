<?php
	$tanggal = $_POST['tanggal'];

	$kd_produk_size = $_POST['kd_produk_size'];
	$lusin = $_POST['lusin'];
	$pcs = $_POST['pcs'];

	$created_by = $_SESSION['id_user'];
	$post_time = date("Y-m-d H:i:s");

	$i = mysqli_query($link,"INSERT INTO barang_masuk (
																				tanggal,
																				created_by,
																				post_time
																				)
																VALUES (
																				'$tanggal',
																				'$created_by',
																				'$post_time'
																				)
									") or die (mysqli_error());

	$rB = mysqli_fetch_array(mysqli_query($link,"SELECT 
				id_barang_masuk 
				FROM 
				barang_masuk 
				WHERE
				tanggal = '$tanggal'
				AND post_time = '$post_time' 
				Order By id_barang_masuk DESC"));

	foreach ($kd_produk_size as $k => $v) {
		# code...
		$jumlah = ($lusin[$k] * 12) + $pcs[$k];
		$iD = mysqli_query($link,"INSERT INTO barang_masuk_detail (
																					id_barang_masuk,
																					kd_produk_size,
																					jumlah
																					)
																	VALUES (
																					'$rB[id_barang_masuk]',
																					'$v',
																					'$jumlah'
																					)
										") or die (mysqli_error());

		$qStock = mysqli_query($link,"SELECT id_stok_gudang FROM stok_gudang WHERE kd_produk_size = '$v'") or die (mysqli_error());
		$cStock = mysqli_num_rows($qStock);

		if ($cStock > 0) {
			$Ustock = mysqli_query($link,"UPDATE stok_gudang SET
								jumlah = jumlah+'$jumlah'
								WHERE
								kd_produk_size = '$v'
								") or die (mysqli_error());	
		} else {

			$iStock = mysqli_query($link,"INSERT INTO stok_gudang (
																						kd_produk_size,
																						jumlah
																						)
																		VALUES (
																						'$v',
																						'$jumlah'
																						)
											") or die (mysqli_error());
		}

	}

	echo "<script>alert('Berhasil Menambahkan Data');
			window.location.href='home.php?act=".md5('barang_masuk')."';</script>";
?>
