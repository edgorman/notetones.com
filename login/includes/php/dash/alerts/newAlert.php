<?php
    require("../../config.php");
	
	$titleData = $_POST['title'];
	$descData = $_POST['description'];
	$typeData = $_POST['type'];
	$destinationData = $_POST['destination'];
	$personData = $_POST['person'];
	$currentDate = getdate(date("U"));
	$dateData = $currentDate['weekday'].' '.$currentDate['month'].' '.$currentDate['mday'].', '.$currentDate['year'];
	
	$stmt = $conn -> prepare("INSERT INTO alerts (title, description, type, person, time, destination) VALUE(:title, :description, :type, :person, :time, :destination)");
	$stmt -> bindParam(":title", $titleData);
	$stmt -> bindParam(":description", $descData);
	$stmt -> bindParam(":type", $typeData);
	$stmt -> bindParam(":person", $personData);
	$stmt -> bindParam(":time", $dateData);
	$stmt -> bindParam(":destination", $destinationData);
	$stmt -> execute();
?>