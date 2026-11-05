<?php
	session_start();
    require(dirname(__FILE__)."/../config.php");
	
	$dayData = $_POST['day'];
	$monthData = $_POST['month'];
	$yearData = $_POST['year'];
	$timeData = $_POST['time'];
	$titleData = $_POST['title'];
	$infoData = $_POST['info'];
	$typeData = $_POST['type'];
	$userData = $_SESSION['id'];
	$dateData = $yearData.'-'.sprintf("%02d", $monthData).'-'.sprintf("%02d", $dayData);
	$uploadData = $_POST['upload'];
	
	$stmt = $conn -> prepare("INSERT INTO calendar (day, month, year, time, title, info, type, user, date, upload) 
	VALUE(:dayData, :monthData, :yearData, :timeData, :titleData, :infoData, :typeData, :userData, :dateData, :uploadData)");
	$stmt -> bindParam(":dayData", $dayData);
	$stmt -> bindParam(":monthData", $monthData);
	$stmt -> bindParam(":yearData", $yearData);
	$stmt -> bindParam(":timeData", $timeData);
	$stmt -> bindParam(":titleData", $titleData);
	$stmt -> bindParam(":infoData", $infoData);
	$stmt -> bindParam(":typeData", $typeData);
	$stmt -> bindParam(":userData", $userData);
	$stmt -> bindParam(":dateData", $dateData);
	$stmt -> bindParam(":uploadData", $uploadData);
	$stmt -> execute();
?>