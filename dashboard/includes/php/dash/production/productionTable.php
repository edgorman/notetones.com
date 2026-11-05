<?php
	session_start();
	$loginId = $_SESSION['id'];
	require(dirname(__FILE__)."/../config.php");
	
	$stmt = $conn -> prepare("SELECT timestamp FROM prod_log WHERE login_id= :loginIdData AND client_see= :clientSeeData ORDER BY id DESC LIMIT 1");
	$clientSeeData = "1";
	$stmt -> bindParam(":loginIdData", $loginId);
	$stmt -> bindParam(":clientSeeData", $clientSeeData);
	$stmt -> execute();
	$stmt -> bindColumn('timestamp', $lastTimestampData);
	
	if(($stmt -> rowCount()) == 1){
		while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) {
			echo '<div class="panel panel-default">
					<div class="panel-heading">
		            	<h3> PRODUCTION LOG <span style="float: right; font-size: 12px">Last Updated: '.$lastTimestampData.'</span></h3>
		            </div>
					<div class="panel-body">
						<table class="table">
						    <thead>
						        <tr>
						            <th>Row</th>
						            <th>Action</th>
						            <th>Action By</th>
						            <th>Timestamp</th>
						        </tr>
						    </thead>
						    <tbody>';
		}
	}
	else{
		echo '<div class="panel panel-default">
					<div class="panel-heading">
		            	<h3> PRODUCTION LOG <span style="float: right; font-size: 12px"></span></h3>
		            </div>
					<div class="panel-body">
						<table class="table">
						    <thead>
						        <tr>
						            <th>Row</th>
						            <th>Action</th>
						            <th>Action By</th>
						            <th>Timestamp</th>
						        </tr>
						    </thead>
						    <tbody>';
	}
	
	$stmtTwo = $conn -> prepare("SELECT action, action_by, timestamp FROM prod_log WHERE login_id= :loginIdData AND client_see= :clientSeeData ORDER BY id DESC");
	$clientSeeData = "1";
	$stmtTwo -> bindParam(":loginIdData", $loginId);
	$stmtTwo -> bindParam(":clientSeeData", $clientSeeData);
	$stmtTwo -> execute();
	$stmtTwo -> bindColumn('action', $actionData);
	$stmtTwo -> bindColumn('action_by', $actionByData);
	$stmtTwo -> bindColumn('timestamp', $timestampData);
	$logTallyCount = 0;
	if($_POST['loadRest'] == "0") $logTallyMax = 40;
	else $logTallyMax = 40000000;
	
	while ($row = $stmtTwo -> fetch(PDO::FETCH_BOUND)) {
		if($logTallyCount < $logTallyMax){
			if($actionByData == "Client") echo '<tr class="active"><td>'.(($stmtTwo -> rowCount()) - $logTallyCount).'</td><td>'.$actionData.'</td><td>Client</td><td>'.$timestampData.'</td></tr>';
			else echo '<tr><td>'.(($stmtTwo -> rowCount()) - $logTallyCount).'</td><td>'.$actionData.'</td><td>Staff</td><td>'.$timestampData.'</td></tr>';
			$logTallyCount++;
		}
	}
	
	if($logTallyMax == 40){
		echo '
				    </tbody>
				</table>
			</div>
			<div class="panel-footer" style="text-align: center; color: blue;">
				<span style="cursor: pointer;" onclick="loadProduction(1);">LOAD REST OF LOG.</span>
			</div>
		</div>';
	}
	else{
		echo '
				    </tbody>
				</table>
			</div>
			<div class="panel-footer" style="text-align: center; color: blue;">
				<span style="cursor: pointer;" onclick="loadProduction(0);">SHOW FEWER LOGS.</span>
			</div>
		</div>';
	}
	
    
?>