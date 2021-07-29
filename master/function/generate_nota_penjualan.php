<?php
/*
mysqli_connect("localhost","root","");
mysqli_select_db("efg_store");

$qB = mysqli_query($link,"SELECT 
			id_penjualan,
			tanggal 
			FROM 
			penjualan 
			Order By id_penjualan DESC
			") or die (mysqli_error());
while ($rB = mysqli_fetch_array($qB)) 
{
	$pecah = explode("-", $rB['tanggal']);
	$tahun = $pecah[0];
	$bulan = $pecah[1];
	$hari = $pecah[2];
	$tahun = substr($tahun, -2);
	$nota = "EFG".$hari.$bulan.$tahun.$rB['id_penjualan'];
	$Unota = mysqli_query($link,"UPDATE penjualan SET
						nota = '$nota'
						WHERE
						id_penjualan = '$rB[id_penjualan]'
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