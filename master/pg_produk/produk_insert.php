<?php
$id_tipe_produk = $_POST['id_tipe_produk'];
$id_brand = $_POST['id_brand'];
$id_pola = $_POST['id_pola'];
$id_model = $_POST['id_model'];
$kd_produk = $_POST['kd_produk'];
$nm_produk = $_POST['nm_produk'];
$harga_modal = $_POST['harga_modal'];

$id_size = $_POST['id_size'];
$harga_jual = $_POST['harga_jual'];

$created_by = $_SESSION['id_user'];
$post_time = date("Y-m-d H:i:s");

$produks =mysqli_num_rows(mysqli_query($link,"SELECT id_produk FROM produk WHERE kd_produk = '$kd_produk'"));
if (mysqli_num_rows($produks) > 0) {

	echo "<script>alert('Gagal, kode produk sudah ada');
			window.location.href='home.php?act=".md5('produk')."';</script>";

} else {
  if ($_FILES['file']['name'] != '') {
		$upload_img = upload_img();
  }  
 
$i = mysqli_query($link,"INSERT INTO produk VALUES ('0','".$_POST['id_tipe_produk']."','".$_POST['id_brand']."','0','".$_POST['id_pola']."','".$_POST['id_model']."','".$_POST['kd_produk']."','".$_POST['nm_produk']."','".(($_POST['harga_modal']=='')?'0':$_POST['harga_modal'])."','".$_POST['harga_jual']."','$upload_img','".$_SESSION['id_user']."','".date("Y-m-d H:i:s")."')") or die (mysqli_error());

	$produkSizeSave = mysqli_query($link,"INSERT INTO produk_size VALUES ('0','".$_POST['kd_produk']."','".$_POST['kd_produk']."','34','".$_POST['harga_jual']."')") or die (mysqli_error());

	echo "<script>alert('Berhasil Menambahkan Data');
			window.location.href='home.php?act=".md5('produk')."';</script>";
}

?>