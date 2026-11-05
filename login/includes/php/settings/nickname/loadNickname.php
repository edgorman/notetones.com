<?php
    require(dirname(__FILE__)."/../../config.php");
	if(!isset($myIdData)) $myIdData = $_POST['id'];
	
	$stmt = $conn -> prepare("SELECT id, nickname FROM login WHERE id= :idData LIMIT 1");
	$stmt -> bindParam(":idData", $myIdData);
	$stmt -> execute();
	$stmt -> bindColumn('id', $idData);
	$stmt -> bindColumn('nickname', $nicknameData);
	
	while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) {
		echo '<div class="input-group input-group-lg" style="max-width: 800px;">
				<span class="input-group-addon  " id="newnicknameName">New</span>
				<input class="form-control" name="nicknameName" aria-describedby="newnicknameName" value="'.$nicknameData.'" type="text" maxlength="14"/>
				<input type="hidden" name="nicknameId" value="'.$idData.'"/>
				<input type="hidden" name="nicknameUser" value="'.$idData.'"/>
				<span class="input-group-btn">
    				<button class="btn btn-danger" type="button" onclick="updateNickname();">Submit</button>
  				</span>
			  </div>';
	}
?>