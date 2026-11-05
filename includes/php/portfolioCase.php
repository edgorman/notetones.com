<?php
    require_once("config.php");
	
	$url = basename($_SERVER['REQUEST_URI']);
	$url = str_replace("%20"," ",$url);
	
	$stmt = $conn -> prepare("SELECT id, name, description, quote, site, logo, SCLink, youtube, twitter, soundcloud, facebook, tracknum, tier, type FROM portfolio WHERE name= :nameData");
	$stmt -> bindParam(":nameData", $url);
    $stmt -> execute();
	$stmt -> bindColumn("id", $idData);
	$stmt -> bindColumn("name", $nameData);
	$stmt -> bindColumn("description", $descData);
	$stmt -> bindColumn("quote", $quoteData);
	$stmt -> bindColumn("site", $siteData);
	$stmt -> bindColumn("logo", $logoData);
	$stmt -> bindColumn("SCLink", $SCLinkData);
	$stmt -> bindColumn("youtube", $youtubeData);
	$stmt -> bindColumn("twitter", $twitterData);
	$stmt -> bindColumn("soundcloud", $soundCloudData);
	$stmt -> bindColumn("facebook", $facebookData);
	$stmt -> bindColumn("tracknum", $trackNData);
	$stmt -> bindColumn("tier", $tierData);
	$stmt -> bindColumn("type", $typeData);
	
	while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) {}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-9" />
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<script src="../../bootstrap/js/jquery-2.1.0.min.js"></script>
		<script src="../../bootstrap/js/bootstrap.min.js"></script>
		<link type="text/css" rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css"/>
		<link type="text/css" rel="stylesheet" href="../../includes/css/font-awesome.min.css"/>

		<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css">
		<link href="http://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet" type="text/css">
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet" type="text/css">

		<link rel="shortcut icon" href="../../includes/images/Icon.ico">
		<script src="../../includes/js/script.js"></script>
		<link type="text/css" rel="stylesheet" href="../../includes/css/stylesheet.css"/>

		<title>Notetones | <?php echo $nameData; ?></title>
	</head>
	<body onload="navbarAnimation()">
		<nav class="navbar navbar-default navbar-fixed-top navbar-main" role="navigation">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse" style="background-color: inherit;">
						<i class="fa fa-bars"> </i>
					</button>
					<a class="navbar-brand" href="../../"> <div class="navbar-image"></div> </a>
				</div>
				<div class="navbar-collapse navbar-right collapse">
					<ul class="nav navbar-nav">
						<li>
							<a href="../../">Home</a>
						</li>
						<li>
							<a href="../../about/">What We Do</a>
						</li>
						<li>
							<a href="../../hire_us/">Hire Us</a>
						</li>
						<li>
							<a class="active" href="../../portfolio/">Portfolio</a>
						</li>
						<li>
							<a href="../../library/">Library</a>
						</li>
						<li>
							<a href="../../contact/">Contact</a>
						</li>
						<li>
							<a href="../../people/">People</a>
						</li>
						<li>
							<a href="../../jobs/">Jobs</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="nav-slider"> </div>
		</nav>
		<div class="container-main">
			<div class="row">
				<div class="col-lg-3 portfolio-case-left">
					<div class="portfolio-case-image">
						<img src="../../includes/images/portfolio/<?php echo $logoData; ?>"/>
						<div class="overlay">NT</div>
						<a href="../"><div class="link">CLICK HERE TO GO BACK</div></a>
					</div>
					<h2><?php echo $nameData; ?></h2>
					<h6 style="text-align: center;"><i class="fa fa-clock-o" style="padding-right: 10px;"></i> Production Type: <?php echo $typeData; ?></h6>
					<h6 style="text-align: center;"><i class="fa fa-tasks" style="padding-right: 10px;"></i> Tier Level: <?php echo $tierData; ?></h6>
					<div class="content">
						<?php if(!($facebookData == " " || $facebookData == "")) echo '<a href="'.$facebookData.'" target="_blank"><i class="fa fa-facebook"></i> facebook.com</a> <br>';?>
						<?php if(!($soundCloudData == " " || $soundCloudData == "")) echo '<a href="'.$soundCloudData.'" target="_blank"><i class="fa fa-soundcloud"></i> soundcloud.com</a> <br>';?>
						<?php if(!($twitterData == " " || $twitterData == "")) echo '<a href="'.$twitterData.'" target="_blank"><i class="fa fa-twitter"></i> twitter.com</a> <br>';?>
						<?php if(!($youtubeData == " " || $youtubeData == "")) echo '<a href="'.$youtubeData.'" target="_blank"><i class="fa fa-youtube-play"></i> youtube.com</a> <br>';?>
						<?php if(!($siteData == " " || $siteData == "")) echo '<a href="'.$siteData.'" target="_blank"><i class="fa fa-globe"></i> '.$siteData.'</a> <br>';?>
						<hr>
					</div>
					<blockquote>
	            		<p style="line-height: 20px; font-size: 13px;">
	            			<?php echo $quoteData; ?>
	        			</p>
	        			<small><?php echo $nameData; ?></small>
		         	</blockquote>
					<hr class="hidden-lg">
				</div>
				<div class="col-lg-9 portfolio-case-right">
					<h1 class="about-title hidden-xs hidden-sm hidden-md" style="color: black; padding-top: 0; margin: 0 0 20px 0; text-align: center; text-transform: uppercase;"><?php echo $nameData; ?></h1>
					<p style="line-height: 30px; font-size: 20px;">
						<?php echo $descData; ?>
					</p>
					<?php
						if(!($SCLinkData == " " || $SCLinkData == "")){
							echo '<iframe width="100%" height="560" scrolling="no" frameborder="no" 
							src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/playlists/'.$SCLinkData.'&amp;color=F00&amp;auto_play=false&amp;hide_related=false&amp;show_comments=false&amp;show_user=true&amp;show_reposts=false"></iframe>';
						}
						else{
					?>
					<div class="alert alert-info">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<b>Unfortunately we don't have a track/playlist to show you examples of their commission, 
						however you can find the company on these following websites.</b>
					</div>
					<div class="content">
						<div class="row" style="padding-top: 0; margin-left: 0;">
							<?php if(!($facebookData == " " || $facebookData == "")) echo '<a href="'.$facebookData.'" target="_blank"><div class="col-sm-4 col-xs-12" style="background-color: #3b5999; color: white;"><i class="fa fa-facebook"></i></div></a>';?>
							<?php if(!($soundCloudData == " " || $soundCloudData == "")) echo '<a href="'.$soundCloudData.'" target="_blank"><div class="col-sm-5 col-xs-12" style="background-color: #ff7700; color: white;"><i class="fa fa-soundcloud"></i></div></a>';?>
							<?php if(!($twitterData == " " || $twitterData == "")) echo '<a href="'.$twitterData.'" target="_blank"><div class="col-sm-5 col-xs-12" style="background-color: #1dcaff; color: white;"><i class="fa fa-twitter"></i></div></a>';?>
							<?php if(!($youtubeData == " " || $youtubeData == "")) echo '<a href="'.$youtubeData.'" target="_blank"><div class="col-sm-4 col-xs-12" style="background-color: #e52d27; color: white;"><i class="fa fa-youtube-play"></i></div></a>';?>
							<?php if(!($siteData == " " || $siteData == "")) echo '<a href="'.$siteData.'" target="_blank"><div class="col-sm-5 col-xs-12" style="background-color: #222222; color: white;"><i class="fa fa-globe"></i></div></a>';?>
						</div>
					</div>
					<?php
						}
					?>
				</div>
			</div>
		</div>
		<br><br>
		<div class="footer"> 
			<div class="row">
				<div class="copyright">
					<div class="col-md-4 col-sm-3 hidden-xs" style="text-align: right;">
						<a href="../../" class="copyright-sub">HOME</a>
						<a href="../../about/" class="copyright-sub">WHAT WE DO</a>
						<a href="../../hire_us/" class="copyright-sub">HIRE US</a>
						<a href="../portfolio/" class="copyright-sub">PORTFOLIO</a>
						<a href="../../library/" class="copyright-sub">LIBRARY</a>
					</div>
					<div class="col-md-4 col-sm-5" style="text-align: center;">
						<a href="../../" class="copyright-title">
							NOTETONES MUSIC PRODUCTIONS<br>
							<small>COPYRIGHT <i class="fa fa-copyright"></i> 2015</small><br>
							<small>COMPANY NUMBER: 9347598</small></a>
						<br><br>
						<a href="../../"><h1 style="font-weight: bold;" class="hidden-xs">N T</h1></a>
					</div>
					<div class="hidden-sm hidden-md hidden-lg" style="text-align: center;">
						<a href="../../" class="copyright-sub">HOME</a>
						<a href="../../about/" class="copyright-sub">WHAT WE DO</a>
						<a href="../../hire_us/" class="copyright-sub">HIRE US</a>
						<a href="../portfolio/" class="copyright-sub">PORTFOLIO</a>
						<a href="../../library/" class="copyright-sub">LIBRARY</a>
					</div>
					<div class="col-md-4 col-sm-3" style="text-align: left;">
						<a href="../../contact/" class="copyright-sub">CONTACT</a>
						<a href="../../people/" class="copyright-sub">PEOPLE</a>
						<a href="../../jobs/" class="copyright-sub">JOBS</a>
						<a href="../../login/" class="copyright-sub">STAFF LOGIN</a>
						<a href="../../dashboard/" class="copyright-sub">CLIENT DASHBOARD</a>
					</div>
				</div>
			</div>
		</div>
		<div class="footer-bottom">
			<div class="row">
				<div class="copyright">
					<div class="col-sm-12 copyright-social-links" style="text-align: center;">
						<a href="http://www.facebook.com/notetones" target="_blank"> <i class="fa fa-facebook-official"></i> </a>
						<a href="http://www.soundcloud.com/notetones" target="_blank"> <i class="fa fa-soundcloud"></i> </a>
						<a href="http://www.twitter.com/notetones" target="_blank"> <i class="fa fa-twitter"></i> </a>
						<a href="http://www.notetones.tumblr.com/notetones" target="_blank"> <i class="fa fa-tumblr"></i> </a>
						<a href="http://www.youtube.com/notetonesmusic" target="_blank"> <i class="fa fa-youtube-play"></i> </a>
						<a href="https://instagram.com/notetones/" target="_blank"> <i class="fa fa-instagram"></i> </a>
					</div>
				</div>
			</div>
		</div>
		<div class="social">
			<a href="http://www.facebook.com/notetones" target="_blank"> <img src="../../includes/images/facebook-icon.png"> </a>
			<a href="https://soundcloud.com/notetones" target="_blank"> <img src="../../includes/images/soundcloud-icon.png"> </a>
			<a href="http://www.twitter.com/notetones" target="_blank"> <img src="../../includes/images/twitter-icon.png"> </a>
			<a href="http://notetones.tumblr.com/" target="_blank"> <img src="../../includes/images/tumblr-icon.png"> </a>
			<a href="http://www.youtube.com/notetonesmusic" target="_blank"> <img src="../../includes/images/youtube-icon.png"> </a>
			<a href="https://instagram.com/notetones/" target="_blank"> <img src="../../includes/images/instagram-icon.jpg"> </a>
		</div>
	</body>
</html>