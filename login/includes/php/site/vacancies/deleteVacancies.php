<?php
    require("../../config.php");
	
	$idData = $_POST['id'];
	
	$stmt = $conn -> prepare("DELETE FROM jobs WHERE id= :idData");
	$stmt -> bindParam(":idData", $idData);
	$stmt -> execute();
?>