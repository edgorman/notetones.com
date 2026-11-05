<?php
    require("../../config.php");
	
	$idData = $_POST['id'];
	
	$stmt = $conn -> prepare("SELECT name FROM portfolio WHERE id= :idData");
	$stmt -> bindParam(":idData", $idData);
	$stmt -> execute();
	$stmt -> bindColumn('name', $nameData);
	
	while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) {
		unlink(dirname(__FILE__)."/../../../../../portfolio/".$nameData."/index.php");
		rmdir(dirname(__FILE__)."/../../../../../portfolio/".$nameData);
	}
	
	$stmt = $conn -> prepare("DELETE FROM portfolio WHERE id= :idData");
	$stmt -> bindParam(":idData", $idData);
	$stmt -> execute();
?>