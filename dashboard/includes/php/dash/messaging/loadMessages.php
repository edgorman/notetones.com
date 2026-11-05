<?php
	if(!isset($_SESSION)) session_start();
	$idData = $_SESSION['id'];
	$tbl_name = $idData."_nts";
	$loadRData = $_POST['loadRest'];
	require(dirname(__FILE__)."/config.php");
	
	if($loadRData == "1"){
		echo '<div style="text-align: center; color: blue; padding-bottom: 5px;"><span onclick="loadChatMessages(0);" style="cursor: pointer;">Hide rest of chat.</span></div>';
		$loadRData = "";
	}
	else{
		$limitChatData = 0;
		
		require(dirname(__FILE__)."/config.php");
		$stmtTwo = $conn -> prepare("SELECT id FROM ".$tbl_name." ORDER BY id ASC");
		$stmtTwo -> execute();
		$limitChatData = $stmtTwo -> rowCount();
		
		if(($limitChatData - 50) > 0){
			$limitChatData -= 50;
			echo '<div style="text-align: center; color: blue; padding-bottom: 5px;"><span onclick="loadChatMessages(1);" style="cursor: pointer;">Load rest of chat.</span></div>';
		}
		else $limitChatData = 0;
		$loadRData = " LIMIT 50 OFFSET $limitChatData";
	}
	
	require(dirname(__FILE__)."/../../config.php");
	$stmtHalf = $conn -> prepare("SELECT nickname FROM login WHERE id= :idData LIMIT 1");
	$stmtHalf -> bindParam(":idData", $idData);
	$stmtHalf -> execute();
	$stmtHalf -> bindColumn('nickname', $nicknameData);
	while ($row = $stmtHalf -> fetch(PDO::FETCH_BOUND)) {}
	
	require(dirname(__FILE__)."/config.php");
	$stmt = $conn -> prepare("SELECT id, from_user, message, seen, datetime FROM ".$tbl_name." ".$loadRData);
	$stmt -> execute();
	$stmt -> bindColumn('id', $msgIdData);
	$stmt -> bindColumn('from_user', $fromUData);
	$stmt -> bindColumn('message', $messageData);
	$stmt -> bindColumn('seen', $seenData);
	$stmt -> bindColumn('datetime', $dateTData);
	$lastUserMessageData = $fromUData;
	$lastUserMessageDay = "";
	
	while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) {
		if($lastUserMessageDay != substr($dateTData, 0, 10)){
			echo '<div class="new-day-message"><b>'.substr($dateTData, 0, 10).'</b></div>';
			$lastUserMessageDay = substr($dateTData, 0, 10);
		}
		if($fromUData == $idData){
			echo '<div class="from-message">';
			if($lastUserMessageData != $fromUData) {echo '<p>'.$nicknameData.'</p>'; $lastUserMessageData = $fromUData;}
			echo '<h5>'.$messageData.'</h5>
					<span>Sent: '.$dateTData;
			if($seenData == "1") echo ' - Seen Msg';
			echo '</span>
				</div>';
		}
		else{
			echo '<div class="to-message">';
			if($lastUserMessageData != $fromUData) {echo '<p>Notetones Staff</p>'; $lastUserMessageData = $fromUData;}
			echo '<h5>'.$messageData.'</h5>
					<span>Sent: '.$dateTData;
			if($seenData == "1") echo ' - Seen Msg';
			echo '</span>
				</div>';
		}
	}
	echo '<input type="hidden" name="userMessageTableId" value="'.$tbl_name.'"/><input type="hidden" name="userMessageUserId" value="'.$idData.'"/>';
?>