<?php
	require(dirname(__FILE__)."/../../config.php");
	
    $stmt = $conn -> prepare("SELECT lockState FROM login WHERE level IN(10,11) LIMIT 1");
	$stmt -> execute();
	$stmt -> bindColumn('lockState', $lockStateData);
	
	while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) {
		if($lockStateData == 1) echo '<input type="checkbox" name="bootSwitch" class="dashSwitch" data-handle-width="80" data-on-color="danger" checked>';
		else echo '<input type="checkbox" name="bootSwitch" class="dashSwitch" data-handle-width="80" data-on-color="danger">';
	}
?>