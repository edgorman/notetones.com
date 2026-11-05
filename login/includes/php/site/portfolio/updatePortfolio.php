<?php
    require("../../config.php");
	
	$idData = $_POST['id'];
	$oldNameData = $_POST['oldName'];
	$nameData = $_POST['name'];
	$descData = $_POST['desc'];
	$quoteData = $_POST['quote'];
	$logoData = $_POST['logo'];
	$trackNumData = $_POST['trackNum'];
	$tierData = $_POST['tier'];
	$typeData = $_POST['type'];
	
	if (!rename(dirname(__FILE__)."/../../../../../portfolio/".$oldNameData, dirname(__FILE__)."/../../../../../portfolio/".$nameData)) {
    	die('Failed to create Folder');
	}
	else {
		$stmt = $conn -> prepare("UPDATE portfolio SET name= :name, description= :description, quote= :quote, logo= :logo, tracknum= :tracknum, tier= :tier, type= :type WHERE id= :id");
		$stmt -> bindParam(":name", $nameData);
		$stmt -> bindParam(":description", $descData);
		$stmt -> bindParam(":quote", $quoteData);
		$stmt -> bindParam(":logo", $logoData);
		$stmt -> bindParam(":tracknum", $trackNumData);
		$stmt -> bindParam(":tier", $tierData);
		$stmt -> bindParam(":type", $typeData);
		$stmt -> bindParam(":id", $idData);
		$stmt -> execute();
	}
?>