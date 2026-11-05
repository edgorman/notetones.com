<?php
	$nameData = $_POST['name'];
	$loginIdData = $_POST['login'];
	$statusData = $_POST['status'];
	$startDData = date("Y-m-d");
	$eDData = $_POST['eDate'];
	$downloadData = $_POST['download'];
	$updatedData = date("Y-m-d");
	
	require(dirname(__FILE__)."/../config.php");
	$stmt = $conn -> prepare("SELECT id FROM commission WHERE login_id= :id");
	$stmt -> bindParam(":id", $loginIdData);
	$stmt -> execute();
	$stmt -> bindColumn("id", $commIdData);
	while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) {}
	
	require(dirname(__FILE__)."/../config.php");
	$stmt = $conn -> prepare("INSERT INTO tracks (commission_id, name, status, s_date, e_date, download, updated) VALUE(:comm, :name, :status, :s_date, :e_date, :download, :updated)");
	$stmt -> bindParam(":comm", $commIdData);
	$stmt -> bindParam(":name", $nameData);
	$stmt -> bindParam(":status", $statusData);
	$stmt -> bindParam(":s_date", $sDData);
	$stmt -> bindParam(":e_date", $eDData);
	$stmt -> bindParam(":download", $downloadData);
	$stmt -> bindParam(":updated", $updatedData);
	$stmt -> execute();
	
	require(dirname(__FILE__)."/../config.php");
	$actionData = "Added Track: ".$nameData;
	$actionByData = "Staff";
	$timestampData = date("Y-m-d h:i:s");
	$clientSeeData = "1";
	
	$stmtTQ = $conn -> prepare("INSERT INTO prod_log (login_id, action, action_by, timestamp, client_see) VALUES(:loginIdData, :actionData, :actionByData, :timestampData, :clientSeeData)");
	$stmtTQ -> bindParam(":loginIdData", $loginIdData);
	$stmtTQ -> bindParam(":actionData", $actionData);
	$stmtTQ -> bindParam(":actionByData", $actionByData);
	$stmtTQ -> bindParam(":timestampData", $timestampData);
	$stmtTQ -> bindParam(":clientSeeData", $clientSeeData);
	$stmtTQ -> execute();
?>