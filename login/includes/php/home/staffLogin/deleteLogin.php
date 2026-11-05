<?php
    require("../../config.php");
	
	$idData = $_POST['id'];
	
	$stmt = $conn -> prepare("DELETE FROM login WHERE id= :idData");
	$stmt -> bindParam(":idData", $idData);
	$stmt -> execute();
	
	$stmt = $conn -> prepare("DELETE FROM employees WHERE user_id= :UseridData");
	$stmt -> bindParam(":UseridData", $idData);
	$stmt -> execute();
?>