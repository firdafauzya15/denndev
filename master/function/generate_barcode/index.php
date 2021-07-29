<?php
$qty = $_POST['qty'];
$kd_produk_size = $_POST['kd_produk_size'];

if (isset($kd_produk_size)) {
	//stay here
} else {
  header("location:../../../home.php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Barcode <?= $kd_produk_size;?></title>
</head>
<body onload="window.print()">
	<center>
	<?php
	for ( $i = 0; $i < $qty; $i++ ) {
	?>
		<img alt="testing" src="barcode.php?text=<?= $kd_produk_size;?>&size=50" />
		<br>
		<br>
		<br>
	<?php
	}
	?>
	</center>
</body>
</html>