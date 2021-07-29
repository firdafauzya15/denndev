<?php
	$id_toko = $_POST['id_toko'];
	$id_customer = $_POST['id_customer'];
	$tanggal = $_POST['tanggal'];

	$kd_produk_size = $_POST['kd_produk_size'];
	$lusin = $_POST['lusin'];
	$pcs = $_POST['pcs'];
	$harga_jual = $_POST['harga_jual'];

	$created_by = $_SESSION['id_user'];
	$post_time = date("Y-m-d H:i:s");
echo "INSERT INTO retur_penjualan (
	id_toko,
	id_customer,
	tanggal,
	created_by,
	post_time
	)
VALUES (
	'$id_toko',
	'$id_customer',
	'$tanggal',
	'$created_by',
	'$post_time'
	)
";
	$i = mysqli_query($link,"INSERT INTO retur_penjualan (
																				id_toko,
																				id_customer,
																				tanggal,
																				created_by,
																				post_time,
																				nota
																				)
																VALUES (
																				'$id_toko',
																				'$id_customer',
																				'$tanggal',
																				'$created_by',
																				'$post_time',
																				'0'
																				)
									") or die (mysqli_error());


	$rB = mysqli_fetch_array(mysqli_query($link,"SELECT 
				id_retur_penjualan 
				FROM 
				retur_penjualan 
				WHERE 
				id_toko = '$id_toko' 
				AND id_customer = '$id_customer' 
				AND tanggal = '$tanggal' 
				AND created_by = '$created_by' 
				AND post_time = '$post_time' 
				Order By id_retur_penjualan DESC"));

  $pecah = explode("-", $tanggal);
  $tahun = $pecah[0];
  $bulan = $pecah[1];
  $hari = $pecah[2];
  $tahun = substr($tahun, -2);
  $code_no = str_pad($rB['id_retur_penjualan'], 6, "0", STR_PAD_LEFT);
	$nota = "KT".$code_no;
	$Unota = mysqli_query($link,"UPDATE retur_penjualan SET
						nota = '$nota'
						WHERE
						id_retur_penjualan = '$rB[id_retur_penjualan]'
						") or die (mysqli_error());	

	foreach ($kd_produk_size as $k => $v) {
		# code...
		$jumlah = ($lusin[$k] * 12) + $pcs[$k];
		$iD = mysqli_query($link,"INSERT INTO retur_penjualan_detail (
																					nota,
																					kd_produk_size,
																					jumlah,
																					harga_jual
																					)
																	VALUES (
																					'$nota',
																					'$v',
																					'$jumlah',
																					'$harga_jual[$k]'
																					)
										") or die (mysqli_error());
		$Ustock = mysqli_query($link,"UPDATE stok SET
								jumlah = jumlah+'$jumlah'
								WHERE
								kd_produk_size = '$v'
								AND id_toko = '$id_toko'
								") or die (mysqli_error());	
		

	}

	$nota = base64_encode($nota);
	echo "<script>alert('Berhasil Menambahkan Data');
			window.location.href='home.php?act=".md5('retur_penjualan_detail')."&nota=$nota';</script>";
?>
