<?php
 // include db connect class
include "koneksi.php";
date_default_timezone_set("Asia/Jakarta");
$s = "SELECT 
	  penjualan.nota, 
	  penjualan.id_toko,  
	  penjualan.tanggal, 
	  penjualan.status, 
	  toko.nm_toko
	  FROM 
	  penjualan 
	  Inner Join toko ON toko.id_toko = penjualan.id_toko 
	  penjualan.online = '1'
	  ";
$q = mysqli_query($s);
while ($r = mysqli_fetch_array($q)) {
	$curr_time = date("Y-m-d H:i:s");
	$post_time = $r['tanggal']." 00:00:00";
	$after_1_day = date('Y-m-d H:i:s',strtotime('+1 days',strtotime($post_time)));
	if ($curr_time > $after_1_day AND $r['status'] == '0')  {
		$qB = mysqli_query($link,"SELECT * FROM penjualan_detail WHERE nota = '$r[nota]'") or die (mysqli_error());
		while ($rB = mysqli_fetch_array($qB)) {
			$Ustock = mysqli_query($link,"UPDATE stok SET
								jumlah = jumlah+'$rB[jumlah]'
								WHERE
								id_toko = '$r[id_toko]'
								AND kd_produk_size = '$rB[kd_produk_size]'
								") or die (mysqli_error());	
		}
		$h = mysqli_query($link,"DELETE FROM penjualan WHERE nota = '$r[nota]'");
		$h2 = mysqli_query($link,"DELETE FROM penjualan_detail WHERE nota = '$r[nota]'");
		echo "success";
	} 
}
?>