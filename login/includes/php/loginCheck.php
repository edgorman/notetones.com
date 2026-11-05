<?php
	if(isset($_SESSION)){
		$myIdData = $_SESSION['id'];
		
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
			header("Location: ../login/");
		}
		
		while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) {
			if($myLevelData === "1" || $myLevelData === "2" || $myLevelData === "3" || $myLevelData === "4"){
				require(dirname(__FILE__)."/config.php");
				
				$stmtHalf = $conn -> prepare("SELECT lockState FROM login WHERE id= :idData");
				$stmtHalf -> bindParam(":idData", $myIdData);
				$stmtHalf -> execute();
				$stmtHalf -> bindColumn('lockState', $lockStateData);
				
				while ($row = $stmtHalf -> fetch(PDO::FETCH_BOUND)) {
					if($lockStateData === "0"){
						$serverAddress = $_SERVER['REMOTE_ADDR'];
						$stmtTwo = $conn -> prepare("UPDATE login SET expire=(now() + INTERVAL 5 MINUTE), status='1', ip= :ipData WHERE id= :idData");
						$stmtTwo -> bindParam(":ipData", $serverAddress);
						$stmtTwo -> bindParam(":idData", $myIdData);
						$stmtTwo -> execute();
					}
					else{
						$_SESSION['loggedIn'] = 0;
						$_SESSION['id'] = "";
						header("Location: ../login/");
					}
				}
			}
			else{
				require(dirname(__FILE__)."/loginAttempts.php");
				$_SESSION['loggedIn'] = 0;
				$_SESSION['id'] = "";
				header("Location: ../login/");
			}
		}
	}
	else{
		require(dirname(__FILE__)."/loginAttempts.php");
		$_SESSION['loggedIn'] = 0;
		$_SESSION['id'] = "";
		header("Location: ../login/");
	}
?>