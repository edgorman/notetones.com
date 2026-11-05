<?php
    require("../config.php");
	
	$titleData = $_POST['title'];
	$descData = $_POST['description'];
	$typeData = $_POST['type'];
	$personData = $_POST['person'];
	$currentDate = getdate(date("U"));
	$dateData = $currentDate['weekday'].' '.$currentDate['month'].' '.$currentDate['mday'].', '.$currentDate['year'];
	$destinationData = "staff";
	
	$stmt = $conn -> prepare("INSERT INTO alerts (title, description, type, person, time, destination) VALUE(:titleData, :descData, :typeData, :personData, :timeData, :destData)");
	$stmt -> bindParam(":titleData", $titleData);
	$stmt -> bindParam(":descData", $descData);
	$stmt -> bindParam(":typeData", $typeData);
	$stmt -> bindParam(":personData", $personData);
	$stmt -> bindParam(":timeData", $dateData);
	$stmt -> bindParam(":destData", $destinationData);
	$stmt -> execute();
?>