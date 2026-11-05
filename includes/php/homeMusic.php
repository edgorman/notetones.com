<?php
    require_once("config.php");
	
	$stmt = $conn -> prepare("SELECT SCLink FROM public_library ORDER BY date DESC LIMIT 3");
	$stmt -> execute();
	$stmt -> bindColumn('SCLink', $SCLinkData);
	$displayFirst = false;
	
	while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) {
		if(!$displayFirst) echo '<div class="item active" style="text-align: center;margin: 0px auto;">';
		else echo '<div class="item" style="text-align: center;margin: 0px auto;">';
		
		echo '<iframe width="80%" height="180px;" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/'.$SCLinkData.'&amp;color=C50000&amp;auto_play=false&amp;hide_related=false&amp;show_comments=false&amp;show_user=true&amp;show_reposts=false&amp;"></iframe>';
		
		echo '</div>';
		$displayFirst = true;		
	}
?>