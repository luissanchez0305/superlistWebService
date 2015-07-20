<?php
   	//print_r($_FILES);
   	$new_image_name = generateRandomString(rand(7, 10)) . ".jpg";
   	move_uploaded_file($_FILES["file"]["tmp_name"], str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']) . "/uploads/users/".$new_image_name);
	echo $new_image_name;
	function generateRandomString($length = 10) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}
?>