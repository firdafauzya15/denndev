<?php
	$tanggal = date("y-m-d");

	$id_stok_gudang = $_POST['id_stok_gudang'];
	$kd_produk_size = $_POST['kd_produk_size'];
	$selisih = $_POST['selisih'];
	$stok_gudang_lama = $_POST['stok_gudang_lama'];
	$stok_gudang_baru = $_POST['stok_gudang_baru'];
	$total = $_POST['total'];

	$rN = mysqli_fetch_array(mysqli_query($link,"SELECT id_penyesuaian_gudang FROM penyesuaian_gudang ORDER BY id_penyesuaian_gudang DESC limit 1"));
	$autoInc = $rN['id_penyesuaian_gudang'] + 1;

	$i = mysqli_query($link,"INSERT INTO penyesuaian_gudang (
										tanggal
										)
								VALUES (
										'$tanggal'
										)
									") or die (mysqli_error());

	foreach ($id_stok_gudang as $k => $v) {

		$iD = mysqli_query($link,"INSERT INTO penyesuaian_gudang_detail (
											id_penyesuaian_gudang,
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
											'$stok_gudang_lama[$k]',
											'$stok_gudang_baru[$k]',
											'$total[$k]'
											)
										") or die (mysqli_error());

		$u = mysqli_query($link,"UPDATE stok_gudang SET
							jumlah = '$stok_gudang_baru[$k]'
							WHERE
							id_stok_gudang = '$v'
							") or die (mysqli_error());

	}
	echo "<script>alert('Berhasil Menambahkan Data');
			window.location.href='home.php?act=".md5('penyesuaian_gudang')."';</script>";
?>
