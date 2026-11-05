<?php
    require(dirname(__FILE__)."/../config.php");
	
	$loginIdData = $_POST['login_id'];
	$managerData = $_POST['manager'];
	$phaseData = $_POST['phase'];
	$downloadData = $_POST['download'];
	$completeData = $_POST['complete'];
	$updatedData = date("Y-m-d");
	
	$stmt = $conn -> prepare("UPDATE commission SET manager= :manager, phase= :phase, download= :download, complete= :complete WHERE login_id= :login_id");
	$stmt -> bindParam(":manager", $managerData);
	$stmt -> bindParam(":phase", $phaseData);
	$stmt -> bindParam(":download", $downloadData);
	$stmt -> bindParam(":complete", $completeData);
	$stmt -> bindParam(":login_id", $loginIdData);
	$stmt -> execute();
	
	require(dirname(__FILE__)."/../config.php");
	$actionData = "Updated Commission details";
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