<?php
$id_brand = $_POST['id_brand'];
$id_produk = $_POST['id_produk'];
$id_kategori = $_POST['id_kategori'];
$id_pola = $_POST['id_pola'];
$kd_produk = $_POST['kd_produk'];
$kd_produk_lama = $_POST['kd_produk_lama'];
$nm_produk = $_POST['nm_produk'];

$id_produk_size = $_POST['id_produk_size'];
$harga_jual = $_POST['harga_jual'];

$c = mysqli_num_rows(mysqli_query($link,"SELECT id_produk FROM produk WHERE kd_produk = '$kd_produk' AND kd_produk != '$kd_produk_lama'"));
if ($c > 0) {

	echo "<script>alert('Gagal Menyimpan, Kode Produk sudah ada, harap ganti kode produk!');
			window.location.href='home.php?act=".md5('produk_add')."';</script>";

} else {

	if ($_FILES['file']['name'] == "") {
		$upload_img = $_POST['file_lama'];
	} else {
		$upload_img = upload_img();
		unlink("./upload/$_POST[file_lama]");
	}

	if ($_SESSION['id_level'] == 9 OR $_SESSION['id_level'] == 11) {

		$u = mysqli_query($link,"UPDATE produk SET
											file = '$upload_img'
											WHERE
											id_produk = '$id_produk'
											") or die (mysqli_error());

	} else {

		$u = mysqli_query($link,"UPDATE produk SET
											id_brand = '$id_brand',
											id_kategori = '$id_kategori',
											id_pola = '$id_pola',
											kd_produk = '$kd_produk',
											nm_produk = '$nm_produk',
											file = '$upload_img'
											WHERE
											id_produk = '$id_produk'
											") or die (mysqli_error());

	}

	foreach ($id_produk_size as $key => $value) {

		$produkSizeSave = mysqli_query($link,"UPDATE
			produk_size
			SET 
			harga_jual = '$harga_jual[$key]'
			WHERE 
			id_produk_size = '$value'
			") or die (mysqli_error());

	}

	echo "<script>alert('Berhasil Mengubah Data');
			window.location.href='home.php?act=".md5('produk')."';</script>";
}
?>
