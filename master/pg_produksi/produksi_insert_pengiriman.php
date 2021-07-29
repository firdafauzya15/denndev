<?php
$nota = $_POST['nota'];
$tanggal = $_POST['tanggal'];
$id_produksi_detail = $_POST['id_produksi_detail'];
$lusin = $_POST['lusin'];
$pcs = $_POST['pcs'];
$jumlah_produksi = $_POST['jumlah_produksi'];
$terkirim = $_POST['terkirim'];

$created_by = $_SESSION['id_user'];
$post_time = date("Y-m-d H:i:s");
	
$invalid = 0;

mysqli_query($link,"UPDATE produksi set tgl_balikan = '".$tanggal."' where nota = '".$nota."'");
foreach ($jumlah_produksi as $k => $v) {
	# code...
	$jumlah = ($lusin[$k] * 12) + $pcs[$k];
	$jumlah_kirim = $terkirim[$k] + $jumlah;
	if ($jumlah_kirim > $jumlah_produksi[$k]) {
		$invalid += 1;
	}
}

foreach ($id_produksi_detail as $k => $v) {
	# code...
	if ($invalid > 0) {
		# no command
	} else {

		$i = mysqli_query($link,"INSERT INTO produksi_pengiriman (
				id_produksi_detail,
				tanggal,
				jumlah,
				lunas,
				created_by,
				post_time
				)
				VALUES (
				'$v',
				'$tanggal',
				'$jumlah',
				'0',
				'$created_by',
				'$post_time'
				)
			") or die (mysqli_error());

		$rPro = mysqli_fetch_array(mysqli_query($link,"SELECT kd_produk_size FROM produksi_detail WHERE id_produksi_detail = '$v'"));

		$qStock = mysqli_query($link,"SELECT id_stok_gudang FROM stok_gudang WHERE kd_produk_size = '$rPro[kd_produk_size]'") or die (mysqli_error());
		$cStock = mysqli_num_rows($qStock);
		if ($cStock > 0) {
		
			$Ustock = mysqli_query($link,"UPDATE stok_gudang SET
					jumlah = jumlah+'$jumlah'
					WHERE
					kd_produk_size = '$rPro[kd_produk_size]'
				") or die (mysqli_error());	

		} else {

			$iStock = mysqli_query($link,"INSERT INTO stok_gudang (
					kd_produk_size,
					jumlah
					)
					VALUES (
					'$rPro[kd_produk_size]',
					'$jumlah'
					)
				") or die (mysqli_error());

		}
	}
}

$nota = base64_encode($nota);
if ($invalid > 0) {
	echo "<script>alert('PENGIRIMAN GAGAL, terdapat item yang jumlah kirim melebihi jumlah produksi!');
				window.location.href='home.php?act=".md5('produksi_detail')."&nota=$nota';</script>";
} else {
	echo "<script>alert('Berhasil Menambahkan Data');
			window.location.href='home.php?act=".md5('produksi_detail')."&nota=$nota';</script>";
}
?>