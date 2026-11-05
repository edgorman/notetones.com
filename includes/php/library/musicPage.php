<?php
	require_once("../config.php");
	
    $content = $_POST['content'];
	$searchContent = $_POST['searchContent'];
	$page = $_POST['page'];
	$idArray = array();
	
	if($searchContent == ""){
		$stmt = $conn -> prepare("SELECT id FROM public_library");
	    $stmt -> execute();
		$stmt -> bindColumn('id', $idData);
		
  		while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) {
  			if(!in_array($idData, $idArray)) array_push($idArray, $idData);
		}
	}
	else {
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
	}
	
	$maxPage = ceil((sizeof($idArray)) / 5);
	
	if($content == "Popular") $content = 4;
	else $content = 0;
	
	if($page <= 1) echo '<button class="btn btn-danger disabled" style="height: 34px;" onclick="musicBar('.$content.', '.($page - 1).', document.musicSearch.query.value);">Prev</button>';
	else echo '<button class="btn btn-danger" style="height: 34px;" onclick="musicBar('.$content.', '.($page - 1).', document.musicSearch.query.value);">Prev</button>';
	
	echo '<span class="musicPaginationHidden">';
	for($i = 1; $i < $maxPage + 1; $i++){
		if(!($i == 0 || $maxPage == 0)){
			if($i == $page) echo '</span><button class="btn btn-danger active" style="height: 34px;" onclick="musicBar('.$content.', '.$i.', document.musicSearch.query.value);">'.$i.'</button><span class="musicPaginationHidden">';
			else echo '<button class="btn btn-danger musicPaginationHidden" style="height: 34px;" onclick="musicBar('.$content.', '.$i.', document.musicSearch.query.value);">'.$i.'</button>';
		}	
	}
	echo '</span>';
	
	if($page >= $maxPage) echo '<button class="btn btn-danger disabled" style="height: 34px;" onclick="musicBar('.$content.', '.($page + 1).', document.musicSearch.query.value);">Next</button>';
	else echo '<button class="btn btn-danger" style="height: 34px;" onclick="musicBar('.$content.', '.($page + 1).', document.musicSearch.query.value);">Next</button>';
?>