<?php
	if(isset($_SESSION)){
		$myIdData = $_SESSION['id'];
		$_SESSION['firstTimeClient'] = firstTimeClient($myIdData);
		
		$stmt = $conn -> prepare("SELECT id, nickname, level FROM login WHERE id= :idData");
		$stmt -> bindParam(":idData", $myIdData);
		$stmt -> execute();
		$stmt -> bindColumn('id', $myIdData);
		$stmt -> bindColumn('nickname', $myNicknameData);
		$stmt -> bindColumn('level', $myLevelData);
		
		if($stmt -> rowCount() == 0){
			require(dirname(__FILE__)."/loginAttempts.php");
			$_SESSION['loggedIn'] = 0;
			$_SESSION['id'] = "";
			header("Location: ../dashboard/");
		}
		
		while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) {
			if($myLevelData === "10" || $myLevelData === "11"){
				require(dirname(__FILE__)."/config.php");
				
				$stmtHalf = $conn -> prepare("SELECT lockState FROM login WHERE id= :idData");
				$stmtHalf -> bindParam(":idData", $myIdData);
				$stmtHalf -> execute();
				$stmtHalf -> bindColumn('lockState', $lockStateData);
				
				while ($row = $stmtHalf -> fetch(PDO::FETCH_BOUND)) {
					if($lockStateData === "0"){
						$stmtTwo = $conn -> prepare("UPDATE login SET expire=(now() + INTERVAL 5 MINUTE), status='1' WHERE id= :idData");
						$stmtTwo -> bindParam(":idData", $myIdData);
						$stmtTwo -> execute();
					}
					else{
						$_SESSION['loggedIn'] = 0;
						$_SESSION['id'] = "";
						header("Location: ../dashboard/");
					}
				}
			}
			else{
				require(dirname(__FILE__)."/loginAttempts.php");
				$_SESSION['loggedIn'] = 0;
				$_SESSION['id'] = "";
				header("Location: ../dashboard/");
			}
		}
	}
	else{
		require(dirname(__FILE__)."/loginAttempts.php");
		$_SESSION['loggedIn'] = 0;
		$_SESSION['id'] = "";
		header("Location: ../dashboard/");
	}
	
	function firstTimeClient($myIdData){
		require(dirname(__FILE__)."/config.php");
		$stmtFour = $conn -> prepare("SELECT id, expire FROM login WHERE id= :idData");
		$stmtFour -> bindParam(":idData", $myIdData);
		$stmtFour -> execute();
		$stmtFour -> bindColumn('id', $idData);
		$stmtFour -> bindColumn('expire', $expireData);
		while ($row = $stmtFour -> fetch(PDO::FETCH_BOUND)) {if(!isset($expireData)) return true;}
		return false;
	}
?>