<?php
  include "../../../lib/koneksi.php";
  date_default_timezone_set("Asia/Jakarta");
  $now = date("YmdHis");
  header('Content-Type: text/csv; charset=utf-8');  
  header('Content-Disposition: attachment; filename=data_detail_produk_'.$now.'.csv');  
  $output = fopen("php://output", "w");  
  $query = "SELECT * FROM produk_size";  
  $result = mysqli_query($query);  
  while($row = mysqli_fetch_assoc($result))  
  {  
    fputcsv($output, $row);  
  }  
  fclose($output);  
?>