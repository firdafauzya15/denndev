<?php
	$id_produk = base64_decode($_GET['id_produk']);

	$r = mysqli_fetch_array(mysqli_query($link,"SELECT file, kd_produk FROM produk WHERE id_produk = '$id_produk'"));
	$qS = mysqli_query($link,"SELECT kd_produk_size FROM produk_size WHERE kd_produk = '$r[kd_produk]'") or die (mysqli_error());

	while ($rS = mysqli_fetch_array($qS)) {

    $rB = mysqli_fetch_array(mysqli_query($link,"SELECT 
          barang_masuk.id_barang_masuk, 
          FROM 
          barang_masuk 
          Inner Join barang_masuk_detail ON barang_masuk_detail.id_barang_masuk = barang_masuk.id_barang_masuk 
          WHERE
          barang_masuk.kd_produk_size = '$rS[kd_produk_size]'
          "));

    $rP = mysqli_fetch_array(mysqli_query($link,"SELECT 
          penjualan.id_penjualan, 
          FROM 
          penjualan 
          Inner Join penjualan_detail ON penjualan_detail.id_penjualan = penjualan.id_penjualan 
          WHERE
          penjualan.kd_produk_size = '$rS[kd_produk_size]'
          "));

		$h6 = mysqli_query($link,"DELETE FROM barang_masuk WHERE id_barang_masuk = '$rB[id_barang_masuk]'") or die (mysqli_error());
		$h7 = mysqli_query($link,"DELETE FROM penjualan WHERE id_penjualan = '$rB[id_penjualan]'") or die (mysqli_error());
		$h4 = mysqli_query($link,"DELETE FROM barang_masuk_detail WHERE kd_produk_size = '$rS[kd_produk_size]'") or die (mysqli_error());
		$h5 = mysqli_query($link,"DELETE FROM penjualan_detail WHERE kd_produk_size = '$rS[kd_produk_size]'") or die (mysqli_error());
		$h3 = mysqli_query($link,"DELETE FROM stok WHERE kd_produk_size = '$rS[kd_produk_size]'") or die (mysqli_error());
		
	}
	
	unlink("./upload/$r[file]"); // Remove the uploaded file from the PHP temp folder
	$h = mysqli_query($link,"DELETE FROM produk WHERE id_produk = '$id_produk'") or die (mysqli_error());
	$h2 = mysqli_query($link,"DELETE FROM produk_size WHERE kd_produk = '$r[kd_produk]'") or die (mysqli_error());
	
	echo "<script>alert('Berhasil Menghapus Data');
		window.location.href='home.php?act=".md5('produk')."';</script>"; 
	
?>