<?php
include"lib/koneksi.php";
include"lib/Library.php";
include"master/function/func_upload.php";
include"master/function/convert_number.php";
include"master/function/tanggal_indo.php";
$lib = new Library();
date_default_timezone_set("Asia/Jakarta");
error_reporting(0);
session_start();
ob_start();
if (isset($_SESSION['username']) AND isset($_SESSION['id_user'])) {

  $Auth_token = mysqli_query($link,"SELECT id_user FROM user WHERE token = '$_SESSION[token]' and id_user = '$_SESSION[id_user]'") or die (mysqli_error());
  $Count_Auth = mysqli_num_rows($Auth_token);
  if ($Count_Auth > 0) {
  } else {
    header("location:index.php");
  }
} else {
  header("location:index.php");
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="Willys">
    <title>DennDev | Dashboard</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="shortcut icon" href="dist/img/favicon.png">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="plugins/fontawesome/pro/css/all.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker-bs3.css">
    <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <link rel="stylesheet" href="css/jquery-ui.css" >
    <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="plugins/select2/select2.min.css">
    <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
    <link rel="stylesheet" href="plugins/summernote/summernote.css"/>
    <script src="plugins/js/jquery.min.js"></script>
  </head>