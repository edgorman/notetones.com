<?php
    require(dirname(__FILE__)."/../config.php");
	
	$idData = $_POST['id'];
	
	$stmt = $conn -> prepare("DELETE FROM calendar WHERE id= :idData");
	$stmt -> bindParam(":idData", $idData);
	$stmt -> execute();
?>