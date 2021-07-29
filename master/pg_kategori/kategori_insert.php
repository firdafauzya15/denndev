<?php
	$nm_kategori = $_POST['nm_kategori'];

	$id_size = $_POST['id_size'];

	$created_by = $_SESSION['id_user'];
	$post_time = date("Y-m-d H:i:s");

	$i = mysqli_query($link,"INSERT INTO kategori (
																				nm_kategori,
																				created_by,
																				post_time
																				)
																VALUES (
																				'$nm_kategori',
																				'$created_by',
																				'$post_time'
																				)
									") or die (mysqli_error());

	$rK = mysqli_fetch_array(mysqli_query($link,"SELECT 
				id_kategori 
				FROM 
				kategori 
				WHERE 
				nm_kategori = '$nm_kategori'  
				Order By id_kategori DESC"));

	foreach ($id_size as $k => $v) {
		# code...
		$iD = mysqli_query($link,"INSERT INTO kategori_size (
																					id_kategori,
																					id_size
																					)
																	VALUES (
																					'$rK[id_kategori]',
																					'$v'
																					)
										") or die (mysqli_error());
	}

	echo "<script>alert('Berhasil Menambahkan Data');
			window.location.href='home.php?act=".md5('kategori')."';</script>";
?>
