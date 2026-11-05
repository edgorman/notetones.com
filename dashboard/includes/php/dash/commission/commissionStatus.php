<?php
	require(dirname(__FILE__)."/../config.php");
	
	$stmt = $conn -> prepare("SELECT id, login_id, manager, s_date, e_date, invoice_num FROM commission WHERE login_id= :loginIdData LIMIT 1");
	$stmt -> bindParam(":loginIdData", $myIdData);
	$stmt -> execute();
	$stmt -> bindColumn('id', $commIdData);
	$stmt -> bindColumn('login_id', $loginIdData);
	$stmt -> bindColumn('manager', $managerData);
	$stmt -> bindColumn('s_date', $startDData);
	$stmt -> bindColumn('e_date', $endDData);
	$stmt -> bindColumn('invoice_num', $invoiceNData);
		
	while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) {
		require(dirname(__FILE__)."/../../config.php");
		
		if($stmtTwo = $conn -> prepare("SELECT username, nickname FROM login WHERE id= :loginIdData")) {
			$stmtTwo -> bindParam(":loginIdData", $myIdData);
			$stmtTwo -> execute();
			$stmtTwo -> bindColumn('username', $userNData);
			$stmtTwo -> bindColumn('nickname', $nickNData);
				
			while ($row = $stmtTwo -> fetch(PDO::FETCH_BOUND)) {
				echo '<div class="alert alert-warning">
						<h5><b>'.strtoupper($nickNData).' COMMISSION</b></h5>
						<h6>START DATE: <span>'.$startDData.'</span></h6>
						<h6>ESTIMATED END DATE: <span>'.$endDData.'</span></h6>
						<h6>PRODUCTION MANAGER: <span>'.$managerData.'</span></h6>
						<h6>CLIENT NUMBER: <span>'.substr($userNData,6,3).'</span></h6>
						<h6>TIER TYPE: <span>'.substr($userNData,10,1).'</span></h6>
						<h6>INVOICE NUMBER: <span>'.$invoiceNData.'</span></h6>
					</div>';
			}
		}
	}
?>