<?php

function notaBarangMasuk($id) {
	$number = str_pad($id, 6, "0", STR_PAD_LEFT);
	$nota = "BL".$number;
	return $nota;
}

function notaSuratJalan($id) {
	$number = str_pad($id, 6, "0", STR_PAD_LEFT);
	$nota = "TR".$number;
	return $nota;
}

function notaPembelianBahan($id) {
	$number = str_pad($id, 6, "0", STR_PAD_LEFT);
	$nota = "PB".$number;
	return $nota;
}

function notaReturBahan($id) {
	$number = str_pad($id, 6, "0", STR_PAD_LEFT);
	$nota = "RB".$number;
	return $nota;
}

?>