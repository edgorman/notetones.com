<?php
	require_once("../config.php");

	$content = $_POST['content'];
	$searchContent = $_POST['searchContent'];
	$page = ($_POST['page'] - 1) * 5;
	$idArray = array();
	
	if($content == "Date"){
		echo '<div class="col-md-12 col-sm-12 sfxSort">
				<div class="col-md-3 col-sm-6 active" onclick="sfxBar(0, 1, document.sfxSearch.query.value);" title="Sort by Date.">
					Date
				</div>
				<div class="col-md-3 col-md-offset-6 col-sm-6" onclick="sfxBar(1, 1, document.sfxSearch.query.value);" title="Sort by Sound Effect.">
					Sound Effect
				</div>
			</div>';
	}
	else if($content == "Sound Effect"){
		echo '<div class="col-md-12 col-sm-12 sfxSort">
				<div class="col-md-3 col-sm-6 active" onclick="sfxBar(0, 1, document.sfxSearch.query.value);" title="Sort by Sound Effect.">
					Sound Effect
				</div>
				<div class="col-md-3 col-md-offset-6 col-sm-6" onclick="sfxBar(1, 1, document.sfxSearch.query.value);" title="Sort by Date.">
					Date
				</div>
			</div>';
	}
	else{
		echo '<div class="col-md-12 col-sm-12 sfxSort">
				<div class="col-md-12 col-sm-12 sfxSort">
					<div class="col-md-3 col-sm-6" onclick="sfxBar(0, 1, document.sfxSearch.query.value);" title="Sort by Sound Effect.">
						Sound Effect
					</div>
					<div class="col-md-3 col-md-offset-6 col-sm-6" onclick="sfxBar(1, 1, document.sfxSearch.query.value);" title="Sort by Date.">
						Date
					</div>
				</div>
			</div>';
	}
	
	if($searchContent == ""){
		if($content == "Date") {
			$stmt = $conn -> prepare("SELECT id, effect, date, tags, directory FROM public_sfx ORDER BY date DESC LIMIT 5 OFFSET $page");
		    $stmt -> execute();
		    $stmt -> bindColumn('id', $idData);
		    $stmt -> bindColumn('effect', $effectData);
		    $stmt -> bindColumn('date', $dateData);
		    $stmt -> bindColumn('tags', $tagsData);
			$stmt -> bindColumn('directory', $directoryData);
			
      		while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) {
      			if(!in_array($idData, $idArray)) array_push($idArray, $idData);
				
				echo '<div class="col-md-12 col-sm-12 page-header" style="text-align: center;">
						<div class="col-md-3 col-sm-6">
							<b>'.$dateData.'</b>
						</div>
						<div class="col-md-3 col-md-offset-6 col-sm-6 hidden-xs">
							'.$effectData.'
						</div>
						<div style="padding: 45px 0 15px 0;">
						<audio src="../includes/sound/sfx/'.$directoryData.'" preload="none" loop="loop"></audio>
						<a class="sfxDownloadLink" href="../includes/sound/sfx/'.$directoryData.'" download><i class="fa fa-download"></i></a>
						<div class="sfxPlayButton" onclick="sfxAudioToggle(this)"></div>
						</div>
						<div class="col-md-12 hidden-xs" style="font-size: 10px;">
							'.$tagsData.'
						</div>
					</div>';
    		}
		}
		else if($content == "Sound Effect") {
			$stmt = $conn -> prepare("SELECT id, effect, date, tags, directory FROM public_sfx ORDER BY date DESC LIMIT 5 OFFSET $page");
		    $stmt -> execute();
	    	$stmt -> bindColumn('id', $idData);
		    $stmt -> bindColumn('effect', $effectData);
		    $stmt -> bindColumn('date', $dateData);
		    $stmt -> bindColumn('tags', $tagsData);
			$stmt -> bindColumn('directory', $directoryData);
			
      		while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) {
      			if(!in_array($idData, $idArray)) array_push($idArray, $idData);
				
				echo '<div class="col-md-12 col-sm-12 page-header" style="text-align: center;">
							<div class="col-md-3 col-sm-6">
								<b>'.$effectData.'</b>
							</div>
							<div class="col-md-3 col-md-offset-6 col-sm-6 hidden-xs">
								'.$dateData.'
							</div>
							<div style="padding: 45px 0 15px 0;">
							<audio src="../includes/sound/sfx/'.$directoryData.'" preload="none" loop="loop"></audio>
							<a class="sfxDownloadLink" href="../includes/sound/sfx/'.$directoryData.'" download><i class="fa fa-download"></i></a>
							<div class="sfxPlayButton" onclick="sfxAudioToggle(this)"></div>
							</div>
							<div class="col-md-12 hidden-xs" style="font-size: 10px;">
								'.$tagsData.'
							</div>
						</div>';
    		}
		}
	}
	else {
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
		
		if(sizeof($idArray) == 0) echo "<div class='alert alert-danger' style='margin-top: 100px;'>No results returned from search</div>";
		else{
			$tempIdArray = "";
			
			for($i = 0; $i < sizeof($idArray); $i++){
				if($i != 0) $tempIdArray .= ", ";
				$tempIdArray .= "'$idArray[$i]'";
			}
			
			if($content == "Sound Effect") {
				$stmtPrep = "SELECT id, effect, date, tags, directory FROM public_sfx WHERE id IN($tempIdArray) ORDER BY effect LIMIT 5 OFFSET $page";
			}
			else if($content == "Date") {
				$stmtPrep = "SELECT id, effect, date, tags, directory FROM public_sfx WHERE id IN($tempIdArray) ORDER BY date DESC LIMIT 5 OFFSET $page";
			}
			else {
				$stmtPrep = "SELECT id, effect, date, tags, directory FROM public_sfx WHERE id IN($tempIdArray) ORDER BY effect LIMIT 5 OFFSET $page";
			}
			
			$stmt = $conn -> prepare($stmtPrep);
		    $stmt -> execute();
			$stmt -> bindColumn('id', $idData);
			$stmt -> bindColumn('effect', $effectData);
			$stmt -> bindColumn('date', $dateData);
			$stmt -> bindColumn('tags', $tagsData);
			$stmt -> bindColumn('directory', $directoryData);
			
	  		while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) {
				echo '<div class="col-md-12 col-sm-12 page-header" style="text-align: center;">';
				
				if($content == "Date"){
					echo '	<div class="col-md-3 col-sm-6">
								<b>'.$dateData.'</b>
							</div>
							<div class="col-md-3 col-md-offset-6 col-sm-6 hidden-xs">
								'.$effectData.'
							</div>';
				}
				else{
					echo '  <div class="col-md-3 col-sm-6">
								<b>'.$effectData.'</b>
							</div>
							<div class="col-md-3 col-md-offset-6 col-sm-6 hidden-xs">
								'.$dateData.'
							</div>';
				} 
				
				echo '<div style="padding: 45px 0 15px 0;">
					<audio src="../includes/sound/sfx/'.$directoryData.'" preload="none" loop="loop"></audio>
					<a class="sfxDownloadLink" href="../includes/sound/sfx/'.$directoryData.'" download><i class="fa fa-download"></i></a>
					<div class="sfxPlayButton" onclick="sfxAudioToggle(this)"></div>
					</div>
					<div class="col-md-12 hidden-xs" style="font-size: 10px;">
						'.$tagsData.'
					</div>
				</div>';
			}
		}
	}
?>