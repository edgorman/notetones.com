<?php
	echo '	<div class="main-chat" onclick="updateInfoSeenMessages()">
				<form name="userMessage" onsubmit="return false;" method="POST">
					<div><h2>Notetones Staff Private Messenger</h2></div>
					<hr>
					<div class="main-chat-body">';

	$loginIdData = $_POST['id'];
	$tbl_name = $loginIdData."_nts";
	$loadRData = $_POST['loadRest'];
	require(dirname(__FILE__)."/config.php");
	
	$stmt = $conn -> prepare("CREATE TABLE IF NOT EXISTS ".$tbl_name." 
	(id INT(9) NOT NULL auto_increment PRIMARY KEY,
	 from_user VARCHAR(1000), message VARCHAR(20000),
	  seen VARCHAR(1000) DEFAULT 0,
	   datetime DATETIME NOT NULL);");
	$stmt -> execute();
	
	if($loadRData == "1"){
		echo '<div style="text-align: center; color: blue; padding-bottom: 5px;"><span onclick="loadInfoChatMessages('.$loginIdData.', 0);" style="cursor: pointer;">Hide rest of chat.</span></div>';
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
			echo '<div style="text-align: center; color: blue; padding-bottom: 5px;"><span onclick="loadInfoChatMessages('.$loginIdData.', 1);" style="cursor: pointer;">Load rest of chat.</span></div>';
		}
		else $limitChatData = 0;
		$loadRData = " LIMIT 50 OFFSET $limitChatData";
	}
	
	require(dirname(__FILE__)."/../../config.php");
	$stmtHalf = $conn -> prepare("SELECT nickname FROM login WHERE id= :idData LIMIT 1");
	$stmtHalf -> bindParam(":idData", $loginIdData);
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
		
		if($fromUData == "nts"){
			echo '<div class="from-message">';
			if($lastUserMessageData != $fromUData) {echo '<p>Notetones Staff</p>'; $lastUserMessageData = $fromUData;}
			echo '<h5>'.$messageData.'</h5>
					<span>Sent: '.$dateTData;
			if($seenData == "1") echo ' - Seen Msg';
			echo '</span>
				</div>';
		}
		else{
			echo '<div class="to-message">';
			if($lastUserMessageData != $fromUData) {echo '<p>'.$nicknameData.'</p>'; $lastUserMessageData = $fromUData;}
			echo '<h5>'.$messageData.'</h5>
					<span>Sent: '.$dateTData;
			if($seenData == "1") echo ' - Seen Msg';
			echo '</span>
				</div>';
		}
	}
	echo '<input type="hidden" name="userMessageTableId" value="'.$tbl_name.'"/><input type="hidden" name="userMessageUserId" value="nts"/>';
	
	echo '			</div>
					<hr>
					<div class="main-chat-footer">
						<textarea name="userMessageTextarea" onkeydown="if(event.keyCode == 13) {sendInfoUserMessage('.$loginIdData.'); event.preventDefault();}"></textarea>
						<button class="btn btn-primary" onclick="sendInfoUserMessage('.$loginIdData.');"><i class="fa fa-send"></i></button>
					</div>
				</form>
			</div>';
?>