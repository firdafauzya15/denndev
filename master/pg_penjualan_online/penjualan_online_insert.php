<?php
	$id_toko = $_POST['id_toko'];
	$tanggal = $_POST['tanggal'];
	$id_customer = $_POST['id_customer'];
	
	$pajak = $_POST['pajak'];
	$diskon = $_POST['diskon'];
	$ongkir = $_POST['ongkir'];
	$bayar = $_POST['bayar'];

	$kd_produk_size = $_POST['kd_produk_size'];
	$jumlah = $_POST['jumlah'];
	$harga_jual = $_POST['harga_jual'];

	$created_by = $_SESSION['id_user'];
	$post_time = date("Y-m-d H:i:s");

	$i = mysqli_query($link,"INSERT INTO penjualan (
																				tanggal,
																				id_toko,
																				id_customer,
																				pajak,
																				diskon,
																				ongkir,
																				bayar,
																				online,
																				created_by,
																				post_time
																				)
																VALUES (
																				'$tanggal',
																				'$id_toko',
																				'$id_customer',
																				'$pajak',
																				'$diskon',
																				'$ongkir',
																				'$bayar',
																				'1',
																				'$created_by',
																				'$post_time'
																				)
									") or die (mysqli_error());

	$rB = mysqli_fetch_array(mysqli_query($link,"SELECT 
				id_penjualan 
				FROM 
				penjualan 
				WHERE 
				id_toko = '$id_toko' 
				AND id_customer = '$id_customer' 
				AND tanggal = '$tanggal' 
				AND created_by = '$created_by' 
				AND post_time = '$post_time' 
				Order By id_penjualan DESC"));

  $pecah = explode("-", $tanggal);
  $tahun = $pecah[0];
  $bulan = $pecah[1];
  $hari = $pecah[2];
  $tahun = substr($tahun, -2);
  $nota = "EFG".$hari.$bulan.$tahun.$rB['id_penjualan'];
	$Unota = mysqli_query($link,"UPDATE penjualan SET
						nota = '$nota'
						WHERE
						id_penjualan = '$rB[id_penjualan]'
						") or die (mysqli_error());	

	foreach ($kd_produk_size as $k => $v) {
		# code...
		$iD = mysqli_query($link,"INSERT INTO penjualan_detail (
																					nota,
																					kd_produk_size,
																					jumlah,
																					harga_jual
																					)
																	VALUES (
																					'$nota',
																					'$v',
																					'$jumlah[$k]',
																					'$harga_jual[$k]'
																					)
										") or die (mysqli_error());

		$Ustock = mysqli_query($link,"UPDATE stok SET
							jumlah = jumlah-'$jumlah[$k]'
							WHERE
							id_toko = '$id_toko'
							AND kd_produk_size = '$v'
							") or die (mysqli_error());	

	}
	$nota = base64_encode($nota);
	echo "<script>alert('Berhasil Menambahkan Data');
			window.location.href='home.php?act=".md5('penjualan_online_detail')."&nota=$nota';</script>";
?>