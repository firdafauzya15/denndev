<?php
	$id_toko = $_POST['id_toko'];
	$tanggal = date("y-m-d");

	$id_stok = $_POST['id_stok'];
	$kd_produk_size = $_POST['kd_produk_size'];
	$selisih = $_POST['selisih'];
	$stok_lama = $_POST['stok_lama'];
	$stok_baru = $_POST['stok_baru'];
	$total = $_POST['total'];

	$rN = mysqli_fetch_array(mysqli_query($link,"SELECT id_penyesuaian_toko FROM penyesuaian_toko ORDER BY id_penyesuaian_toko DESC limit 1"));
	$autoInc = $rN['id_penyesuaian_toko'] + 1;

	$i = mysqli_query($link,"INSERT INTO penyesuaian_toko (
										tanggal,
										id_toko
										)
								VALUES (
										'$tanggal',
										'$id_toko'
										)
									") or die (mysqli_error());

	foreach ($id_stok as $k => $v) {

		$iD = mysqli_query($link,"INSERT INTO penyesuaian_toko_detail (
											id_penyesuaian_toko,
											kd_produk_size,
											selisih,
											stok_lama,
											stok_baru,
											total
											)
									VALUES (
											'$autoInc',
											'$kd_produk_size[$k]',
											'$selisih[$k]',
											'$stok_lama[$k]',
											'$stok_baru[$k]',
											'$total[$k]'
											)
										") or die (mysqli_error());

		$u = mysqli_query($link,"UPDATE stok SET
							jumlah = '$stok_baru[$k]'
							WHERE
							id_stok = '$v'
							") or die (mysqli_error());

	}
	echo "<script>alert('Berhasil Menambahkan Data');
			window.location.href='home.php?act=".md5('penyesuaian_toko')."';</script>";
?>
