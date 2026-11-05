<?php
	$trackData = $_POST['track'];
	$producerData = $_POST['producer'];
	$timeData = $_POST['time'];
	$updatedData = date("Y-m-d");
	
	require(dirname(__FILE__)."/../config.php");
	$stmt = $conn -> prepare("SELECT commission_id, name FROM tracks WHERE id= :track_id");
	$stmt -> bindParam(":track_id", $trackData);
	$stmt -> execute();
	$stmt -> bindColumn("name", $nameData);
	$stmt -> bindColumn("commission_id", $commIdData);
	while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) {}
	
	require(dirname(__FILE__)."/../config.php");
	$stmt = $conn -> prepare("SELECT login_id FROM commission WHERE id= :commission_id");
	$stmt -> bindParam(":commission_id", $commIdData);
	$stmt -> execute();
	$stmt -> bindColumn("login_id", $loginIdData);
	while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) {}
	
	require(dirname(__FILE__)."/../config.php");
	$stmt = $conn -> prepare("INSERT INTO producers (track_id, producer, time_spent) VALUE(:track_id, :producer, :time_spent)");
	$stmt -> bindParam(":track_id", $trackData);
	$stmt -> bindParam(":producer", $producerData);
	$stmt -> bindParam(":time_spent", $timeData);
	$stmt -> execute();
	
	require(dirname(__FILE__)."/../config.php");
	$actionData = "Added producer to Track: ".$nameData;
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