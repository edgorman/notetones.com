<?php
	$idData = $_POST['id'];
	require(dirname(__FILE__)."/../config.php");
	$stmt = $conn -> prepare("SELECT id FROM commission WHERE login_id= :id");
	$stmt -> bindParam(":id", $idData);
	$stmt -> execute();
	$stmt -> bindColumn("id", $commIdData);
	while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) {}
	
	require(dirname(__FILE__)."/../messaging/config.php");
	$stmt = $conn -> prepare("DROP TABLE ".$idData."_nts");
	$stmt -> bindParam(":id", $idData);
	$stmt -> execute();
	
	require(dirname(__FILE__)."/../../config.php");
	$stmt = $conn -> prepare("DELETE FROM alerts WHERE destination= :id");
	$stmt -> bindParam(":id", $idData);
	$stmt -> execute();
	
	function deleteProducerInfo($trackIdData){
		require(dirname(__FILE__)."/../config.php");
		$stmt = $conn -> prepare("DELETE FROM producers WHERE track_id= :id");
		$stmt -> bindParam(":id", $trackIdData);
		$stmt -> execute();
	}
	
	require(dirname(__FILE__)."/../config.php");
	$stmt = $conn -> prepare("SELECT id FROM tracks WHERE commission_id= :id");
	$stmt -> bindParam(":id", $commIdData);
	$stmt -> execute();
	$stmt -> bindColumn("id", $trackIdData);
	while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) {
		deleteProducerInfo($trackIdData);
	}
	
	require(dirname(__FILE__)."/../config.php");
	$stmt = $conn -> prepare("DELETE FROM tracks WHERE commission_id= :id");
	$stmt -> bindParam(":id", $commIdData);
	$stmt -> execute();
	
	require(dirname(__FILE__)."/../config.php");
	$stmt = $conn -> prepare("DELETE FROM prod_log WHERE login_id= :id");
	$stmt -> bindParam(":id", $idData);
	$stmt -> execute();
	
	require(dirname(__FILE__)."/../config.php");
	$stmt = $conn -> prepare("DELETE FROM commission WHERE login_id= :id");
	$stmt -> bindParam(":id", $idData);
	$stmt -> execute();
	
	require("../../config.php");
	$stmt = $conn -> prepare("DELETE FROM login WHERE id= :id");
	$stmt -> bindParam(":id", $idData);
	$stmt -> execute();
?>