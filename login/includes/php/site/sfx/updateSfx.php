<?php
    require("../../config.php");
	
	$idData = $_POST['id'];
	$effectData = $_POST['effect'];
	$dateData = $_POST['date'];
	$tagsData = $_POST['tags'];
	$directoryData = $_POST['directory'];
	
	$stmt = $conn -> prepare("UPDATE public_sfx SET effect= :effect, date= :date, tags= :tags, directory= :directory WHERE id= :id");
	$stmt -> bindParam(":effect", $effectData);
	$stmt -> bindParam(":date", $dateData);
	$stmt -> bindParam(":tags", $tagsData);
	$stmt -> bindParam(":directory", $directoryData);
	$stmt -> bindParam(":id", $idData);
	$stmt -> execute();
?>