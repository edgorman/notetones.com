<?php
    require(dirname(__FILE__)."/../../config.php");
	
	$idData = $_POST['id'];
	$oldPasswordData = sha1(md5($_POST['oldPassword']));
	$newPasswordData = sha1(md5($_POST['newPassword']));
	
	$stmt = $conn -> prepare("SELECT id FROM login WHERE password= :oldPasswordData AND id= :idData");
	$stmt -> bindParam(":oldPasswordData", $oldPasswordData);
	$stmt -> bindParam(":idData", $idData);
	$stmt -> execute();
	$stmt -> bindColumn('id', $oldIdData);
	
	require(dirname(__FILE__)."/../../config.php");
	
	$stmtTwo = $conn -> prepare("UPDATE login SET password= :newPasswordData WHERE id= :idData");
	$stmtTwo -> bindParam(":newPasswordData", $newPasswordData);
	$stmtTwo -> bindParam(":idData", $idData);
	$stmtTwo -> execute();
	echo 'true';
?>