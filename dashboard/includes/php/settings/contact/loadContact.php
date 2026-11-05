<?php
    require(dirname(__FILE__)."/../../config.php");
	
	if(!isset($myIdData)) $myIdData = $_POST['id'];
			
	$stmt = $conn -> prepare("SELECT contact FROM login WHERE id= :idData LIMIT 1");
	$stmt -> bindParam(":idData", $myIdData);
	$stmt -> execute();
	$stmt -> bindColumn("contact", $emailData);
	
	while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) {
		echo '<div class="input-group input-group-lg" style="max-width: 800px;">
				 	<input type="hidden" name="contactId" value="'.$myIdData.'"/>
				 	<span class="input-group-addon  " id="emailInfo">Email</span>
				 	<input class="form-control" name="emailInfo" aria-describedby="emailInfo" value="'.$emailData.'" type="text" placeholder="someone@notetones.com"/>
					<span class="input-group-btn">
        				<button class="btn btn-danger" type="button" onclick="updateContact();">Submit</button>
      		  		</span>
			  </div>';
	}
?>