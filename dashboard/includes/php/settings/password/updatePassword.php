<?php
	if(!isset($_SESSION)) session_start();
    require(dirname(__FILE__)."/../../config.php");
	
	$idData = $_POST['id'];
	$oldPasswordData = sha1(md5($_POST['oldPassword']));
	$newPasswordData = sha1(md5($_POST['newPassword']));
	
	$stmt = $conn -> prepare("SELECT id FROM login WHERE password= :oldPasswordData AND id= :idData");
	$stmt -> bindParam(":oldPasswordData", $oldPasswordData);
	$stmt -> bindParam(":idData", $idData);
	$stmt -> execute();
	$stmt -> bindColumn('id', $myIdData);
	while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) {}
	
	if($stmt -> rowCount() != 0){
		require(dirname(__FILE__)."/../../config.php");
		$stmtTwo = $conn -> prepare("UPDATE login SET password= :newPasswordData WHERE id= :idData");
		$stmtTwo -> bindParam(":newPasswordData", $newPasswordData);
		$stmtTwo -> bindParam(":idData", $myIdData);
		$stmtTwo -> execute();
		
		require(dirname(__FILE__)."/../../dash/config.php");
		$actionData = "Updated password.";
		$actionByData = "Client";
		$timestampData = date("Y-m-d h:i:s");
		$clientSeeData = "0";
		
		$stmtTQ = $conn -> prepare("INSERT INTO prod_log (login_id, action, action_by, timestamp, client_see) VALUES(:loginIdData, :actionData, :actionByData, :timestampData, :clientSeeData)");
		$stmtTQ -> bindParam(":loginIdData", $_SESSION['id']);
		$stmtTQ -> bindParam(":actionData", $actionData);
		$stmtTQ -> bindParam(":actionByData", $actionByData);
		$stmtTQ -> bindParam(":timestampData", $timestampData);
		$stmtTQ -> bindParam(":clientSeeData", $clientSeeData);
		$stmtTQ -> execute();
		
		echo 'true';
	}
	else{
		echo 'false';
	}
	
?>