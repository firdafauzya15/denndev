<?php
$id_supplier_bahan = $_POST['id_supplier_bahan'];
$tanggal = $_POST['tanggal'];
$jatuh_tempo = date('Y-m-d', strtotime("+3 months", strtotime($tanggal)));

$id_stok_bahan = $_POST['id_stok_bahan'];
$kd_bahan = $_POST['kd_bahan'];
$jumlah = $_POST['jumlah'];

$created_by = $_SESSION['id_user'];
$post_time = date("Y-m-d H:i:s");

$i = mysqli_query($link,"INSERT INTO retur_bahan (
	tanggal,
	jatuh_tempo,
	id_supplier_bahan,
	created_by,
	post_time
	)
	VALUES (
	'$tanggal',
	'$jatuh_tempo',
	'$id_supplier_bahan',
	'$created_by',
	'$post_time'
	)
") or die (mysqli_error());

$rB = mysqli_fetch_array(mysqli_query($link,"SELECT 
	id_retur_bahan 
	FROM 
	retur_bahan 
	WHERE 
	id_supplier_bahan = '$id_supplier_bahan' 
	AND tanggal = '$tanggal' 
	Order By id_retur_bahan DESC
"));

foreach ($kd_bahan as $k => $v) {
	# code...
	$iD = mysqli_query($link,"INSERT INTO retur_bahan_detail (
		id_retur_bahan,
		id_stok_bahan,
		kd_bahan,
		jumlah
		)
		VALUES (
		'$rB[id_retur_bahan]',
		'$id_stok_bahan[$k]',
		'$v',
		'$jumlah[$k]'
		)
	") or die (mysqli_error());
echo "UPDATE stok_bahan SET
jumlah = jumlah-'$jumlah[$k]'
WHERE
kd_bahan = '$v'
";
$Ustock = mysqli_query($link,"UPDATE stok_bahan SET
	jumlah = jumlah-'$jumlah[$k]'
	WHERE
	kd_bahan = '$v'
") or die (mysqli_error());	

}

$id_retur_bahan = base64_encode($rB['id_retur_bahan']);
echo "<script>alert('Berhasil Menambahkan Data');
		window.location.href='home.php?act=".md5('retur_bahan_detail')."&id_retur_bahan=$id_retur_bahan';</script>";
?>
