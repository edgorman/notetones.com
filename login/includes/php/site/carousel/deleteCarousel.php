<?php
    require("/../../config.php");
	$idData = $_POST['id'];
	
	$stmt = $conn -> prepare("DELETE FROM carousel WHERE id= :idData");
	$stmt -> bindParam(":idData", $idData);
	$stmt -> execute();
?>