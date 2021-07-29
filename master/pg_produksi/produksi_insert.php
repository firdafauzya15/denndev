<?php
$nota = $_POST['nota'];
$tanggal = $_POST['tanggal'];
$jatuh_tempo = $_POST['jatuh_tempo'];
$nota_sablon = $_POST['nota_sablon'];
$id_cmt = $_POST['id_cmt'];
$uk_opp = $_POST['uk_opp'];
$uk_pp = $_POST['uk_pp'];
$harga = $_POST['harga'];
$keterangan = $_POST['keterangan'];
$kd_aksesoris = $_POST['kd_aksesoris'];
$jumlah_aksesoris = $_POST['jumlah_aksesoris'];
$created_by = $_SESSION['id_user'];
$post_time = date("Y-m-d H:i:s");

$kd_produk = $_POST['kd_produk'];
$kd_produk_size = $_POST['kd_produk_size'];
$lusin = $_POST['lusin'];
$pcs = $_POST['pcs'];
echo 
$sablon = mysqli_query($link,"SELECT sablon_pengiriman.jumlah + sablon_pengiriman_bs.jumlah as jumlah FROM sablon_pengiriman INNER JOIN sablon_detail on sablon_detail.id_sablon_detail = sablon_pengiriman.id_sablon_detail left join sablon_pengiriman_bs on sablon_pengiriman_bs.id_sablon_detail = sablon_detail.id_sablon_detail  WHERE nota = '$nota_sablon'") or die (mysqli_error());
$row = mysqli_fetch_assoc($sablon);
echo $row['jumlah'];
foreach ($kd_produk as $k => $v) {
	$isi = ($lusin[$k] * 12) + $pcs[$k];
}
if($isi<=$row['jumlah']){


$produksi = mysqli_query($link,"SELECT * FROM produksi WHERE nota = '$nota'") or die (mysqli_error());
if (mysqli_num_rows($produksi) == 0) {
	$i = mysqli_query($link,"INSERT INTO produksi (
			tanggal,
			jatuh_tempo,
			tgl_balikan,
			nota_sablon,
			nota,
			id_cmt,
			uk_opp,
			harga,
			lunas,
			keterangan,
			created_by,
			post_time,
			notes
			)
			VALUES (
			'$tanggal',
			'$jatuh_tempo',
			null,
			'$nota_sablon',
			'$nota',
			'$id_cmt',
			'$uk_opp',
			'$harga',
			'0',
			'$keterangan',
			'$created_by',
			'$post_time',
			'".$_POST['notes']."'	
			)
		") or die (mysqli_error());

	foreach ($kd_produk as $k => $v) {
		# code...
		$jumlah = ($lusin[$k] * 12) + $pcs[$k];
		echo "INSERT INTO produksi_detail (
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
		";
		$iD = mysqli_query($link,"INSERT INTO produksi_detail (
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
	}

	$nota = base64_encode($nota);
	echo "<script>alert('Berhasil Menambahkan Data');
			window.location.href='home.php?act=".md5('produksi_detail')."&nota=$nota';</script>";
} else {
	echo "<script>alert('Gagal, Nota sudah terdaftar');
			window.location.href='home.php?act=".md5('produksi')."';</script>";
}

}else{
	echo "<script>alert('Gagal, Jumlah Qty Lebih Besar dari Balikan Sablon');
			window.location.href='home.php?act=".md5('produksi')."';</script>";
}
?>