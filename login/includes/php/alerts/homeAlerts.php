<?php
	require(dirname(__FILE__)."/../config.php");

    $stmt = $conn -> prepare("SELECT title, description, person, type, time FROM alerts WHERE destination='staff'");
	$stmt -> execute();
	$stmt -> bindColumn('title', $titleData);
	$stmt -> bindColumn('description', $descData);
	$stmt -> bindColumn('person', $personData);
	$stmt -> bindColumn('type', $typeData);
	$stmt -> bindColumn('time', $timeData);
	
	while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) {
		echo '<div class="alert alert-'.$typeData.'" role="alert">
				<b>'.$titleData.'</b><br>
				'.$descData.'
				<br><br>
				<b>'.$personData.', on '.$timeData.'</b>
			</div>';
	}
?>