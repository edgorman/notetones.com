<?php
    require("../../config.php");
	
	$idData = $_POST['id'];
	$usernameData = $_POST['username'];
	$nicknameData = $_POST['nickname'];
	$tierData = $_POST['tier'];
	$contactData = $_POST['contact'];
	$lockData = $_POST['lock'];
	
	$stmt = $conn -> prepare("UPDATE login SET username= :username, nickname= :nickname, level= :level, contact= :contact, lockState= :lock WHERE id= :id");
	$stmt -> bindParam(":username", $usernameData);
	$stmt -> bindParam(":id", $idData);
	$stmt -> bindParam(":nickname", $nicknameData);
	$stmt -> bindParam(":level", $tierData);
	$stmt -> bindParam(":contact", $contactData);
	$stmt -> bindParam(":lock", $lockData);
	$stmt -> execute();
?>