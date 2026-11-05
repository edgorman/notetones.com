<?php
    require(dirname(__FILE__)."/../../config.php");
	if(!isset($myIdData)) $myIdData = $_POST['id'];
	
	$stmt = $conn -> prepare("SELECT id FROM login WHERE id= :idData LIMIT 1");
	$stmt -> bindParam(":idData", $idData);
	$stmt -> execute();
	$stmt -> bindColumn('id', $myIdData);
	
	while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) {
		echo '<div class="input-group input-group-lg" style="max-width: 800px;">
				<span class="input-group-addon" id="oldPassword">Old</span>
				<input class="form-control" name="oldPassword" aria-describedby="oldPassword" type="password"/>
			  </div>
			  <br>
			  <div class="input-group input-group-lg" style="max-width: 800px;">
				<span class="input-group-addon" id="newPassword1">New</span>
				<input class="form-control" name="newPassword" aria-describedby="newPassword1" type="password"/>
			  </div>
			  <div class="input-group input-group-lg" style="max-width: 800px;">
				<span class="input-group-addon" id="newPassword2">New</span>
				<input class="form-control" name="newPassword" aria-describedby="newPassword2" type="password"/>
			  </div>
			  <br>
			  <div class="input-group input-group-lg" style="max-width: 800px; text-align: center;">
				<span class="input-group-btn">
    				<button class="btn btn-danger" type="button" onclick="updatePassword();">Submit</button>
  				</span>
			  </div>
			  
			  <input type="hidden" name="passwordId" value="'.$myIdData.'"/>';
	}
?>