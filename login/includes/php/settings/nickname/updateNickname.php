<?php
    require(dirname(__FILE__)."/../../config.php");
	
	$idData = $_POST['id'];
	$nicknameData = $_POST['nickname'];
	
	$stmt = $conn -> prepare("UPDATE login SET nickname= :nicknameData WHERE id= :idData");
	$stmt -> bindParam(":nicknameData", $nicknameData);
	$stmt -> bindParam(":idData", $idData);
	$stmt -> execute();
?>