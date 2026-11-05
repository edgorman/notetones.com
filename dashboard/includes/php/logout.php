<?php
	session_start();
	$idData = $_SESSION['id'];
	
	require(dirname(__FILE__)."/config.php");
	$stmt = $conn -> prepare("UPDATE login SET status='0' WHERE id= :idData");
	$stmt -> bindParam(":idData", $idData);
	$stmt -> execute();
	
	require(dirname(__FILE__)."/dash/config.php");
	$actionData = "Logged out of Dash.";
	$actionByData = "Client";
	$timestampData = date("Y-m-d h:i:s");
	$clientSeeData = "0";
	
	$stmtTQ = $conn -> prepare("INSERT INTO prod_log (login_id, action, action_by, timestamp, client_see) VALUES(:login_id, :actionData, :actionByData, :timestampData, :clientSeeData)");
	$stmtTQ -> bindParam(":login_id", $idData);
	$stmtTQ -> bindParam(":actionData", $actionData);
	$stmtTQ -> bindParam(":actionByData", $actionByData);
	$stmtTQ -> bindParam(":timestampData", $timestampData);
	$stmtTQ -> bindParam(":clientSeeData", $clientSeeData);
	$stmtTQ -> execute();
	
	$_SESSION['id'] = 0;
	$_SESSION['loggedIn'] = 0;
	header("Location: ../../");
?>