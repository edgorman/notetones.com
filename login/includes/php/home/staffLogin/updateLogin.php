<?php
    require("../../config.php");
	
	$idData = $_POST['id'];
	$usernameData = $_POST['username'];
	$nicknameData = $_POST['nickname'];
	$levelData = $_POST['level'];
	$contactData = $_POST['contact'];
	$lockData = $_POST['lock'];
	
	$stmt = $conn -> prepare("UPDATE login SET username= :usernameData, nickname= :nicknameData, level= :levelData, contact= :contactData, lockState= :lockData WHERE id= :idData");
	$stmt -> bindParam(":usernameData", $usernameData);
	$stmt -> bindParam(":nicknameData", $nicknameData);
	$stmt -> bindParam(":levelData", $levelData);
	$stmt -> bindParam(":contactData", $contactData);
	$stmt -> bindParam(":lockData", $lockData);
	$stmt -> bindParam(":idData", $idData);
	$stmt -> execute();
	
	$deptData = substr($usernameData, 0, 3);
	$stmt = $conn -> prepare("UPDATE employees SET dept= :deptData WHERE user_id= :idData");
	$stmt -> bindParam(":deptData", $deptData);
	$stmt -> bindParam(":idData", $idData);
	$stmt -> execute();
?>