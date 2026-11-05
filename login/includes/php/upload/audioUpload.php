<?php
	if (isset($_POST['newAudio'])) {
	    $allowedExts = array("mp3", "wav");
		$tempImage = explode(".", $_FILES["file"]["name"]);
		$extension = end($tempImage);
		$location = dirname(__FILE__).'/../../../../'.$_POST['directory'];
		
		if(($_FILES["file"]["type"] == "audio/mpeg") ||
		   ($_FILES["file"]["type"] == "audio/x-mpeg") ||
		   ($_FILES["file"]["type"] == "audio/mp3") ||
		   ($_FILES["file"]["type"] == "audio/x-mp3") ||
		   ($_FILES["file"]["type"] == "audio/mpeg3") ||
		   ($_FILES["file"]["type"] == "audio/x-mpeg3") ||
		   ($_FILES["file"]["type"] == "audio/mpg") ||
		   ($_FILES["file"]["type"] == "audio/x-mpg") ||
		   ($_FILES["file"]["type"] == "audio/x-mpegaudio") ||
		   ($_FILES["file"]["type"] == "audio/wav") ||
		   (in_array($extension, $allowedExts))){
		   		
			if ($_FILES["file"]["error"] > 0) {
				echo "<script>alert('Error occured, try again!')</script>";
			} else {
				if (file_exists($location . $_FILES["file"]["name"])) {
					echo "<script>alert('". $_FILES["file"]["name"] ." already exists!')</script>";
				} else {
					move_uploaded_file($_FILES["file"]["tmp_name"], $location . $_FILES["file"]["name"]);
					echo "<script>alert('". $_FILES["file"]["name"] ." has been uploaded.')</script>";
				}
			}
		} else {
			echo "<script>alert('Failed to upload')</script>";
		}
	}
?>