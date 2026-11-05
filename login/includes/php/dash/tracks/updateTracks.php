<?php
    require(dirname(__FILE__)."/../config.php");
	
	$idData = $_POST['id'];
	$nameData = $_POST['name'];
	$loginIdData = $_POST['login'];
	$statusData = $_POST['status'];
	$eDData = $_POST['eDate'];
	$downloadData = $_POST['download'];
	$updatedData = date("Y-m-d");
	
	$stmt = $conn -> prepare("UPDATE tracks SET name= :name, status= :status, e_date= :eDate, download= :download, updated= :updated WHERE id= :id");
	$stmt -> bindParam(":name", $nameData);
	$stmt -> bindParam(":status", $statusData);
	$stmt -> bindParam(":eDate", $eDData);
	$stmt -> bindParam(":download", $downloadData);
	$stmt -> bindParam(":updated", $updatedData);
	$stmt -> bindParam(":id", $idData);
	$stmt -> execute();
	
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