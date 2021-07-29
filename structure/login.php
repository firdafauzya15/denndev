<?php
session_start();
include "../lib/koneksi.php";

$username = $_POST["username"];
$password = md5($_POST["password"]);
$sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password' AND status = '1'";
$query = mysqli_query($link,$sql) or die (mysqli_error());
$rLogin = mysqli_fetch_array($query);
$jumuser = mysqli_num_rows($query);

if ($jumuser > 0) {
	$random = rand(111111, 999999);
	$rand_date = date("YmdHis");
	$token = md5($random.$rand_date);
	$u_token = mysqli_query($link,"UPDATE user SET token = '$token' WHERE id_user = '$rLogin[id_user]'") or die (mysqli_error());

	$_SESSION["token"] = $token;
	$_SESSION["name"] = $rLogin["name"];
	$_SESSION["username"] = $rLogin["username"];
	$_SESSION["password"] = $password;
	$_SESSION["id_user"] = $rLogin["id_user"];
	$_SESSION["id_level"] = $rLogin["id_level"];
	if ($_SESSION["id_level"] == '2') {
		$_SESSION["id_toko"] 	= $rLogin["id_toko"];
	}
	header("location:../home.php");

} else {
	echo"<script>alert('Username atau Password yang Anda Input Salah');window.location.href='../index.php';</script>";
}

?>