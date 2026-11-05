<?php
	require(dirname(__FILE__)."/../../config.php");
	
    $lockState = $_POST['state'];
	
	$stmt = $conn -> prepare("UPDATE login SET lockState= :lockState WHERE level IN(10,11)");
	$stmt -> bindParam(":lockState", $lockState);
	$stmt -> execute();
?>