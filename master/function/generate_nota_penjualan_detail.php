<?php
/*
mysqli_connect("localhost","root","");
mysqli_select_db("efg_store");

$qB = mysqli_query($link,"SELECT 
		  produk.harga_jual, 
		  penjualan_detail.id_penjualan_detail, 
			penjualan.nota
			FROM 
			penjualan_detail 
			Inner Join penjualan ON penjualan.id_penjualan = penjualan_detail.id_penjualan
			Inner Join produk_size ON produk_size.kd_produk_size = penjualan_detail.kd_produk_size
			Inner Join produk ON produk.kd_produk = produk_size.kd_produk
			") or die (mysqli_error());
while ($rB = mysqli_fetch_array($qB)) 
{
	$Unota = mysqli_query($link,"UPDATE penjualan_detail SET
						nota = '$rB[nota]',
						harga_jual = '$rB[harga_jual]'
						WHERE
						id_penjualan_detail = '$rB[id_penjualan_detail]'
						") or die (mysqli_error());	
}

if ($Unota) 
{
	echo "success";
} 
else 
{
	echo "failed";
}
*/
?>