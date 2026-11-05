<?php
	session_start();
    require(dirname(__FILE__)."/../config.php");
	
	$idData = $_POST['id'];
	$dayData = $_POST['day'];
	$monthData = $_POST['month'];
	$yearData = $_POST['year'];
	$timeData = $_POST['time'];
	$titleData = $_POST['title'];
	$infoData = $_POST['info'];
	$typeData = $_POST['type'];
	$userData = $_SESSION['id'];
	$dateData = date("Y-m-d");
	$uploadData = $_POST['upload'];
	
	$stmt = $conn -> prepare("UPDATE calendar SET day= :dayData, month= :monthData, year= :yearData, time= :timeData, title= :titleData, info= :infoData, type= :typeData, user= :userData, date= :dateData, upload= :uploadData WHERE id= :idData");
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
	$stmt -> bindParam(":idData", $idData);
	$stmt -> execute();
?>