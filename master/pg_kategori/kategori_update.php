<?php
	$id_size = $_POST['id_size'];

	$u = mysqli_query($link,"UPDATE kategori SET nm_kategori = '".$_POST['nm_kategori']."' WHERE id_kategori = '".$_POST['id_kategori']."' ") or die (mysqli_error());
	
	$arr_query = [];

	foreach ($id_size as $k => $v) {
    	$cKS = mysqli_num_rows(mysqli_query($link,"SELECT * FROM kategori_size WHERE id_size = '$v' AND id_kategori = '".$_POST['id_kategori']."'")); 
    	if ($cKS > 0) {
   	 	} else {
			$iD = mysqli_query($link,"INSERT INTO kategori_size (id_kategori,id_size)VALUES ('".$_POST['id_kategori']."','$v')") or die (mysqli_error());
		}
		$arr_query[] = "(id_size != '$v' AND id_kategori = '".$_POST['id_kategori']."')";
	}
	$query = implode(' AND ',$arr_query);
	$del = mysqli_query($link,"DELETE FROM kategori_size WHERE $query") or die (mysqli_error());

	echo "<script>alert('Berhasil Mengubah Data');
			window.location.href='home.php?act=".md5('kategori')."';</script>";
?>
