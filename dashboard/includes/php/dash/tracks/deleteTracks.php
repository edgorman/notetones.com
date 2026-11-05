<?php
	session_start();
	$trackIdData = $_POST['id'];
	
	require(dirname(__FILE__)."/../config.php");
	$stmtHalf = $conn -> prepare("SELECT name FROM tracks WHERE id= :trackIdData");
	$stmtHalf -> bindParam(":trackIdData", $trackIdData);
	$stmtHalf -> execute();
	$stmtHalf -> bindColumn('name', $tempNameData);
	while ($row = $stmtHalf -> fetch(PDO::FETCH_BOUND)) {}
	
	require(dirname(__FILE__)."/../config.php");
	$actionData = "Update Track: ".$tempNameData;
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
	
	require(dirname(__FILE__)."/../config.php");
	$stmt = $conn -> prepare("DELETE FROM tracks WHERE id= :trackIdData");
	$stmt -> bindParam(":trackIdData", $trackIdData);
	$stmt -> execute();
?>