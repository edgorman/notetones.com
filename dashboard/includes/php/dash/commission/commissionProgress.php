<?php
	if(!isset($_SESSION)) session_start();
	$percentageCompleteData = 0;
	$percentageTotalData = 0;
	
	require(dirname(__FILE__)."/../config.php");
	$stmtHalf =  $conn -> prepare("SELECT id FROM commission WHERE login_id= :idData");
	$stmtHalf -> bindParam(":idData", $_SESSION['id']);
	$stmtHalf -> execute();
	$stmtHalf -> bindColumn('id', $commIData);
	while ($row = $stmtHalf -> fetch(PDO::FETCH_BOUND)) {}
	
	require(dirname(__FILE__)."/../config.php");
	$stmt = $conn -> prepare("SELECT status FROM tracks WHERE commission_id= :commIdData");
	$stmt -> bindParam(":commIdData", $commIData);
	$stmt -> execute();
	$stmt -> bindColumn('status', $statusData);
	$percentageTotalData = 100 * ($stmt -> rowCount());
	
	while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) {
		switch($statusData){
			case "Planning Phase": $percentageCompleteData += 20;
			break;
			case "Production Phase": $percentageCompleteData += 40;
			break;
			case "Mastering Phase": $percentageCompleteData += 60;
			break;
			case "Finalising Phase": $percentageCompleteData += 80;
			break;
			case "Complete": $percentageCompleteData += 100;
			break;
		}
	}
	
	if($percentageTotalData >= 1){
		echo '<div class="commission-progress progress" data-toggle="tooltip" data-placement="top" data-original-title="Overall progress of your commission. Green indicates completion.">
				<div class="progress progress-striped" style="width: 100%; height: 100%;">
					<div class="progress-bar progress-bar-success" style="width: '.(($percentageCompleteData/$percentageTotalData)*100).'%"></div>
					<div class="progress-bar progress-bar-danger" style="width: '.(100-(($percentageCompleteData/$percentageTotalData)*100)).'%"></div>
				</div>
			</div>';
	}
	else{
		echo '<div class="commission-progress progress" data-toggle="tooltip" data-placement="top" data-original-title="Overall progress of your commission. Green indicates completion.">
				<div class="progress progress-striped" style="width: 100%; height: 100%;">
					<div class="progress-bar progress-bar-success" style="width: 0%"></div>
					<div class="progress-bar progress-bar-danger" style="width: 100%"></div>
				</div>
			</div>';
	}
    
?>