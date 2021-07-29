<?php
function tanggalIndo($tanggal) {
	$day = date('D', strtotime($tanggal));
	$dayList = array(
		'Sun' => 'Minggu',
		'Mon' => 'Senin',
		'Tue' => 'Selasa',
		'Wed' => 'Rabu',
		'Thu' => 'Kamis',
		'Fri' => 'Jumat',
		'Sat' => 'Sabtu'
	);
	return $dayList[$day];
}

function bulanIndo($tanggal = null) {
	$month = date('m', strtotime($tanggal));
	$monthList = array(
		'01' => 'Januari',
		'02' => 'Februari',
		'03' => 'Maret',
		'04' => 'April',
		'05' => 'Mei',
		'06' => 'Juni',
		'07' => 'Juli',
		'08' => 'Agustus',
		'09' => 'September',
		'10' => 'Oktober',
		'11' => 'November',
		'12' => 'Desember'
	);
	if ($tanggal != null) {
		return $monthList[$month];
	} else {
		return $monthList;
	}
}

function tanggalOnly($tanggal) {
	$date = explode("-", $tanggal);
	$result = $date[2];
	return $result;
}

function bulanOnly($tanggal) {
	$date = explode("-", $tanggal);
	$result = $date[1];
	return $result;
}

function tahunOnly($tanggal) {
	$date = explode("-", $tanggal);
	$result = $date[0];
	return $result;
}
?>