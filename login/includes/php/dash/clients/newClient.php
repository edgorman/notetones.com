<?php
    require("../../config.php");
	
	$usernameData = $_POST['username'];
	$passwordData = "55c3b5386c486feb662a0785f340938f518d547f";
	$nicknameData = $_POST['nickname'];
	$tierData = $_POST['tier'];
	$contactData = $_POST['contact'];
	$lockData = $_POST['lock'];
	
	$stmt = $conn -> prepare("INSERT INTO login (username, password, nickname, level, contact, lockState) VALUE(:username, :password, :nickname, :level, :contact, :lock)");
	$stmt -> bindParam(":username", $usernameData);
	$stmt -> bindParam(":password", $passwordData);
	$stmt -> bindParam(":nickname", $nicknameData);
	$stmt -> bindParam(":level", $tierData);
	$stmt -> bindParam(":contact", $contactData);
	$stmt -> bindParam(":lock", $lockData);
	$stmt -> execute();
	
	$stmt = $conn -> prepare("SELECT id FROM login WHERE username= :username AND password= :password AND nickname= :nickname");
	$stmt -> bindParam(":username", $usernameData);
	$stmt -> bindParam(":password", $passwordData);
	$stmt -> bindParam(":nickname", $nicknameData);
	$stmt -> execute();
	$stmt -> bindColumn("id", $idData);
	while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) {}
	
	require(dirname(__FILE__)."/../config.php");
	$startData = date("d/m/Y");
	$completeData = "0";
	
	$stmt = $conn -> prepare("INSERT INTO commission (login_id, s_date, complete) VALUES(:login_id, :s_date, :complete)");
	$stmt -> bindParam(":login_id", $idData);
	$stmt -> bindParam(":s_date", $startData);
	$stmt -> bindParam(":complete", $completeData);
	$stmt -> execute();
?>