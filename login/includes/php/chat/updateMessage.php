<?php
	require(dirname(__FILE__)."/config.php");
	
	$tbl_name = $_POST['table'];
	$idData = $_POST['id'];
	
	$stmt = $conn -> prepare("UPDATE ".$tbl_name." SET seen='1' WHERE from_user= :fromUData");
	$stmt -> bindParam(":fromUData", $idData);
	$stmt -> execute();
?>