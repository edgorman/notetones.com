<?php
    require("../../config.php");
	
	$effectData = $_POST['effect'];
	$dateData = $_POST['date'];
	$tagsData = $_POST['tags'];
	$directoryData = $_POST['directory'];
	
	$stmt = $conn -> prepare("INSERT INTO public_sfx (effect, date, tags, directory) VALUE(:effect, :date, :tags, :directory)");
	$stmt -> bindParam(":effect", $effectData);
	$stmt -> bindParam(":date", $dateData);
	$stmt -> bindParam(":tags", $tagsData);
	$stmt -> bindParam(":directory", $directoryData);
	$stmt -> execute();
	
?>