<?php
	require(dirname(__FILE__)."/config.php");
	$serverAddressData = $_SERVER['REMOTE_ADDR']; 
	
    $stmt = $conn -> prepare("SELECT ip, attempts, expire FROM loginattempts WHERE ip= :serverAddress");
	$stmt -> bindParam(":serverAddress", $serverAddressData);
	$stmt -> execute();
	$stmt -> bindColumn('ip', $ipData);
	$stmt -> bindColumn('attempts', $attemptsData);
	$stmt -> bindColumn('expire', $expireData);
	$count = $stmt -> rowCount();
	while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) {}
	
	if($count == 1){
		if($attemptsData <= 3){
			$attemptsData = $attemptsData + 1;
			$stmt = $conn -> prepare("UPDATE loginattempts SET attempts= :attemptsData, expire = (now() + INTERVAL 5 MINUTE) WHERE ip= :ipData");
			$stmt -> bindParam(":attemptsData", $attemptsData);
			$stmt -> bindParam(":ipData", $ipData);
			$stmt -> execute();
		}
		else {
			$stmt = $conn -> prepare("UPDATE loginattempts SET expire = (now() + INTERVAL 5 MINUTE) WHERE ip= :ipData");
			$stmt -> bindParam(":ipData", $ipData);
			$stmt -> execute();
		}
	}
	else {
		$stmt = $conn -> prepare("INSERT INTO loginattempts (ip, attempts, expire) VALUES (:serverAddress , 1 ,(now() + INTERVAL 5 MINUTE))");
		$stmt -> bindParam(":serverAddress", $serverAddressData);
		$stmt -> execute();
	}
?>