<?php
	require_once("../config.php");

	$content = $_POST['content'];
	$searchContent = $_POST['searchContent'];
	$page = ($_POST['page'] - 1) * 5;
	$idArray = array();
	
	if($content == "Artist"){
		echo '	<div class="col-md-12 col-sm-12 musicSort">
					<div class="col-md-2 col-sm-3 active" title="Order by Popularity" onclick="musicBar(4, 1, document.musicSearch.query.value);">
						Artist
					</div>
					<div class="col-md-2 col-sm-3 col-md-offset-4" title="Order by Track" onclick="musicBar(1, 1, document.musicSearch.query.value);">
						Track
					</div>
					<div class="col-md-2 col-sm-3" title="Order by Genre" onclick="musicBar(2, 1, document.musicSearch.query.value);">
						Genre
					</div>
					<div class="col-md-2 col-sm-3" title="Order by Date" onclick="musicBar(3, 1, document.musicSearch.query.value);">
						Date
					</div>
				</div>';
	}
	else if($content == "Genre"){
		echo '	<div class="col-md-12 col-sm-12 musicSort">
					<div class="col-md-2 col-sm-3 active" title="Order by Popularity" onclick="musicBar(4, 1, document.musicSearch.query.value);">
						Genre
					</div>
					<div class="col-md-2 col-sm-3 col-md-offset-4" title="Order by Track" onclick="musicBar(1, 1, document.musicSearch.query.value);">
						Track
					</div>
					<div class="col-md-2 col-sm-3" title="Order by Artist" onclick="musicBar(2, 1, document.musicSearch.query.value);">
						Artist
					</div>
					<div class="col-md-2 col-sm-3" title="Order by Date" onclick="musicBar(3, 1, document.musicSearch.query.value);">
						Date
					</div>
				</div>';
	}
	else if($content == "Date"){
		echo '	<div class="col-md-12 col-sm-12 musicSort">
					<div class="col-md-2 col-sm-3 active" title="Order by Popularity" onclick="musicBar(4, 1, document.musicSearch.query.value);">
						Date
					</div>
					<div class="col-md-2 col-sm-3 col-md-offset-4" title="Order by Track" onclick="musicBar(1, 1, document.musicSearch.query.value);">
						Track
					</div>
					<div class="col-md-2 col-sm-3" onclick="musicBar(2, 1, document.musicSearch.query.value);">
						Artist
					</div>
					<div class="col-md-2 col-sm-3" onclick="musicBar(3, 1, document.musicSearch.query.value);">
						Genre
					</div>
				</div>';
	}
	else if($content == "Track"){
		echo '	<div class="col-md-12 col-sm-12 musicSort">
					<div class="col-md-2 col-sm-3 active" title="Order by Popularity" onclick="musicBar(4, 1, document.musicSearch.query.value);">
						Track
					</div>
					<div class="col-md-2 col-sm-3 col-md-offset-4" title="Order by Artist" onclick="musicBar(1, 1, document.musicSearch.query.value);">
						Artist
					</div>
					<div class="col-md-2 col-sm-3" title="Order by Genre" onclick="musicBar(2, 1, document.musicSearch.query.value);">
						Genre
					</div>
					<div class="col-md-2 col-sm-3" title="Order by Date" onclick="musicBar(3, 1, document.musicSearch.query.value);">
						Date
					</div>
				</div>';
	}
	else{
		echo '	<div class="col-md-12 col-sm-12 musicSort">
					<div class="col-md-2 col-sm-3" title="Order by Track" onclick="musicBar(0, 1, document.musicSearch.query.value);">
						Track
					</div>
					<div class="col-md-2 col-sm-3 col-md-offset-4" title="Order by Artist" onclick="musicBar(1, 1, document.musicSearch.query.value);">
						Artist
					</div>
					<div class="col-md-2 col-sm-3" title="Order by Genre" onclick="musicBar(2, 1, document.musicSearch.query.value);">
						Genre
					</div>
					<div class="col-md-2 col-sm-3" title="Order by Date" onclick="musicBar(3, 1, document.musicSearch.query.value);">
						Date
					</div>
				</div>';
	}
	
	if($searchContent == ""){
		if($content == "Track") {
			$stmt = $conn -> prepare("SELECT id, track, artist, date, genre, tags, SCLink FROM public_library ORDER BY track LIMIT 5 OFFSET $page");
		    $stmt -> execute();
		    $stmt -> bindColumn('id', $idData);
		    $stmt -> bindColumn('track', $trackData);
			$stmt -> bindColumn('artist', $artistData);
			$stmt -> bindColumn('date', $dateData);
			$stmt -> bindColumn('genre', $genreData);
			$stmt -> bindColumn('tags', $tagsData);
			$stmt -> bindColumn('SCLink', $SCLinkData);
			
      		while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) {
      			if(!in_array($idData, $idArray)) array_push($idArray, $idData);
				
				echo '<div class="col-md-12 col-sm-12 page-header" style="text-align: center;">
							<div class="col-md-2 col-sm-3">
								<b>'.$trackData.'</b>
							</div>
							<div class="col-md-2 col-sm-3 col-md-offset-4 hidden-xs">
								'.$artistData.'
							</div>
							<div class="col-md-2 col-sm-3 hidden-xs">
								'.$genreData.'
							</div>
							<div class="col-md-2 col-sm-3 hidden-xs">
								'.$dateData.'
							</div>
							<iframe width="100%" height="166" scrolling="no" frameborder="no" 
							src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/
							'.$SCLinkData.'&amp;color=C50000&amp;auto_play=false&amp;hide_related=false&amp;show_comments=false&amp;
							show_user=true&amp;show_reposts=false"></iframe>
							<div class="col-md-12 hidden-xs" style="font-size: 10px;">
								'.$tagsData.'
							</div>
						</div>';
			}
		}
		else if($content == "Artist") {
			$stmt = $conn -> prepare("SELECT id, track, artist, date, genre, tags, SCLink FROM public_library ORDER BY artist LIMIT 5 OFFSET $page");
		    $stmt -> execute();
	    	$stmt -> bindColumn('id', $idData);
		    $stmt -> bindColumn('track', $trackData);
			$stmt -> bindColumn('artist', $artistData);
			$stmt -> bindColumn('date', $dateData);
			$stmt -> bindColumn('genre', $genreData);
			$stmt -> bindColumn('tags', $tagsData);
			$stmt -> bindColumn('SCLink', $SCLinkData);
			
      		while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) {
      			if(!in_array($idData, $idArray)) array_push($idArray, $idData);
				
				echo '<div class="col-md-12 col-sm-12 page-header" style="text-align: center;">
							<div class="col-md-2 col-sm-3">
								<b>'.$artistData.'</b>
							</div>
							<div class="col-md-2 col-sm-3 col-md-offset-4 hidden-xs">
								'.$trackData.'
							</div>
							<div class="col-md-2 col-sm-3 hidden-xs">
								'.$genreData.'
							</div>
							<div class="col-md-2 col-sm-3 hidden-xs">
								'.$dateData.'
							</div>
							<iframe width="100%" height="166" scrolling="no" frameborder="no" 
							src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/
							'.$SCLinkData.'&amp;color=C50000&amp;auto_play=false&amp;hide_related=false&amp;show_comments=false&amp;
							show_user=true&amp;show_reposts=false"></iframe>
							<div class="col-md-12 hidden-xs" style="font-size: 10px;">
								'.$tagsData.'
							</div>
						</div>';
			}
		}
		else if($content == "Genre") {
			$stmt = $conn -> prepare("SELECT id, track, artist, date, genre, tags, SCLink FROM public_library ORDER BY genre LIMIT 5 OFFSET $page");
		    $stmt -> execute();
	    	$stmt -> bindColumn('id', $idData);
		    $stmt -> bindColumn('track', $trackData);
			$stmt -> bindColumn('artist', $artistData);
			$stmt -> bindColumn('date', $dateData);
			$stmt -> bindColumn('genre', $genreData);
			$stmt -> bindColumn('tags', $tagsData);
			$stmt -> bindColumn('SCLink', $SCLinkData);
			
      		while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) {
      			if(!in_array($idData, $idArray)) array_push($idArray, $idData);
				
				echo '<div class="col-md-12 col-sm-12 page-header" style="text-align: center;">
							<div class="col-md-2 col-sm-3">
								<b>'.$genreData.'</b>
							</div>
							<div class="col-md-2 col-sm-3 col-md-offset-4 hidden-xs">
								'.$trackData.'
							</div>
							<div class="col-md-2 col-sm-3 hidden-xs">
								'.$artistData.'
							</div>
							<div class="col-md-2 col-sm-3 hidden-xs">
								'.$dateData.'
							</div>
							<iframe width="100%" height="166" scrolling="no" frameborder="no" 
							src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/
							'.$SCLinkData.'&amp;color=C50000&amp;auto_play=false&amp;hide_related=false&amp;show_comments=false&amp;
							show_user=true&amp;show_reposts=false"></iframe>
							<div class="col-md-12 hidden-xs" style="font-size: 10px;">
								'.$tagsData.'
							</div>
						</div>';
    		
			}
		}
		else if($content == "Date") {
			$stmt = $conn -> prepare("SELECT id, track, artist, date, genre, tags, SCLink FROM public_library ORDER BY date DESC LIMIT 5 OFFSET $page");
		    $stmt -> execute();
	    	$stmt -> bindColumn('id', $idData);
		    $stmt -> bindColumn('track', $trackData);
			$stmt -> bindColumn('artist', $artistData);
			$stmt -> bindColumn('date', $dateData);
			$stmt -> bindColumn('genre', $genreData);
			$stmt -> bindColumn('tags', $tagsData);
			$stmt -> bindColumn('SCLink', $SCLinkData);
			
      		while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) {
      			if(!in_array($idData, $idArray)) array_push($idArray, $idData);
				
				echo '<div class="col-md-12 col-sm-12 page-header" style="text-align: center;">
							<div class="col-md-2 col-sm-3">
								<b>'.$dateData.'</b>
							</div>
							<div class="col-md-2 col-sm-3 col-md-offset-4 hidden-xs">
								'.$trackData.'
							</div>
							<div class="col-md-2 col-sm-3 hidden-xs">
								'.$artistData.'
							</div>
							<div class="col-md-2 col-sm-3 hidden-xs">
								'.$genreData.'
							</div>
							<iframe width="100%" height="166" scrolling="no" frameborder="no" 
							src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/
							'.$SCLinkData.'&amp;color=C50000&amp;auto_play=false&amp;hide_related=false&amp;show_comments=false&amp;
							show_user=true&amp;show_reposts=false"></iframe>
							<div class="col-md-12 hidden-xs" style="font-size: 10px;">
								'.$tagsData.'
							</div>
						</div>';
    		
			}
		}
		else if($content == "Popular"){
			$stmt = $conn -> prepare("SELECT id, track, artist, date, genre, tags, favourite, SCLink FROM public_library ORDER BY favourite DESC, track ASC LIMIT 5 OFFSET $page");
		    $stmt -> execute();
	    	$stmt -> bindColumn('id', $idData);
		    $stmt -> bindColumn('track', $trackData);
			$stmt -> bindColumn('artist', $artistData);
			$stmt -> bindColumn('date', $dateData);
			$stmt -> bindColumn('genre', $genreData);
			$stmt -> bindColumn('tags', $tagsData);
			$stmt -> bindColumn('favourite', $favouriteData);
			$stmt -> bindColumn('SCLink', $SCLinkData);
			
			$displayStaffPick = true;
			$displayRemainPick = true;
			
      		while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) {
      			if(!in_array($idData, $idArray)) array_push($idArray, $idData);
				
				if($favouriteData && $displayStaffPick){
					$displayStaffPick = false;
					echo '<div class="col-md-12 col-sm-12 page-header" style="border-bottom: 1px solid #C50000; color: #C50000;"><h1 class="pageSubCurly">Staff Picks</h1></div>';
				}
				else if(!$favouriteData && $displayRemainPick) {
					$displayRemainPick = false;
					echo '<div class="col-md-12 col-sm-12 page-header" style="border-bottom: 1px solid #C50000; color: #C50000;"><h1 class="pageSubCurly">Remaining Tracks</h1></div>';
				}
				
				if($displayRemainPick){
					echo '<div class="col-md-4 col-sm-12 page-header" style="text-align: center;">
							<iframe width="100%" height="350" scrolling="no" frameborder="no"
							src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/
							'.$SCLinkData.'&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;
							show_reposts=false&amp;visual=true"></iframe>
						</div>';
				}
				else{
					echo '<div class="col-md-12 col-sm-12 page-header" style="text-align: center;">
							<div class="col-md-2 col-sm-3">
								<b>'.$trackData.'</b>
							</div>
							<div class="col-md-2 col-sm-3 col-md-offset-4 hidden-xs">
								'.$artistData.'
							</div>
							<div class="col-md-2 col-sm-3 hidden-xs">
								'.$genreData.'
							</div>
							<div class="col-md-2 col-sm-3 hidden-xs">
								'.$dateData.'
							</div>
							<iframe width="100%" height="166" scrolling="no" frameborder="no" 
							src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/
							'.$SCLinkData.'&amp;color=C50000&amp;auto_play=false&amp;hide_related=false&amp;show_comments=false&amp;
							show_user=true&amp;show_reposts=false"></iframe>
							<div class="col-md-12 hidden-xs" style="font-size: 10px;">
								'.$tagsData.'
							</div>
						</div>';
				}
			}
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
		
		if(sizeof($idArray) == 0) echo "<div class='alert alert-danger' style='margin-top: 100px;'>No results returned from search</div>";
		else{
			$tempIdArray = "";
			
			for($i = 0; $i < sizeof($idArray); $i++){
				if($i != 0) $tempIdArray .= ", ";
				$tempIdArray .= "'$idArray[$i]'";
			}
			
			if($content == "Artist") {
				$stmtPrep = "SELECT id, track, artist, date, genre, tags, SCLink FROM public_library WHERE id IN($tempIdArray) ORDER BY artist LIMIT 5 OFFSET $page";
			}
			else if($content == "Genre") {
				$stmtPrep = "SELECT id, track, artist, date, genre, tags, SCLink FROM public_library WHERE id IN($tempIdArray) ORDER BY genre LIMIT 5 OFFSET $page";
			}
			else if($content == "Date") {
				$stmtPrep = "SELECT id, track, artist, date, genre, tags, SCLink FROM public_library WHERE id IN($tempIdArray) ORDER BY date DESC LIMIT 5 OFFSET $page";
			}
			else {
				$stmtPrep = "SELECT id, track, artist, date, genre, tags, SCLink FROM public_library WHERE id IN($tempIdArray) ORDER BY track LIMIT 5 OFFSET $page";
			}
			
			
			$stmt = $conn -> prepare($stmtPrep);
		    $stmt -> execute();
		    $stmt -> bindColumn('id', $idData);
			$stmt -> bindColumn('track', $trackData);
			$stmt -> bindColumn('artist', $artistData);
			$stmt -> bindColumn('date', $dateData);
			$stmt -> bindColumn('genre', $genreData);
			$stmt -> bindColumn('tags', $tagsData);
			$stmt -> bindColumn('SCLink', $SCLinkData);
			
	  		while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) {
				echo '<div class="col-md-12 col-sm-12 page-header" style="text-align: center;">';
				
				if($content == "Artist") {
					echo '<div class="col-md-2 col-sm-3">
								<b>'.$artistData.'</b>
							</div>
							<div class="col-md-2 col-sm-3 col-md-offset-4 hidden-xs">
								'.$trackData.'
							</div>
							<div class="col-md-2 col-sm-3 hidden-xs">
								'.$genreData.'
							</div>
							<div class="col-md-2 col-sm-3 hidden-xs">
								'.$dateData.'
							</div>';
				}
				else if($content == "Genre"){
					echo '<div class="col-md-2 col-sm-3">
								<b>'.$genreData.'</b>
							</div>
							<div class="col-md-2 col-sm-3 col-md-offset-4 hidden-xs">
								'.$trackData.'
							</div>
							<div class="col-md-2 col-sm-3 hidden-xs">
								'.$artistData.'
							</div>
							<div class="col-md-2 col-sm-3 hidden-xs">
								'.$dateData.'
							</div>';
				}
				else if($content == "Date"){
					echo '<div class="col-md-2 col-sm-3">
								<b>'.$dateData.'</b>
							</div>
							<div class="col-md-2 col-sm-3 col-md-offset-4 hidden-xs">
								'.$trackData.'
							</div>
							<div class="col-md-2 col-sm-3 hidden-xs">
								'.$artistData.'
							</div>
							<div class="col-md-2 col-sm-3 hidden-xs">
								'.$genreData.'
							</div>';
				}
				else{
					echo '<div class="col-md-2 col-sm-3">
								<b>'.$trackData.'</b>
							</div>
							<div class="col-md-2 col-sm-3 col-md-offset-4 hidden-xs">
								'.$artistData.'
							</div>
							<div class="col-md-2 col-sm-3 hidden-xs">
								'.$genreData.'
							</div>
							<div class="col-md-2 col-sm-3 hidden-xs">
								'.$dateData.'
							</div>';
				} 
				
				echo '<iframe width="100%" height="166" scrolling="no" frameborder="no" 
					src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/
					'.$SCLinkData.'&amp;color=C50000&amp;auto_play=false&amp;hide_related=false&amp;show_comments=false&amp;
					show_user=true&amp;show_reposts=false"></iframe>
					<div class="col-md-12 hidden-xs" style="font-size: 10px;">
						'.$tagsData.'
					</div>
				</div>';
			}
		}
	}
?>