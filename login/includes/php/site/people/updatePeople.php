<?php
    require("../../config.php");
	
	$idData = $_POST['id'];
	$nameData = $_POST['name'];
	$titleData = $_POST['title'];
	$imgData = $_POST['img'];
	$torderData = $_POST['order'];
	$aboutData = $_POST['about'];
	
	$stmt = $conn -> prepare("UPDATE employees SET name= :name, title= :title, img= :img, torder= :torder, about= :about WHERE id= :id");
	$stmt -> bindParam(":id", $idData);
	$stmt -> bindParam(":name", $nameData);
	$stmt -> bindParam(":title", $titleData);
	$stmt -> bindParam(":img", $imgData);
	$stmt -> bindParam(":torder", $torderData);
	$stmt -> bindParam(":about", $aboutData);
	$stmt -> execute();
?>