<?php
	require(dirname(__FILE__)."/config.php");
	
	date_default_timezone_set('UTC');
	$tbl_name = $_POST['table'];
	$fromData = $_POST['from'];
	$messageData = $_POST['message'];
	$dateTData = date("Y-m-d H:i:s");
	$messageData = autolink($messageData);
	
	$stmt = $conn -> prepare("INSERT INTO ".$tbl_name." (from_user, message, datetime) VALUES (:fromNameData, :messageData, :dateTData)");
	$stmt -> bindParam(":fromNameData", $fromData);
	$stmt -> bindParam(":messageData", $messageData);
	$stmt -> bindParam(":dateTData", $dateTData);
	$stmt -> execute();
	$stmt -> fetch();
	
	function autolink($stringData){
		$content_array = explode(" ", $stringData);
		$output = '';
		
		foreach($content_array as $content){
			
			if(substr($content, 0, 5) == "https"){
				$content = '<a href="https' . substr($content, 5, strlen($content)) . '" target="_blank" style="color: blue;">https' . substr($content, 5, strlen($content)) . '</a>';
			} 
			else if(substr($content, 0, 4) == "http"){
				$content = '<a href="http' . substr($content, 4, strlen($content)) . '" target="_blank" style="color: blue;">http' . substr($content, 4, strlen($content)) . '</a>';
			} 
			else if(substr($content, 0, 4) == "www."){
				$content = '<a href="http://' . $content . '" target="_blank" style="color: blue;">' . $content . '</a>';
			}
			
			$output .= " " . $content;
		}
		$output = trim($output);
		return $output;
	}
?>