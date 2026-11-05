<?php
	if(!isset($_SESSION)) session_start();
    require(dirname(__FILE__)."/../../config.php");
	
	$idData = $_POST['id'];
	$nicknameData = $_POST['nickname'];
	
	$stmt = $conn -> prepare("UPDATE login SET nickname= :nicknameData WHERE id= :idData");
	$stmt -> bindParam(":nicknameData", $nicknameData);
	$stmt -> bindParam(":idData", $idData);
	$stmt -> execute();
	
	require(dirname(__FILE__)."/../../dash/config.php");
	$actionData = "Updated nickname.";
	$actionByData = "Client";
	$timestampData = date("Y-m-d h:i:s");
	$clientSeeData = "0";
	
	$stmtTQ = $conn -> prepare("INSERT INTO prod_log (login_id, action, action_by, timestamp, client_see) VALUES(:loginIdData, :actionData, :actionByData, :timestampData, :clientSeeData)");
	$stmtTQ -> bindParam(":loginIdData", $_SESSION['id']);
	$stmtTQ -> bindParam(":actionData", $actionData);
	$stmtTQ -> bindParam(":actionByData", $actionByData);
	$stmtTQ -> bindParam(":timestampData", $timestampData);
	$stmtTQ -> bindParam(":clientSeeData", $clientSeeData);
	$stmtTQ -> execute();
?>