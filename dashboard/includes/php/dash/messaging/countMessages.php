<?php
	if(!isset($_SESSION)) session_start();
	require(dirname(__FILE__)."/config.php");
	
	$tbl_name = $_SESSION['id']."_nts";
	
	$stmtTwo = $conn -> prepare("SELECT id FROM ".$tbl_name." WHERE seen='0' AND from_user='nts'  ORDER BY id ASC");
	$stmtTwo -> execute();
	$stmtTwo -> bindColumn("id", $idData);
	$unseenMsgs = $stmtTwo -> rowCount();
?>