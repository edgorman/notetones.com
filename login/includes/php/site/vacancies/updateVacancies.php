<?php
    require("../../config.php");
	
	$idData = $_POST['id'];
	$titleData = $_POST['title'];
	$descData = $_POST['description'];
	$deptData = $_POST['department'];
	
	$stmt = $conn -> prepare("UPDATE jobs SET title= :title, description= :description, department= :department WHERE id= :id");
	$stmt -> bindParam(":title", $titleData);
	$stmt -> bindParam(":description", $descData);
	$stmt -> bindParam(":department", $deptData);
	$stmt -> bindParam(":id", $idData);
	$stmt -> execute();
?>