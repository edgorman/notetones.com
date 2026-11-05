<?php
    require(dirname(__FILE__)."/../config.php");
	$idData = $_POST['id'];
	$staffIData = $_POST['staff'];
	$updatedData = date("Y-m-d");
	
	$stmt = $conn -> prepare("UPDATE tracks SET staff_info= :staff_info WHERE id= :id");
	$stmt -> bindParam(":staff_info", $staffIData);
	$stmt -> bindParam(":id", $idData);
	$stmt -> execute();
	
	require(dirname(__FILE__)."/../config.php");
	$stmtHalf = $conn -> prepare("SELECT name, commission_id FROM tracks WHERE id= :id");
	$stmtHalf -> bindParam(":id", $idData);
	$stmtHalf -> execute();
	$stmtHalf -> bindColumn("name", $nameData);
	$stmtHalf -> bindColumn("commission_id", $commIdData);
	while ($row = $stmtHalf -> fetch(PDO::FETCH_BOUND)) {}
	
	require(dirname(__FILE__)."/../config.php");
	$stmtHalf = $conn -> prepare("SELECT login_id FROM commission WHERE id= :id");
	$stmtHalf -> bindParam(":id", $commIdData);
	$stmtHalf -> execute();
	$stmtHalf -> bindColumn("login_id", $loginIdData);
	while ($row = $stmtHalf -> fetch(PDO::FETCH_BOUND)) {}
	
	require(dirname(__FILE__)."/../config.php");
	$actionData = "Updated Track: ".$nameData;
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