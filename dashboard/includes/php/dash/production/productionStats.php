<?php
	require(dirname(__FILE__)."/../../config.php");
	$producerTallyArray = array();
	
	$stmt = $conn -> prepare("SELECT username FROM login WHERE id= :idData LIMIT 1");
	$stmt -> bindParam(":idData", $myIdData);
	$stmt -> execute();
	$stmt -> bindColumn('username', $userNData);
		
	while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) {
		require(dirname(__FILE__)."/../config.php");
		
		$stmtTwo = $conn -> prepare("SELECT id, s_date FROM commission WHERE login_id= :loginIdData LIMIT 1");
		$stmtTwo -> bindParam(":loginIdData", $myIdData);
		$stmtTwo -> execute();
		$stmtTwo -> bindColumn('id', $commIdData);
		$stmtTwo -> bindColumn('s_date', $startDData);
		
		while ($row = $stmtTwo -> fetch(PDO::FETCH_BOUND)) {
			echo '<h5 style="line-height: 20px;">
					Tier Type: <span>'.substr($userNData,-1,1).'</span><br>';
					
			require(dirname(__FILE__)."/../config.php");
			$stmtThree = $conn -> prepare("SELECT id FROM tracks WHERE commission_id= :commIdData");
			$stmtThree -> bindParam(":commIdData", $commIdData);
			$stmtThree -> execute();
			$stmtThree -> bindColumn('id', $trackIdData);
			$trackTotalTally = $stmtThree -> rowCount();
			echo 'Number of Tracks: <span>'.$trackTotalTally.'</span><br>';
				
			while ($row = $stmtThree -> fetch(PDO::FETCH_BOUND)) {
				require(dirname(__FILE__)."/../config.php");
				
				$stmtFour = $conn -> prepare("SELECT producer FROM producers WHERE track_id= :trackIdData");
				$stmtFour -> bindParam(":trackIdData", $trackIdData);
				$stmtFour -> execute();
				$stmtFour -> bindColumn('producer', $producerData);
				
				while ($row = $stmtFour -> fetch(PDO::FETCH_BOUND)) {
					if(!in_array($producerData, $producerTallyArray)) array_push($producerTallyArray, $producerData);
				}
			}
			
			echo 'Producer Count: <span>'.sizeof($producerTallyArray).'</span><br>';
			echo 'Production Start: <span>'.$startDData.'</span><br>';
			echo 'Current Date: <span>'.date("Y-m-d").'</span><br><br>';
			echo '</h5>';
		}
	}
?>