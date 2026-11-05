<?php
	$idData = $_POST['id'];
	
	require(dirname(__FILE__)."/../config.php");
	$stmt = $conn -> prepare("SELECT commission_id, name FROM tracks WHERE id= :id");
	$stmt -> bindParam(":id", $idData);
	$stmt -> execute();
	$stmt -> bindColumn("commission_id", $commIdData);
	$stmt -> bindColumn("name", $nameData);
	while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) {}
	
	require(dirname(__FILE__)."/../config.php");
	$stmt = $conn -> prepare("SELECT login_id FROM commission WHERE id= :id");
	$stmt -> bindParam(":id", $commIdData);
	$stmt -> execute();
	$stmt -> bindColumn("login_id", $loginIdData);
	while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) {}
	
	require(dirname(__FILE__)."/../config.php");
	$actionData = "Deleted Track: ".$nameData;
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
	
	require(dirname(__FILE__)."/../config.php");
	$stmt = $conn -> prepare("DELETE FROM producers WHERE track_id= :id");
	$stmt -> bindParam(":id", $idData);
	$stmt -> execute();
	
	require(dirname(__FILE__)."/../config.php");
	$stmt = $conn -> prepare("DELETE FROM tracks WHERE id= :id");
	$stmt -> bindParam(":id", $idData);
	$stmt -> execute();
?>