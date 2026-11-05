<?php
	$loginIdData = $_POST['id'];
	$loadRestData = $_POST['rest'];
	require(dirname(__FILE__)."/../config.php");
	
	$stmt = $conn -> prepare("SELECT timestamp FROM prod_log WHERE login_id= :loginIdData ORDER BY id DESC LIMIT 1");
	$stmt -> bindParam(":loginIdData", $loginIdData);
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
						            <th>Client see <i class="fa fa-info" data-toggle="tooltip" data-placement="left" data-original-title="If 0, the client will not have seen this entry."></i></th>
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
						            <th>Client see <i class="fa fa-info" data-toggle="tooltip" data-placement="left" data-original-title="If 0, the client will not have seen this entry."></i></th>
						        </tr>
						    </thead>
						    <tbody>';
	}
	
	$stmtTwo = $conn -> prepare("SELECT action, action_by, timestamp, client_see FROM prod_log WHERE login_id= :loginIdData ORDER BY id DESC");
	$stmtTwo -> bindParam(":loginIdData", $loginIdData);
	$stmtTwo -> execute();
	$stmtTwo -> bindColumn('action', $actionData);
	$stmtTwo -> bindColumn('action_by', $actionByData);
	$stmtTwo -> bindColumn('timestamp', $timestampData);
	$stmtTwo -> bindColumn('client_see', $clientSData);
	$logTallyCount = 0;
	if($loadRestData == "0") $logTallyMax = 40;
	else $logTallyMax = 40000000;
	
	while ($row = $stmtTwo -> fetch(PDO::FETCH_BOUND)) {
		if($logTallyCount < $logTallyMax){
			if($actionByData == "Client") echo '<tr class="active"><td>'.(($stmtTwo -> rowCount()) - $logTallyCount).'</td><td>'.$actionData.'</td><td>Client</td><td>'.$timestampData.'</td><td>'.$clientSData.'</td></tr>';
			else echo '<tr><td>'.(($stmtTwo -> rowCount()) - $logTallyCount).'</td><td>'.$actionData.'</td><td>Staff</td><td>'.$timestampData.'</td><td>'.$clientSData.'</td></tr>';
			$logTallyCount++;
		}
	}
	
   if($logTallyMax == 40){
		echo '
				    </tbody>
				</table>
			</div>
			<div class="panel-footer" style="text-align: center; color: blue;">
				<span style="cursor: pointer;" onclick="loadClientInfoProduction('.$loginIdData.',1);">LOAD REST OF LOG.</span>
			</div>
		</div>';
	}
	else{
		echo '
				    </tbody>
				</table>
			</div>
			<div class="panel-footer" style="text-align: center; color: blue;">
				<span style="cursor: pointer;" onclick="loadClientInfoProduction('.$loginIdData.',0);">SHOW FEWER LOGS.</span>
			</div>
		</div>';
	}
?>