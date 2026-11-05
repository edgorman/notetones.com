<?php
	require(dirname(__FILE__)."/../config.php");
	
	$stmt = $conn -> prepare("SELECT id, nickname FROM login WHERE level IN (1,2,3,4) AND id != :idData");
	$stmt -> bindParam(":idData", $myIdData);
	$stmt -> execute();
	$stmt -> bindColumn('id', $idData);
	$stmt -> bindColumn('nickname', $nicknameData);
	
	while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) {
		require(dirname(__FILE__)."/config.php");
		
		if(!($idData == $myIdData)) {
			$new_tbl_name = $idData."_".$myIdData;
			$other_tbl_name = $myIdData."_".$idData;
			$tableExists = "";
			
			//FIND TABLE OR CREATE IF NOT EXIST
			$stmtTwo = $conn -> prepare("SHOW TABLES LIKE '".$new_tbl_name."'");
			$stmtTwo -> execute();
			while ($row = $stmtTwo -> fetch(PDO::FETCH_BOUND)) {$tableExists = $new_tbl_name;}
			
			$stmtThree = $conn -> prepare("SHOW TABLES LIKE '".$other_tbl_name."'");
			$stmtThree -> execute();
			while ($row = $stmtThree -> fetch(PDO::FETCH_BOUND)) {$tableExists = $other_tbl_name;}
			
			if($tableExists == "" && ($idData != $myIdData)){
				$stmtTwo = $conn -> prepare("CREATE TABLE $new_tbl_name 
							( id INT(9) NOT NULL auto_increment PRIMARY KEY, 
							from_user VARCHAR(1000), message VARCHAR(20000), 
							seen VARCHAR(1000) DEFAULT 0, datetime DATETIME NOT NULL);");
				$stmtTwo -> execute();
				$tableExists = $new_tbl_name;
			}
			
			$nicknameDataLink = str_replace(" ","_",$nicknameData);
			$new_tbl_name_2 = str_replace("_","-",$tableExists);
			$new_new_tbl_name = 'chat_'.$tableExists;
			
			$updateMessage = 'updateMessage(&#39;'.$idData.'&#39;,&#39;'.$tableExists.'&#39;)';
			$refreshMessage = "refreshChat('".$tableExists."','".$myIdData."','$myNicknameData','$nicknameData','$new_new_tbl_name')";
			
			echo "<script>setInterval(function(){ if(modalIsShown('$nicknameDataLink')) $refreshMessage;},800);</script>";
			
			echo "<div class='modal fade' id='$nicknameDataLink' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
				<div class='modal-dialog'>
     				<div class='modal-content' id='scroll_$tableExists'>
        				<div class='modal-header'>
        					<button type='button' class='close' data-dismiss='modal' aria-hidden='true' >&times;</button>
        					<h2>$nicknameData</h2>
        				</div>
        				<div class='modal-body you_body' id='$new_new_tbl_name' onclick='".$updateMessage."'>";
						
						$sendMessage = 'var msg = $("#'.$tableExists.' textarea[name=message]").val();var table = $("#'.$tableExists.' input[name=table]").val();var id = $("#'.$tableExists.' input[name=id]").val();if (msg == "") {alert("Please enter a message before sending."); } else {msg = msg.replace("http://","http"); msg = msg.replace("https://","https");$.post("includes/php/chat/sendMessage.php", {message1 : msg,table1 : table,from1: id }, function(data) {$("#'.$tableExists.'")[0].reset();});}';
						
						echo "</div>
						<div class='modal-footer'>
							<div class='you_message input_group'>
								<form name='$tableExists' class='input-group' id='$tableExists'>
									<input type='hidden' value='$myIdData' name='id'/>
									<input type='hidden' value='$tableExists' name='table'/>
									<textarea rows='1' class='form-control you_message' name='message' autofocus onkeydown='if(event.keyCode == 13) { $sendMessage }' style='height: 52.8px;'></textarea>
									<span class='input-group-btn'>
										<button class='btn btn-default you_send' type='button' onclick='".$sendMessage."' style='height: 52.8px;'>Send!</button>
									</span>
   								</form>
							</div>
						</div>
      				</div>
    			</div>
  			</div>";
  		}
	}
?>