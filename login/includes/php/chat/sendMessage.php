<?php
	require(dirname(__FILE__)."/config.php");
	
	date_default_timezone_set('UTC');
	$tbl_name = $_POST['table1'];
	$from2 = $_POST['from1'];
	$message2 = $_POST['message1'];
	$dateTime = date("Y-m-d H:i:s");
	$message2 = autolink($message2);
	
	$stmt = $conn -> prepare("INSERT INTO $tbl_name(from_user, message, datetime) VALUES (:fromData, :messageData, :dateTimeData)");
	$stmt -> bindParam(":fromData", $from2);
	$stmt -> bindParam(":messageData", $message2);
	$stmt -> bindParam(":dateTimeData", $dateTime);
	$stmt -> execute();
	
	function autolink($stringData){
		$content_array = explode(" ", $stringData);
		$output = '';
		foreach($content_array as $content){
			if(substr($content, 0, 5) == "https"){
				$content = '<a href="https://' . substr($content, 5, strlen($content)) . '" target="_blank">https://' . substr($content, 5, strlen($content)) . '</a>';
			} 
			else if(substr($content, 0, 4) == "http"){
				$content = '<a href="http://' . substr($content, 4, strlen($content)) . '" target="_blank">http://' . substr($content, 4, strlen($content)) . '</a>';
			} 
			else if(substr($content, 0, 4) == "www."){
				$content = '<a href="http://' . $content . '" target="_blank">' . $content . '</a>';
			}
			$output .= " " . $content;
		}
		$output = trim($output);
		return $output;
	}
?>