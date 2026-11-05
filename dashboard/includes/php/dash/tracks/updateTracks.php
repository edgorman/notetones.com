<?php
	session_start();
	$idData = $_POST['id'];
	$nameData = $_POST['name'];
	$descData = $_POST['desc'];
	$eDData = $_POST['eDate'];
	$clientISeenData = "0";
	$updatedData = date("Y-m-d");
	
	require(dirname(__FILE__)."/../config.php");
	$stmt = $conn -> prepare("UPDATE tracks SET name= :name, e_date= :e_date, client_info= :client_info, client_info_seen= :client_info_seen, updated= :updated WHERE id= :id");
	$stmt -> bindParam(":name", $nameData);
	$stmt -> bindParam(":e_date", $eDData);
	$stmt -> bindParam(":client_info", $descData);
	$stmt -> bindParam(":client_info_seen", $clientISeenData);
	$stmt -> bindParam(":updated", $updatedData);
	$stmt -> bindParam(":id", $idData);
	$stmt -> execute();
	
	require(dirname(__FILE__)."/../config.php");
	$actionData = "Update Track: ".$nameData;
	$actionByData = "Client";
	$timestampData = date("Y-m-d h:i:s");
	$clientSeeData = "1";
	
	$stmtTQ = $conn -> prepare("INSERT INTO prod_log (login_id, action, action_by, timestamp, client_see) VALUES(:loginIdData, :actionData, :actionByData, :timestampData, :clientSeeData)");
	$stmtTQ -> bindParam(":loginIdData", $_SESSION['id']);
	$stmtTQ -> bindParam(":actionData", $actionData);
	$stmtTQ -> bindParam(":actionByData", $actionByData);
	$stmtTQ -> bindParam(":timestampData", $timestampData);
	$stmtTQ -> bindParam(":clientSeeData", $clientSeeData);
	$stmtTQ -> execute();
?>