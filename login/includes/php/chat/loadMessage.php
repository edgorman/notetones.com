<?php
	session_start();
	require(dirname(__FILE__)."/config.php");
	
	$previous_user = "";
	$previous_date = "";
	$tbl_name = $_POST['table'];
	$idData = $_POST['id'];
	$myNicknameData = $_POST['lastname'];
	$nicknameData = $_POST['othername'];
	
	$tbl_link = '"'.$tbl_name.'"';
	$blankTable = "";
	$chatScroll = false;
	$prepStmt = "SELECT from_user, message, seen, datetime FROM $tbl_name ORDER BY id ASC";
	
	//LOAD EXTRA CHAT
	if(isset($_SESSION['chat-load'])){
		if($_SESSION['chat-load'] == $tbl_name){
			echo "<div style='text-align: center; width: 100%;'><a href='javascript:void(0)' onclick='loadChat($blankTable)'>Show Less</a></div>";
		} 
		else {
			$limitData = 0;
			
			$stmtTwo = $conn -> prepare("SELECT id FROM $tblname ORDER BY id ASC");
			$stmtTwo -> execute();
			$limitData = $stmtTwo -> rowCount();

			if(($limitData - 50) > 0){
				$limitData -= 50;
				echo "<div style='text-align: center; width: 100%;'><a href='javascript:void(0)' onclick='loadChat($tbl_link)'>Load Rest of Chat</a></div>";
			}
			else $limitData = 0;
			
			$prepStmt .=" LIMIT 50 OFFSET $limitData";
		}
	}
	else {
		$limitData = 0;
		
		$stmtTwo = $conn -> prepare("SELECT id FROM $tbl_name ORDER BY id ASC");
		$stmtTwo -> execute();
		$limitData = $stmtTwo -> rowCount();
		
		if(($limitData - 50) > 0){
			$limitData -= 50;
			echo "<div style='text-align: center; width: 100%;'><a href='javascript:void(0)' onclick='loadChat($tbl_link)'>Load Rest of Chat</a></div>";
		}
		else $limitData = 0;
		
		$prepStmt .=" LIMIT 50 OFFSET $limitData";
	}
	
	//DISPLAY POSTS
	$stmt = $conn -> prepare($prepStmt);
	$stmt -> execute();
	$stmt -> bindColumn("from_user", $fromUserData);
	$stmt -> bindColumn("message", $messageData);
	$stmt -> bindColumn("seen", $seenData);
	$stmt -> bindColumn("datetime", $dateTimeData);
	
	while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) {
		if($previous_date != substr($dateTimeData,0,10)){
			$previous_date = substr($dateTimeData,0,10);
			echo "<hr style='margin: 1px;border: 1px solid #E3E3E3;'><div style='text-align: center; width: 100%;'><b>$previous_date</b></div><hr style='margin: 1px;border: 1px solid #E3E3E3;'>";
			$previous_user = "";
		}
		
		if($seenData == 0 && $fromUserData != $idData){
			echo "<div id='scrollToChat'></div>";
			$chatScroll = true;
		}
		
		if($idData == $fromUserData){
			if($fromUserData == $previous_user){
				echo "<div class='other_post' style='padding: 7px 0 2px 0;'>".$messageData."</div><br>";
			} 
			else {
				echo "	<div class='other_post'><span class='other_name'>".ucfirst($myNicknameData)."</span></div><br>
						<div class='other_post'>".$messageData."</div><br>";
				$previous_user = $fromUserData;
			}
		} 
		else {
			
			if($fromUserData == $previous_user){
				echo "<div class='you_post' style='padding: 7px 0 2px 0;'>".$messageData."</div>";
			} 
			else {
				echo "	<div class='you_post'><span class='you_name'>".ucfirst($nicknameData)."</span></div>
						<div class='you_post'>".$messageData."</div>";
				$previous_user = $fromUserData;
			}
		}
		
		echo "<br>";
		if(!$chatScroll) echo "<div id='scrollToChat'></div>";
	}
	echo "<br>";
?>