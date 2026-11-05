<?php
	require(dirname(__FILE__)."/../config.php");

    $stmt = $conn -> prepare("SELECT title, description, person, type, time FROM alerts WHERE destination= :destinationData");
	$stmt -> bindParam(":destinationData", $myIdData);
	$stmt -> execute();
	$stmt -> bindColumn('title', $titleData);
	$stmt -> bindColumn('description', $descData);
	$stmt -> bindColumn('person', $personData);
	$stmt -> bindColumn('type', $typeData);
	$stmt -> bindColumn('time', $timeData);
	
	while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) {
		echo '<div class="alert alert-'.$typeData.'">
				<a href="#" class="close" data-dismiss="alert" aria-label="close" onclick="$(this.parentElement).toggle()">&times;</a>
				<b>'.$titleData.'</b><br>
				'.$descData.'
				<br><br>
				<b>Notetones Staff, on '.$timeData.'</b>
			</div>';
	}
?>