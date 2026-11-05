<?php
    require("/../../config.php");
	
	$idData = $_POST['id'];
	$titleData = $_POST['title'];
	$descData = $_POST['description'];
	$fileData = $_POST['file'];
	$positionData = $_POST['position'];
	$orderData = $_POST['order'];
	$screenPosData = $_POST['screenPos'];
	
	$stmt = $conn -> prepare("UPDATE carousel SET file= :fileData, captionTitle= :captionTData, captionDesc= :captionDData, captionPos= :captionPData, torder= :torderData, screenPos= :screenPData WHERE id= :idData");
	$stmt -> bindParam(":fileData", $fileData);
	$stmt -> bindParam(":captionTData", $titleData);
	$stmt -> bindParam(":captionDData", $descData);
	$stmt -> bindParam(":captionPData", $positionData);
	$stmt -> bindParam(":torderData", $orderData);
	$stmt -> bindParam(":screenPData", $screenPosData);
	$stmt -> bindParam(":idData", $idData);
	$stmt -> execute();
?>