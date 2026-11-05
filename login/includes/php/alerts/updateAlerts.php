<?php
    require("../config.php");
	
	$idData = $_POST['id'];
	$titleData = $_POST['title'];
	$descData = $_POST['description'];
	$typeData = $_POST['type'];
	$personData = $_POST['person'];
	$currentDate = getdate(date("U"));
	$dateData = $currentDate['weekday'].' '.$currentDate['month'].' '.$currentDate['mday'].', '.$currentDate['year'];
	
	$stmt = $conn -> prepare("UPDATE alerts SET title= :titleData, description= :descData, type= :typeData, person= :personData, time= :timeData WHERE id= :idData");
	$stmt -> bindParam(":idData", $idData);
	$stmt -> bindParam(":titleData", $titleData);
	$stmt -> bindParam(":descData", $descData);
	$stmt -> bindParam(":typeData", $typeData);
	$stmt -> bindParam(":personData", $personData);
	$stmt -> bindParam(":timeData", $dateData);
	$stmt -> execute();
?>