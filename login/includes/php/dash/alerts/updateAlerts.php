<?php
    require("../../config.php");
	
	$idData = $_POST['id'];
	$titleData = $_POST['title'];
	$descData = $_POST['description'];
	$typeData = $_POST['type'];
	$destinationData = $_POST['destination'];
	$personData = $_POST['person'];
	$currentDate = getdate(date("U"));
	$dateData = $currentDate['weekday'].' '.$currentDate['month'].' '.$currentDate['mday'].', '.$currentDate['year'];
	
	$stmt = $conn -> prepare("UPDATE alerts SET title= :title, description= :description, type= :type, person= :person, time= :time, destination= :destination WHERE id= :id");
	$stmt -> bindParam(":title", $titleData);
	$stmt -> bindParam(":description", $descData);
	$stmt -> bindParam(":type", $typeData);
	$stmt -> bindParam(":person", $personData);
	$stmt -> bindParam(":time", $dateData);
	$stmt -> bindParam(":destination", $destinationData);
	$stmt -> bindParam(":id", $idData);
	$stmt -> execute();
?>