<?php
    require("../../config.php");
	
	$titleData = $_POST['title'];
	$descData = $_POST['description'];
	$fileData = $_POST['file'];
	$positionData = $_POST['position'];
	$orderData = $_POST['order'];
	$screenPosData = $_POST['screenPos'];
	
	$stmt = $conn -> prepare("INSERT INTO carousel (file, captionTitle, captionDesc, captionPos, torder, screenPos) VALUE(:fileData, :captionTData, :captionDData, :captionPData, :torderData, :screenPData)");
	$stmt -> bindParam(":fileData", $fileData);
	$stmt -> bindParam(":captionTData", $titleData);
	$stmt -> bindParam(":captionDData", $descData);
	$stmt -> bindParam(":captionPData", $positionData);
	$stmt -> bindParam(":torderData", $orderData);
	$stmt -> bindParam(":screenPData", $screenPosData);
	$stmt -> execute();
?>