<?php
function upload_img() {

	$code = date("YmdHis");
	$rand = rand(111111,999999);
	$img = str_replace(' ', '-', $_FILES['file']['name']);
	$image_name = $code.$rand.$img;

	// Access the $_FILES global variable for this specific file being uploaded
	// and create local PHP variables from the $_FILES array of information
	$fileName = $image_name; // The file name
	$fileName_resized = "RTL_".$image_name; // The file name
	$fileTmpLoc = $_FILES["file"]["tmp_name"]; // File in the PHP tmp folder
	$fileType = $_FILES["file"]["type"]; // The type of file it is
	$fileSize = $_FILES["file"]["size"]; // File size in bytes
	$fileErrorMsg = $_FILES["file"]["error"]; // 0 for false... and 1 for true
	$kaboom = explode(".", $fileName); // Split file name into an array using the dot
	$fileExt = end($kaboom); // Now target the last array element to get the file extension
	// START PHP Image Upload Error Handling --------------------------------------------------
	if($fileSize > 200000) { // if file size is larger than 5 Megabytes

		// END PHP Image Upload Error Handling ----------------------------------------------------
		// Place it into your "uploads" folder mow using the move_uploaded_file() function
		$moveResult = move_uploaded_file($fileTmpLoc, "./upload/$fileName");
		// Check to make sure the move result is true before continuing
		if ($moveResult != true) {
		    echo "ERROR: File not uploaded. Try again.";
		    unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
		    exit();
		}
		unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
		// ---------- Include Universal Image Resizing Function --------
		include_once("./lib/resize_image/ak_php_img_lib_1.0.php");
		$target_file = "./upload/$fileName";
		$resized_file = "./upload/$fileName_resized";
		$wmax = 700;
		$hmax = 700;
		ak_img_resize($target_file, $resized_file, $wmax, $hmax, $fileExt);
		unlink("./upload/$fileName"); // Remove the uploaded file from the PHP temp folder
		// ----------- End Universal Image Resizing Function -----------		
		return $fileName_resized;

	} else {

		$moveResult = move_uploaded_file($fileTmpLoc, "./upload/$image_name");
		return $image_name;

	}	
}
?>