<?php
include "../lib/koneksi.php";
$_POST = json_decode(file_get_contents('php://input'),true); 
 
$username = $_POST["username"];
$password = md5($_POST["password"]);
//$username = "pmo";
//$password = md5("pmo");

$response = array();
$logins = mysqli_query($link,"SELECT 
    user.id_user, 
    toko.nm_toko 
    FROM 
    user 
    INNER JOIN toko ON toko.id_toko = user.id_toko
    WHERE 
    username = '$username'
    AND password = '$password'
    ") or die(mysqli_error());
$login = mysqli_fetch_array($logins);     

if (mysqli_num_rows($logins) > 0) {

    $response["id_user"] = $login['id_user'];
    $response["nama_toko"] = $login["nm_toko"];
    $response["isSuccess"] = 1;
    $response["message"] = "Berhasil Login.";
    echo json_encode($response);

} else {

    $response["isSuccess"] = 0;
    $response["message"] = "Oops! An error occurred."; 
    echo json_encode($response);

}
?>