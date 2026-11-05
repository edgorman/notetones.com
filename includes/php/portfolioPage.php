<?php
	require_once("config.php");
	
	$stmt = $conn -> prepare("SELECT id, name, description, quote, site, logo, SCLink, tracknum, tier, type FROM portfolio ORDER BY id");
    $stmt -> execute();
	$stmt -> bindColumn('id', $idData);
	$stmt -> bindColumn('name', $nameData);
	$stmt -> bindColumn('description', $descData);
	$stmt -> bindColumn('quote', $quoteData);
	$stmt -> bindColumn('site', $siteData);
	$stmt -> bindColumn('logo', $logoData);
	$stmt -> bindColumn('SCLink', $SCLinkData);
	$stmt -> bindColumn('tracknum', $tracknumData);
	$stmt -> bindColumn('tier', $tierData);
	$stmt -> bindColumn('type', $typeData);
	
	$toggleSideData = "right";
	while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) {
		
		if($logoData != "fa-users") echo '<div style="width: 100%; overflow: hidden;"><div class="col-md-7 col-xs-12 col-xs-offset-0 portfolio-case '.$toggleSideData.'" style="background-image: url(&quot;../includes/images/portfolio/'.$logoData.'&quot;);">';
		else echo '<div style="width: 100%; overflow: hidden;"><div class="col-md-7 col-xs-12 col-xs-offset-0 portfolio-case '.$toggleSideData.'" style="background-image: url(&quot;../includes/images/portfolio/default.jpg&quot;);">';
		
		echo '	<div class="overlay"></div>
					<div class="content">
						<b><h1>'.strtoupper($nameData).'</h1></b>
						<br>';
		
		if(!($siteData == " " || $siteData == "")) echo '<div class="col-md-6 col-xs-12"><a href="'.$nameData.'"><button class="button-link active" style="padding-top: 5px;"><h6>VIEW PORTFOLIO</h6></button></a></div><div class="col-md-6 col-xs-12"><a href="'.$siteData.'" target="_blank"><button class="button-link active" style="padding-top: 5px;"><h6>VIEW WEBSITE</h6></button></a></div>';
		else echo '<div class="col-md-12 col-xs-12"><a href="'.$nameData.'"><button class="button-link active" style="padding-top: 5px;"><h6>VIEW PORTFOLIO</h6></button></a></div>';
				
		/*	*/
		echo '		</div>
					<div class="side-banner hidden-sm hidden-xs">
						<b>TRACKS PRODUCED: '.$tracknumData.'</b>
						<br>
						<br>
						<b>TIER TYPE: '.$tierData.'</b>
						<br>
						<br>
						<b>PRODUCTION: '.$typeData.'</b>
					</div>
				</div>
			  </div>
			  <div class="col-md-12"><hr style="border: 1px solid white;"></div>';
			
		if($toggleSideData == "right") $toggleSideData = "left";
		else if($toggleSideData == "left") $toggleSideData = "right";
	}
?>