<?php
	$id_supplier_aksesoris = $_POST['id_supplier_aksesoris'];
	$tanggal = $_POST['tanggal'];

	$kd_aksesoris = $_POST['kd_aksesoris'];
	$jumlah = $_POST['jumlah'];
	$uom = $_POST['uom'];
	$harga = $_POST['harga'];

	$created_by = $_SESSION['id_user'];
	$post_time = date("Y-m-d H:i:s");

	$i = mysqli_query($link,"INSERT INTO pembelian_aksesoris (
																				tanggal,
																				id_supplier_aksesoris,
																				created_by,
																				post_time
																				)
																VALUES (
																				'$tanggal',
																				'$id_supplier_aksesoris',
																				'$created_by',
																				'$post_time'
																				)
									") or die (mysqli_error());

	$rB = mysqli_fetch_array(mysqli_query($link,"SELECT 
				id_pembelian_aksesoris 
				FROM 
				pembelian_aksesoris 
				WHERE 
				id_supplier_aksesoris = '$id_supplier_aksesoris' 
				AND tanggal = '$tanggal' 
				Order By id_pembelian_aksesoris DESC"));

	foreach ($kd_aksesoris as $k => $v) {
		# code...
		echo "s";
		$iD = mysqli_query($link,"INSERT INTO pembelian_aksesoris_detail (
																					id_pembelian_aksesoris,
																					kd_aksesoris,
																					jumlah,
																					uom,
																					harga
																					)
																	VALUES (
																					'$rB[id_pembelian_aksesoris]',
																					'$v',
																					'$jumlah[$k]',
																					'$uom[$k]',
																					'$harga[$k]'
																					)
										") or die (mysqli_error());

		$qStock = mysqli_query($link,"SELECT id_stok_aksesoris FROM stok_aksesoris WHERE kd_aksesoris = '$v'") or die (mysqli_error());
		$cStock = mysqli_num_rows($qStock);

		if ($cStock > 0) {
			$Ustock = mysqli_query($link,"UPDATE stok_aksesoris SET
								jumlah = jumlah+'$jumlah[$k]'
								WHERE
								kd_aksesoris = '$v'
								") or die (mysqli_error());	
		} else {

			$iStock = mysqli_query($link,"INSERT INTO stok_aksesoris (
																						kd_aksesoris,
																						jumlah
																						)
																		VALUES (
																						'$v',
																						'$jumlah[$k]'
																						)
											") or die (mysqli_error());
		}
	}

	$id_pembelian_aksesoris = base64_encode($rB['id_pembelian_aksesoris']);
	echo "<script>alert('Berhasil Menambahkan Data');
			window.location.href='home.php?act=".md5('pembelian_aksesoris_detail')."&id_pembelian_aksesoris=$id_pembelian_aksesoris';</script>";
?>
