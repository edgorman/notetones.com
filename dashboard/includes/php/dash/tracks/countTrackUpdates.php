<?php
	if(!isset($_SESSION)) session_start();
	$loginIdData = $_SESSION['id'];
	
	function countCompleteTracks($idData){
		require(dirname(__FILE__)."/../config.php");
		$stmtTwo = $conn -> prepare("SELECT id FROM tracks WHERE commission_id= :id AND download != ''");
		$stmtTwo -> bindParam("id", $idData);
		$stmtTwo -> execute();
		$stmtTwo -> bindColumn("id", $trackIdData);
		while ($row = $stmtTwo -> fetch(PDO::FETCH_BOUND)) {}
		return $stmtTwo -> rowCount();
	}
	
	require(dirname(__FILE__)."/../config.php");
	$stmtTwo = $conn -> prepare("SELECT id FROM commission WHERE login_id= :id LIMIT 1");
	$stmtTwo -> bindParam("id", $loginIdData);
	$stmtTwo -> execute();
	$stmtTwo -> bindColumn("id", $idData);
	while ($row = $stmtTwo -> fetch(PDO::FETCH_BOUND)) {
		$unseenUps = countCompleteTracks($idData);
	}
?>