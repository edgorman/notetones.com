<?php
    require(dirname(__FILE__)."/../config.php");
	$totalHoursArray = array();
	
	$stmt = $conn -> prepare("SELECT id FROM commission WHERE login_id= :loginIdData");
	$stmt -> bindParam(":loginIdData", $myIdData);
	$stmt -> execute();
	$stmt -> bindColumn('id', $commIdData);
		
	while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) {
		require(dirname(__FILE__)."/../config.php");
		$stmtTwo = $conn -> prepare("SELECT id FROM tracks WHERE commission_id= :commIdData");
		$stmtTwo -> bindParam(":commIdData", $commIdData);
		$stmtTwo -> execute();
		$stmtTwo -> bindColumn('id', $trackIdData);
		
		while ($row = $stmtTwo -> fetch(PDO::FETCH_BOUND)) {
			$totalHoursArray = echoProductionStats($trackIdData, $totalHoursArray);
		}
	}

	function echoProductionStats($trackIdData, $totalHoursArray){
		require(dirname(__FILE__)."/../config.php");
		
		$stmtThree = $conn -> prepare("SELECT time_spent FROM producers WHERE track_id= :trackIdData");
		$stmtThree -> bindParam(":trackIdData", $trackIdData);
		$stmtThree -> execute();
		$stmtThree -> bindColumn('time_spent', $hoursData);
		
		while ($row = $stmtThree -> fetch(PDO::FETCH_BOUND)) {
			$totalProdHoursArray = explode(",", $hoursData);
			for($i = 0; $i < sizeOf($totalProdHoursArray); $i++){
				if(empty($totalHoursArray[$i])) $totalHoursArray[$i] = $totalProdHoursArray[$i];
				else $totalHoursArray[$i] = floatval($totalHoursArray[$i]) + floatval($totalProdHoursArray[$i]);
			}
		}
		return $totalHoursArray;
	}
	
	$maxTotalHour = 0;
	echo 'var dataCLG = [';
	for($i = 0; $i < sizeof($totalHoursArray); $i++){
		echo '['.($i + 1).', '.$totalHoursArray[$i].']';
		if($i < (sizeof($totalHoursArray) - 1)) echo ', ';
		if($maxTotalHour < floatval($totalHoursArray[$i])) $maxTotalHour = $totalHoursArray[$i];
	}
	echo '];';
	
	if($maxTotalHour >= 9 && $maxTotalHour < 90) echo "document.getElementsByClassName('commission-line-graph-overlay')[0].style.left = '49px';";
	else if($maxTotalHour >= 90) echo "document.getElementsByClassName('commission-line-graph-overlay')[0].style.left = '54px';";
	else echo "document.getElementsByClassName('commission-line-graph-overlay')[0].style.left = '43px';";
	
?>