<?php
	require(dirname(__FILE__)."/../config.php");
	
	$stmt = $conn -> prepare("SELECT phase FROM commission WHERE login_id= :loginIdData LIMIT 1");
	$stmt -> bindParam(":loginIdData", $myIdData);
	$stmt -> execute();
	$stmt -> bindColumn('phase', $phaseData);
		
	while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) {
		echo '<div class="alert alert-info">
			<h4><b>'.strtoupper($phaseData).'</b></h4>
			<h6>See tracks below for more updates.</h6>
		</div>';
	}
?>