<?php
$nota = $_POST['nota'];
$tanggal = $_POST['tanggal'];
$jatuh_tempo = $_POST['jatuh_tempo'];
$nota_spk = $_POST['nota_spk'];
$id_vendor = $_POST['id_vendor'];
$harga = $_POST['harga'];

$keterangan = $_POST['keterangan'];
$kd_produk = $_POST['kd_produk'];
$kd_produk_size = $_POST['kd_produk_size'];
$lusin = $_POST['lusin'];
$pcs = $_POST['pcs'];

$created_by = $_SESSION['id_user'];
$post_time = date("Y-m-d H:i:s");
echo "INSERT INTO sablon (
	tanggal,
	jatuh_tempo,
	nota_spk,
	nota,
	id_vendor,
	harga,
	created_by,
	post_time
	)
	VALUES (
	'$tanggal',
	'$jatuh_tempo',
	'$nota_spk',
	'$nota',
	'$id_vendor',
	'$harga',
	'$created_by',
	'$post_time'
	)
";
$sablonSave = mysqli_query($link,"INSERT INTO sablon (
	tanggal,
	jatuh_tempo,
	nota_spk,
	nota,
	id_vendor,
	harga,
	lunas,
	created_by,
	post_time
	)
	VALUES (
	'$tanggal',
	'$jatuh_tempo',
	'$nota_spk',
	'$nota',
	'$id_vendor',
	'$harga',
	'0',
	'$created_by',
	'$post_time'
	)
") or die (mysqli_error());

foreach ($kd_produk as $k => $v) {
	$jumlah = ($lusin[$k] * 12) + $pcs[$k];
	$sablonDetailSave = mysqli_query($link,"INSERT INTO sablon_detail (
		nota,
		kd_produk,
		kd_produk_size,
		jumlah
		)
		VALUES (
		'$nota',
		'$v',
		'$kd_produk_size[$k]',
		'$jumlah'
		)
	") or die (mysqli_error());
	$countSablonKeterangan = mysqli_num_rows(mysqli_query($link,"SELECT id_sablon_keterangan FROM sablon_keterangan WHERE nota = '$nota' AND kd_produk = '$v'"));
	if ($countSablonKeterangan < 1) {	
		$sablonKeterangan = mysqli_query($link,"INSERT INTO sablon_keterangan (nota, kd_produk, keterangan) VALUES ('$nota', '$v' ,'$keterangan[$k]')") or die (mysqli_error());
	}
}

$nota = base64_encode($nota);
echo "<script>alert('Berhasil Menambahkan Data');
	window.location.href='home.php?act=".md5('sablon_detail')."&nota=$nota';</script>";
?>
