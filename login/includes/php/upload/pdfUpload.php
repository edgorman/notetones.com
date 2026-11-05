<?php
	if (isset($_POST['newFile'])) {	
	    $allowedExts = array("gif","jpeg", "jpg", "png", "pdf");
		$tempImage = explode(".", $_FILES["file"]["name"]);
		$extension = end($tempImage);
		$location = dirname(__FILE__).'/../../../../'.$_POST['directory'];
	
		if(($_FILES["file"]["type"] == "application/pdf") ||
		   (in_array($extension, $allowedExts))){
		   		
			if ($_FILES["file"]["error"] > 0) {
				echo "<script>alert('Error occured, try again!')</script>";
			} else {
				if (file_exists($location . $_FILES["file"]["name"])) {
					echo "<script>alert('". $_FILES["file"]["name"] ." already exists!')</script>";
				} else {
					move_uploaded_file($_FILES["file"]["tmp_name"], $location . $_FILES["file"]["name"]);
					echo "<script>alert('". $_FILES["file"]["name"] ." has been uploaded.')</script>";
					header("Location: ");
				}
			}
		} else {
			echo "<script>alert('Failed to upload')</script>";
		}
	}
?>