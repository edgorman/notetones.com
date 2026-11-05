<?php
	session_start();
	require(dirname(__FILE__)."/config.php");
	
	$stmt = $conn -> prepare("UPDATE login SET status='0' WHERE id= :idData");
	$stmt -> bindParam(":idData", $_SESSION['id']);
	$stmt -> execute();
	
	$_SESSION['id'] = 0;
	$_SESSION['loggedIn'] = 0;
	
	header("Location: ../../");
?>