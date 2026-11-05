<?php
	$offsetData = $_POST['offset'];
	
	function clientInfoComplete($loginIdData, $tallyData, $offsetData){
		require(dirname(__FILE__)."/../config.php");
		$stmtTwo = $conn -> prepare("SELECT complete FROM commission WHERE login_id= :login_id");
		$stmtTwo -> bindParam(':login_id', $loginIdData);
		$stmtTwo -> execute();
		$stmtTwo -> bindColumn('complete', $completeData);
		while ($row = $stmtTwo -> fetch(PDO::FETCH_BOUND)) {
			if($completeData == "1") echo '<a href="#" class="list-group-item disabled" title="This commission has been completed.">';
			else echo '<a href="#" class="list-group-item" onclick="loadClientInfoTabs('.$loginIdData.')">';
		}
	}

	require(dirname(__FILE__)."/../../config.php");
   	$stmt = $conn -> prepare("SELECT id, nickname, level, expire FROM login WHERE level IN(10,11) ORDER BY nickname LIMIT 5 OFFSET ".$offsetData);
	$stmt -> execute();
	$stmt -> bindColumn('id', $loginIdData);
	$stmt -> bindColumn('nickname', $nicknameData);
	$stmt -> bindColumn('level', $levelData);
	$stmt -> bindColumn('expire', $expireData);
	$numRows = $stmt -> rowCount();
	$tallyRowCount = 0;
	
	if($numRows == 0) echo '<div class="alert alert-warning" style="text-align: center;"><b>No Clients to display at this time.</b></div>';
	else{
		echo '<div class="list-group">';
		while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) {
			clientInfoComplete($loginIdData, $tallyRowCount, $offsetData);
			
			if($levelData == "10") echo '<span class="badge">Tier 2</span>';
			else echo '<span class="badge">Tier 3</span>';
			echo '<span id="user">'.$nicknameData.'</span><p class="list-group-item-text">Last Online: '.date("Y-m-d H:i:s", strtotime($expireData)-(60*5)).'</p></a>';
			
			$tallyRowCount++;
		}
	}
	
	require(dirname(__FILE__)."/../../config.php");
	$stmt = $conn -> prepare("SELECT id FROM login WHERE level IN(10,11)");
	$stmt -> execute();
	$numRows = $stmt -> rowCount();
	
	echo '<ul class="pagination">';
	
	if(0 > $offsetData-5) echo '<li class="disabled">';
	else echo '<li onclick="loadClientInfo('.($offsetData-5).')">';
	echo '	    <a href="#" aria-label="Previous">
		        	<span aria-hidden="true">&laquo;</span>
		      	</a>
		    </li>';
	
	for($i = 0; $i < $numRows / 5; $i++){
		if($offsetData == ($i * 5)) echo '<li class="active"><a href="#">'.($i+1).'</a></li>';
		else echo '<li><a href="#" onclick="loadClientInfo('.($i*5).')">'.($i+1).'</a></li>';
	}
	
	if($numRows <= $offsetData+5) echo '<li class="disabled">';
	else echo '<li onclick="loadClientInfo('.($offsetData+5).')">';
	echo '    	<a href="#" aria-label="Next">
		        	<span aria-hidden="true">&raquo;</span>
		      	</a>
		    </li>';
	
	echo' </ul>';
?>