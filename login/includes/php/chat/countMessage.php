<?php
	session_start();
	require(dirname(__FILE__)."/../config.php");
	
	$levelData = $_POST['level'];
	$userIdData = $_POST['id'];
	
	//SHOW ONLINE STAFF
	$stmt = $conn -> prepare("SELECT id, nickname, expire FROM login WHERE status='1' AND LEVEL IN (1,2,3,4) AND id != :userIData ORDER BY expire DESC");
	$stmt -> bindParam(":userIData", $userIdData);
	$stmt -> execute();
	$stmt -> bindColumn("id", $idData);
	$stmt -> bindColumn("nickname", $nicknameData);
	$stmt -> bindColumn("expire", $expireData);
	
	while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) {
		$nicknameDataLink = str_replace(" ","_",$nicknameData);
		
		if((countMessages($userIdData, $idData)) == 0){
			$countData = "";
		} 
		else {
			$countData = countMessages($userIdData, $idData);
			$countData = "<span title='$countData Messages' class='badge chat_count'>$countData</span>";
		}
		
		if($idData != $userIdData){
			if(strtotime(date('Y-m-d h:i:sa')) > strtotime($expireData)){
				echo "<li class='online-user' data-toggle='modal' data-target='#$nicknameDataLink' title='$nicknameData'>
				<span>$nicknameData</span><div class='idle-icon' title='Idle'></div>$countData
				</li>";
			} else {
				echo "<li class='online-user' data-toggle='modal' data-target='#$nicknameDataLink' title='$nicknameData'>
				<span>$nicknameData</span><div class='online-icon' title='Online'></div>$countData
				</li>";
			}
		}
	}
	
	//SHOW OFFLINE STAFF
	$stmt = $conn -> prepare("SELECT id, nickname, expire FROM login WHERE status='0' and LEVEL IN (1,2,3,4) ORDER BY expire DESC");
	$stmt -> execute();
	$stmt -> bindColumn("id", $idData);
	$stmt -> bindColumn("nickname", $nicknameData);
	$stmt -> bindColumn("expire", $expireData);
	
	while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) {
		$nicknameDataLink = str_replace(" ","_",$nicknameData);
		
		if((countMessages($userIdData, $idData)) == 0){
			$countData = "";
		} 
		else {
			$countData = countMessages($userIdData, $idData);
			$countData = "<span title='$countData Messages' class='badge chat_count'>$countData</span>";
		}
		
		if($idData != $userIdData){
			echo "<li class='online-user' data-toggle='modal' data-target='#$nicknameDataLink' title='$nicknameData'>
			<span>$nicknameData</span><div class='offline-icon' title='Offline'></div>$countData
			</li>";
		}
	}
	
	//RETURN UNSEEN MESSAGES
	function countMessages($chosen_id, $chosen_other){
		require(dirname(__FILE__)."/config.php");
		
		$new_tbl_name = $chosen_other."_".$chosen_id;
		$other_tbl_name = $chosen_id."_".$chosen_other;
		
		$stmtTwo = $conn -> prepare("SHOW TABLES LIKE '".$new_tbl_name."'");
		$stmtTwo -> execute();
		while ($row = $stmtTwo -> fetch(PDO::FETCH_BOUND)) {$tableExists = $new_tbl_name;}
		
		$stmtThree = $conn -> prepare("SHOW TABLES LIKE '".$other_tbl_name."'");
		$stmtThree -> execute();
		while ($row = $stmtThree -> fetch(PDO::FETCH_BOUND)){$tableExists = $other_tbl_name;}
		
		if($tableExists == "" && ($idData != $_SESSION['id'])){
			$stmtTwo = $conn -> prepare("CREATE TABLE $new_tbl_name 
						( id INT(9) NOT NULL auto_increment PRIMARY KEY, 
						from_user VARCHAR(1000), message VARCHAR(20000), 
						seen VARCHAR(1000) DEFAULT 0, datetime DATETIME NOT NULL);");
			$stmtTwo -> execute();
			$tableExists = $new_tbl_name;
		}
		
		$stmtThree = $conn -> prepare("SELECT id FROM $tableExists WHERE seen='0' AND from_user= :chosenOData");
		$stmtThree -> bindParam(":chosenOData", $chosen_other);
		$stmtThree -> execute();
		$stmtThree -> bindColumn("id", $idData);
		return ($stmtThree -> rowCount());
	}
?>
