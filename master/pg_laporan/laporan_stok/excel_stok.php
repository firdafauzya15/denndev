<?php
include"../../../lib/koneksi.php";
require '../../../vendor/autoload.php';

if ($_GET['id_toko'] != '') {
  $qToko = "stok.id_toko = $_GET[id_toko]";
}

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

$spreadsheet = new Spreadsheet();
$spreadsheet->getProperties()->setCreator('System')
            ->setLastModifiedBy('System')
            ->setTitle('Data Stock')
            ->setSubject('Data Stok');

$sheet = $spreadsheet->getActiveSheet();
$sheet->getStyle('A1:G3')->getFont()->setBold( true );
$sheet->getStyle('A1:E3')->getAlignment()->setHorizontal('center');

$sheet->mergeCells("A3:A4");
$sheet->mergeCells("B3:B4");
$sheet->mergeCells("C3:C4");
$sheet->mergeCells("D3:D4");

$sheet->setCellValue('A1', 'Data Stok');

$sheet->setCellValue('A3', 'No');
$sheet->setCellValue('B3', 'Toko');
$sheet->setCellValue('C3', 'Kode');
$sheet->setCellValue('D3', 'Nama');
$sheet->setCellValue('E3', 'Warna');

$col='E';
$sql = mysqli_query($link,"SELECT nm_size FROM size ORDER BY id_size ASC") or die (mysqli_error());
$jumlah = mysqli_num_rows($sql);
while ($size = mysqli_fetch_array($sql)) {
  $sheet->setCellValue($col.'4', $size['nm_size']);
  $sheet->getStyle($col.'4')->getFont()->setBold( true );
  $sheet->getStyle($col.'4')->getAlignment()->setHorizontal('center');
  $col++;
}
$sheet->mergeCells("A1:".$col."1");
$sheet->mergeCells("E3:".$col."3");

$i = 1;
$toko = $_GET['id_toko'] != '' ? "WHERE stok.id_toko = $_GET[id_toko]" : "";
$q = mysqli_query($link,"SELECT produk.kd_produk,produk.nm_produk,toko.nm_toko FROM stok INNER JOIN produk_size ON produk_size.kd_produk_size = stok.kd_produk_size INNER JOIN produk ON produk.kd_produk = produk_size.kd_produk INNER JOIN toko ON toko.id_toko = stok.id_toko ".$toko." ORDER BY stok.id_toko, produk.kd_produk ASC") or die (mysqli_error());
while ($r = mysqli_fetch_array($q)) {
  $sheet->setCellValue('A'.($i+4), $i);
  $sheet->setCellValue('B'.($i+4), $r['nm_toko']);
  $sheet->setCellValue('C'.($i+4), $r['kd_produk']);
  $sheet->setCellValue('D'.($i+4), $r['nm_produk']);
  $i++;
}


$spreadsheet->getActiveSheet()->setTitle('Data Stok');
$spreadsheet->setActiveSheetIndex(0);
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Stok Barang Toko'.(($_GET['id_toko'] != "")?$_GET['id_toko'] : "").'.xlsx"');
header('Cache-Control: max-age=0');
$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save('php://output');
?>