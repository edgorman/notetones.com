<?php
	session_start();
	$commIdData = $_POST['commId'];
	$nameData = $_POST['name'];
	$statusData = "Planning Phase";
	$startDData = date("Y-m-d");
	$endDData = $_POST['endDate'];
	$clientIData = $_POST['clientInfo'];
	$clientISeenData = "0";
	$updatedData = date("Y-m-d");
	
	require(dirname(__FILE__)."/../config.php");
	$stmt = $conn -> prepare("INSERT INTO tracks (commission_id, name, status, s_date, e_date, client_info, client_info_seen, updated) VALUE(:commIdData, :nameData, :statusData, :startDData, :endDData, :clientIdData, :clientISeenData, :updateData)");
	$stmt -> bindParam(":commIdData", $commIdData);
	$stmt -> bindParam(":nameData", $nameData);
	$stmt -> bindParam(":statusData", $statusData);
	$stmt -> bindParam(":startDData", $startDData);
	$stmt -> bindParam(":endDData", $endDData);
	$stmt -> bindParam(":clientIdData", $clientIData);
	$stmt -> bindParam(":clientISeenData", $clientISeenData);
	$stmt -> bindParam(":updateData", $updatedData);
	$stmt -> execute();
	
	require(dirname(__FILE__)."/../config.php");
	$actionData = "Added Track: ".$nameData;
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