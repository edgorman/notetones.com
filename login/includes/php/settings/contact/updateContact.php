<?php
    require(dirname(__FILE__)."/../../config.php");
	
	$idData = $_POST['id'];
	$emailData = $_POST['email'];
	$twitterData = $_POST['twitter'];
	$linkedinData = $_POST['linkedin'];
	$soundcloudData = $_POST['soundcloud'];
	$aboutData = stripslashes($_POST['about']);
	
	$stmt = $conn -> prepare('UPDATE employees SET email= :emailData, twitter= :twitterData, linkedin= :linkedinData, soundcloud= :soundcloudData, about= :aboutData WHERE user_id= :idData');
	$stmt -> bindParam(":emailData", $emailData);
	$stmt -> bindParam(":twitterData", $twitterData);
	$stmt -> bindParam(":linkedinData", $linkedinData);
	$stmt -> bindParam(":soundcloudData", $soundcloudData);
	$stmt -> bindParam(":aboutData", $aboutData);
	$stmt -> bindParam(":idData", $idData);
	$stmt -> execute();
	
	$stmt = $conn -> prepare("UPDATE login SET contact= :emailData WHERE id= :idData");
	$stmt -> bindParam(":emailData", $emailData);
	$stmt -> bindParam(":idData", $idData);
	$stmt -> execute();
?>