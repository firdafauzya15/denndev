<?php

$result = mysqli_query($link,"UPDATE
	surat_jalan
	SET
	keterangan = '$_POST[keterangan]'
	WHERE
	id_surat_jalan = '$_POST[id_surat_jalan]'
") or die (mysqli_error());

if ($result) {

	echo "
		<script>
			alert('Berhasil Mengubah Data');
			window.location.href='home.php?act=" . md5('surat_jalan_detail') . "&id_surat_jalan=" . base64_encode($_POST['id_surat_jalan']) . "';
		</script>
	";	

}

?>
