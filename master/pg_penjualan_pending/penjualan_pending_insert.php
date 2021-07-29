<?php
$id_toko = $_POST['id_toko'];
$id_customer = $_POST['id_customer'];
$nota_retur = $_POST['nota_retur'];
$total_retur = $_POST['total_retur'];
$tanggal = $_POST['tanggal'];
$jatuh_tempo = $_POST['jatuh_tempo'];
$id_metode = $_POST['id_metode'];
$pajak = $_POST['pajak'];
$diskon = $_POST['diskon'];
$bayar = $_POST['bayar'];
$ongkir = $_POST['ongkir'];
$keterangan = $_POST['keterangan'];

$kd_produk_size = $_POST['kd_produk_size'];
$jumlah = $_POST['jumlah'];
$harga_modal = $_POST['harga_modal'];
$harga_jual = $_POST['harga_jual'];

$created_by = $_SESSION['id_user'];
$post_time = date("Y-m-d H:i:s");

$toko = mysqli_fetch_array(mysqli_query($link,"SELECT prefix_nota FROM toko WHERE id_toko = '$id_toko'"));
$penjualan = mysqli_fetch_array(mysqli_query($link,"SELECT prefix_order FROM penjualan WHERE prefix_nota = '$toko[prefix_nota]' ORDER BY prefix_order DESC LIMIT 1"));
$prefix_order = $penjualan['prefix_order'] + 1;

$pecah = explode("-", $tanggal);
$tahun = $pecah[0];
$bulan = $pecah[1];
$hari = $pecah[2];
$nota = $toko['prefix_nota']."-".$hari."/".$bulan."/".$tahun."/".$prefix_order;
$pending = 1;

	$i = mysqli_query($link,"INSERT INTO penjualan (
																				nota,
																				prefix_nota,
																				prefix_order,
																				tanggal,
																				jatuh_tempo,
																				id_metode,
																				id_toko,
																				id_customer,
																				pajak,
																				diskon,
																				bayar,
																				pending,
																				created_by,
																				post_time
																				)
																VALUES (
																				'$nota',
																				'$toko[prefix_nota]',
																				'$prefix_order',
																				'$tanggal',
																				'$jatuh_tempo',
																				'$id_metode',
																				'$id_toko',
																				'$id_customer',
																				'$pajak',
																				'$diskon',
																				'$bayar',
																				'$pending',
																				'$created_by',
																				'$post_time'
																				)
									") or die (mysqli_error());

	foreach ($kd_produk_size as $k => $v) {
		# code...
		$iD = mysqli_query($link,"INSERT INTO penjualan_detail (
																					nota,
																					kd_produk_size,
																					jumlah,
																					harga_modal,
																					harga_jual
																					)
																	VALUES (
																					'$nota',
																					'$v',
																					'$jumlah[$k]',
																					'$harga_modal[$k]',
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
			window.location.href='home.php?act=".md5('penjualan_pending_detail')."&nota=$nota';</script>";
?>
