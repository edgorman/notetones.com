<?php
    require_once("config.php");
	
	$stmt = $conn -> prepare("SELECT file, captionTitle, captionDesc, captionPos, screenPos FROM carousel ORDER BY torder");
	$stmt -> execute();
	$stmt -> bindColumn('file', $fileData);
	$stmt -> bindColumn('captionTitle', $capTitleData);
	$stmt -> bindColumn('captionDesc', $capDescData);
	$stmt -> bindColumn('captionPos', $capPosData);
	$stmt -> bindColumn('screenPos', $scrPosData);
	$numRows = $stmt -> rowCount();
	
	echo '<ol class="carousel-indicators">';
	for($i = 0; $i < $numRows; $i++){
		if($i == 0) echo '<li data-target="#main-carousel" data-slide-to="0" class="active"></li> ';
		else  echo '<li data-target="#main-carousel" data-slide-to="'.$i.'" class=""></li> ';
	}
	echo '</ol>
	<div class="carousel-inner">';
	
	$i = 0;
	while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) {
		if($i == 0) echo '<div class="item active">';
		else  echo '<div class="item">';
		$i = 1;
		
		echo '<div class="fill" style="background-image:url( &quot; includes/images/carousel/'.$fileData.' &quot;); background-position: '.$scrPosData.';"></div>';
		
		if($capTitleData == "" || $capDescData == ""){
			
		}
		else {
			echo '<div class="carousel-caption '.$capPosData.'">
						<h2 class="caption-title">'.$capTitleData.'</h2>
						<p>'.$capDescData.'</p>
					</div>';
		}
		
		echo '</div>';
	}
	echo '</div>';
?>