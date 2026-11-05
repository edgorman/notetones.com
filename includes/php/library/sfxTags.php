<?php
	require_once("../config.php");
	
	$searchContent = $_POST['searchContent'];
	$idArray = array();
	$contentTerms = explode(' ',$searchContent);
	
	for($i = 0; $i < sizeof($contentTerms); $i++){
		$stmt = $conn -> prepare("SELECT id FROM public_sfx WHERE tags LIKE '%$contentTerms[$i]%'");
		$stmt -> execute();
		$stmt -> bindColumn('id', $idData);
		
		while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) {
			if(!in_array($idData, $idArray)) array_push($idArray, $idData);
		}
	}
	
	for($i = 0; $i < sizeof($contentTerms); $i++){
		$stmt = $conn -> prepare("SELECT id FROM public_sfx WHERE effect LIKE '%$contentTerms[$i]%'");
		$stmt -> execute();
		$stmt -> bindColumn('id', $idData);
		
		while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) {
			if(!in_array($idData, $idArray)) array_push($idArray, $idData);
		}
	}
	
	for($i = 0; $i < sizeof($contentTerms); $i++){
		$stmt = $conn -> prepare("SELECT id FROM public_sfx WHERE date LIKE '%$contentTerms[$i]%'");
		$stmt -> execute();
		$stmt -> bindColumn('id', $idData);
		
		while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) {
			if(!in_array($idData, $idArray)) array_push($idArray, $idData);
		}
	}
	
	$condArray = array("effect","tags");
	$usedArray = array();
	
	if(sizeof($idArray) >= 1){
		for($i = 0; $i < 5; $i++){
			$conditionData = $condArray[(rand(0,1))];
			$effectDataId = rand(1,(sizeof($idArray))) - 1;
			$effectData = $idArray[$effectDataId];
			
			$stmt = $conn -> prepare("SELECT ".$conditionData." FROM public_sfx WHERE id= :idData");
			$stmt -> bindParam(":idData", $effectData);
			$stmt -> execute();
			$stmt -> bindColumn($conditionData, $tagData);
			
			while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) {
				if($conditionData == "tags"){
					$tagData = explode(",",$tagData);
					$tagData = trim($tagData[rand(0,(sizeof($tagData)) - 1)]);
				}
				
				if(!in_array($tagData, $usedArray)) {
					array_push($usedArray, $tagData);
					
					echo '<a onclick="document.sfxSearch.query.value= &quot;'.$tagData.'&quot; ; sfxBar(0, 1, document.sfxSearch.query.value);">';
					
					if($conditionData == "tags"){
						echo '<span class="tag label label-success music-tag">'.ucfirst($tagData).'<span data-role="remove"></span></span>';
					}
					else if($conditionData == "effect"){
						echo '<span class="tag label label-danger music-tag">'.ucfirst($tagData).'<span data-role="remove"></span></span>';
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