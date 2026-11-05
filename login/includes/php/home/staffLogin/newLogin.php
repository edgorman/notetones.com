<?php
    require("../../config.php");
	
	$idData = $_POST['id'];
	$usernameData = $_POST['username'];
	$passwordData = "55c3b5386c486feb662a0785f340938f518d547f";
	$nicknameData = $_POST['nickname'];
	$levelData = $_POST['level'];
	$contactData = $_POST['contact'];
	$lockData = $_POST['lock'];
	
	$stmt = $conn -> prepare("INSERT INTO login (username, password, nickname, level, status, contact, lockState) VALUE(:usernameData, :passwordData, :nicknameData, :levelData, '0', :contactData, :lockData)");
	$stmt -> bindParam(":usernameData", $usernameData);
	$stmt -> bindParam(":passwordData", $passwordData);
	$stmt -> bindParam(":nicknameData", $nicknameData);
	$stmt -> bindParam(":levelData", $levelData);
	$stmt -> bindParam(":contactData", $contactData);
	$stmt -> bindParam(":lockData", $lockData);
	$stmt -> execute();
	
	$deptData = substr($usernameData, 0, 3);
	$stmt = $conn -> prepare("INSERT INTO employees (user_id, name, title, img, dept, torder, email) VALUE(:idData, :nicknameData, ' ', 'Ashe.jpg', :deptData, '999', :contactData)");
	$stmt -> bindParam(":idData", $idData);
	$stmt -> bindParam(":nicknameData", $nicknameData);
	$stmt -> bindParam(":deptData", $deptData);
	$stmt -> bindParam(":contactData", $contactData);
	$stmt -> execute();
?>