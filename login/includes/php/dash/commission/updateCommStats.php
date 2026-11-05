<?php
    require(dirname(__FILE__)."/../config.php");
	
	$loginIdData = $_POST['login_id'];
	$sDData = $_POST['sDate'];
	$eDData = $_POST['eDate'];
	$invNData = $_POST['invNum'];
	$invLData = $_POST['invLink'];
	$updatedData = date("Y-m-d");
	
	$stmt = $conn -> prepare("UPDATE commission SET s_date= :s_date, e_date= :e_date, invoice_num= :invoice_num, invoice_link= :invoice_link WHERE login_id= :login_id");
	$stmt -> bindParam(":s_date", $sDData);
	$stmt -> bindParam(":e_date", $eDData);
	$stmt -> bindParam(":invoice_num", $invNData);
	$stmt -> bindParam(":invoice_link", $invLData);
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