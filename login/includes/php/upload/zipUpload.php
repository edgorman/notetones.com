<?php
	if (isset($_POST['newZip'])) {	
	    $allowedExts = array("zip");
		$tempImage = explode(".", $_FILES["file"]["name"]);
		$extension = end($tempImage);
		$location = dirname(__FILE__).'/../../../../'.$_POST['directory'];
	
		if(($_FILES["file"]["type"] == "application/zip") || 
		   ($_FILES["file"]["type"] == "application/octet-stream") ||
		   (in_array($extension, $allowedExts))){
		   		
			if ($_FILES["file"]["error"] > 0) {
				echo "<script>alert('Error occured, try again!')</script>";
			} else {
				$randomFName = md5(uniqid(rand(), true)).".zip";
				
				if (file_exists($location . $randomFName)) {
					echo "<script>alert('Wow theres another file with that name, thats like one in a million chance... jus try upload again.')</script>";
				} else {
					move_uploaded_file($_FILES["file"]["tmp_name"], $location . $randomFName);
					echo "<script>alert('Uploaded .zip file for client, new file name: ". $randomFName ."')</script>";
					header("Location: ");
				}
			}
		} else {
			echo "<script>alert('Failed to upload')</script>";
		}
	}
?>