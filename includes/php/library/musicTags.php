<?php
	require_once("../config.php");
	
	$searchContent = $_POST['searchContent'];
	$idArray = array();
	$contentTerms = explode(' ',$searchContent);
	
	for($i = 0; $i < sizeof($contentTerms); $i++){
		$stmt = $conn -> prepare("SELECT id FROM public_library WHERE tags LIKE '%$contentTerms[$i]%'");
		$stmt -> execute();
		$stmt -> bindColumn('id', $idData);
		
		while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) {
			if(!in_array($idData, $idArray)) array_push($idArray, $idData);
		}
	}
	
	for($i = 0; $i < sizeof($contentTerms); $i++){
		$stmt = $conn -> prepare("SELECT id FROM public_library WHERE artist LIKE '%$contentTerms[$i]%'");
		$stmt -> execute();
		$stmt -> bindColumn('id', $idData);
		
		while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) {
			if(!in_array($idData, $idArray)) array_push($idArray, $idData);
		}
	}
	
	for($i = 0; $i < sizeof($contentTerms); $i++){
		$stmt = $conn -> prepare("SELECT id FROM public_library WHERE track LIKE '%$contentTerms[$i]%'");
		$stmt -> execute();
		$stmt -> bindColumn('id', $idData);
		
		while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) {
			if(!in_array($idData, $idArray)) array_push($idArray, $idData);
		}
	}
	
	for($i = 0; $i < sizeof($contentTerms); $i++){
		$stmt = $conn -> prepare("SELECT id FROM public_library WHERE genre LIKE '%$contentTerms[$i]%'");
		$stmt -> execute();
		$stmt -> bindColumn('id', $idData);
		
		while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) {
			if(!in_array($idData, $idArray)) array_push($idArray, $idData);
		}
	}
	
	for($i = 0; $i < sizeof($contentTerms); $i++){
		$stmt = $conn -> prepare("SELECT id FROM public_library WHERE date LIKE '%$contentTerms[$i]%'");
		$stmt -> execute();
		$stmt -> bindColumn('id', $idData);
		
		while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) {
			if(!in_array($idData, $idArray)) array_push($idArray, $idData);
		}
	}
	
	$condArray = array("artist","track","genre","tags");
	$usedArray = array();
	
	if(sizeof($idArray) >= 1){
		for($i = 0; $i < 5; $i++){
			$conditionData = $condArray[(rand(0,3))];
			$trackDataId = rand(1,(sizeof($idArray))) - 1;
			$trackData = $idArray[$trackDataId];
			
			$stmt = $conn -> prepare("SELECT ".$conditionData." FROM public_library WHERE id= :idData");
			$stmt -> bindParam(":idData", $trackData);
			$stmt -> execute();
			$stmt -> bindColumn($conditionData, $tagData);
			
			while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) {
				if($conditionData == "tags"){
					$tagData = explode(",",$tagData);
					$tagData = trim($tagData[rand(0,(sizeof($tagData)) - 1)]);
				}
				
				if(!in_array($tagData, $usedArray)) {
					array_push($usedArray, $tagData);
					
					echo '<a onclick="document.musicSearch.query.value= &quot;'.$tagData.'&quot; ; musicBar(0, 1, document.musicSearch.query.value);">';
					
					if($conditionData == "tags"){
						echo '<span class="tag label label-success music-tag">'.ucfirst($tagData).'<span data-role="remove"></span></span>';
					}
					else if($conditionData == "artist"){
						echo '<span class="tag label label-danger music-tag">'.ucfirst($tagData).'<span data-role="remove"></span></span>';
					}
					else if($conditionData == "genre"){
						echo '<span class="tag label label-warning music-tag">'.ucfirst($tagData).'<span data-role="remove"></span></span>';
					}
					else {
						echo '<span class="tag label label-info music-tag">'.ucfirst($tagData).'<span data-role="remove"></span></span>';
					}
					
					echo '</a>';
				}
			}
		}
	}
	
?>