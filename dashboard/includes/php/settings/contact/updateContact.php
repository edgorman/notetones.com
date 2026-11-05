<?php
	if(!isset($_SESSION)) session_start();
    require(dirname(__FILE__)."/../../config.php");
	
	$idData = $_POST['id'];
	$emailData = $_POST['email'];
	
	$stmt = $conn -> prepare("UPDATE login SET contact= :contactData WHERE id= :idData");
	$stmt -> bindParam(":contactData", $emailData);
	$stmt -> bindParam(":idData", $idData);
	$stmt -> execute();
	
	require(dirname(__FILE__)."/../../dash/config.php");
	$actionData = "Updated contact details.";
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