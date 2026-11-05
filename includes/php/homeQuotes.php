<?php
    require_once("config.php");
	
	$stmt = $conn -> prepare("SELECT name, quote FROM portfolio ORDER BY name");
	$stmt -> execute();
	$stmt -> bindColumn('name', $nameData);
	$stmt -> bindColumn('quote', $quoteData);
	$displayFirst = false;
	
	while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) {
		if(!($quoteData == "" || $quoteData == " ")){
			if(!$displayFirst) echo '<div class="item active" style="text-align: center;margin: 0px auto;">';
			else echo '<div class="item" style="text-align: center;margin: 0px auto;">';
			
			echo '<div style="margin: 0 auto; width: 80%;">
					<h2 class="pageSubCurly" style="margin: 0 0 5px 0;"><b><a href="portfolio/'.$nameData.'">'.$nameData.'</a></b></h2>
					<b>"</b><i>'.$quoteData.'</i><b>"</b><br><br>
					<a href="portfolio/'.$nameData.'" style="color: #c50000;">Portfolio Page ⇨</a>
				  </div>';
			
			echo '</div>';
			$displayFirst = true;
		}
	}
?>