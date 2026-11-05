<?php
	session_start();
	
	require_once ("includes/php/config.php");
	require_once ("includes/php/loginCheck.php");
	
	require_once ("includes/php/upload/audioUpload.php");
	require_once ("includes/php/upload/imageUpload.php");
	require_once ("includes/php/upload/deleteFile.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-9" />
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<script src="bootstrap/js/jquery-2.1.0.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<script src="bootstrap/switch-master/dist/js/bootstrap-switch.min.js"></script>
		<link type="text/css" rel="stylesheet" href="bootstrap/css/bootstrap.min.css"/>
		<link type="text/css" rel="stylesheet" href="includes/css/font-awesome.min.css"/>
		<link type="text/css" rel="stylesheet" href="includes/css/sidebar.css"/>
		<link href="bootstrap/switch-master/dist/css/bootstrap3/bootstrap-switch.min.css" rel="stylesheet">

		<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css">
		<link href="http://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet" type="text/css">
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet" type="text/css">

		<link rel="shortcut icon" href="../includes/images/Icon.ico">
		<script src="includes/js/script.js"></script>
		<link type="text/css" rel="stylesheet" href="includes/css/stylesheet.css"/>

		<title>Notetones | Edit Site</title>
	</head>
	<body>
		<?php require_once("includes/php/chat/createChat.php"); ?>
		<script>loadOnline(<?php echo $myLevelData.", ".$_SESSION['id'] ?>); setInterval(function(){if($('#online').hasClass('open'))loadOnline(<?php echo $myLevelData.", ".$_SESSION['id'] ?>);},1000);</script>
		<div class="online" onclick="loadOnline(<?php echo $myLevelData.", ".$_SESSION['id'] ?>);">	
			<div class="btn-group dropup" id="online">
				<button type="button" class="btn btn-default dropdown-toggle btn-custom" data-toggle="dropdown">Online Now</button>
				<ul class="dropdown-menu online-drop" role="menu">
				     
				</ul>
			</div>
		</div>
		<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="home.php">Welcome, <?php echo ucfirst($myNicknameData);?></a>
				</div>
				<div class="navbar-ajax-progress">
					
				</div>
				<div class="navbar-collapse collapse">
					<ul class="nav navbar-nav navbar-right">
						<li>
							<a class="dropdown-toggle" href="settings.php"> <i class="glyphicon glyphicon-user"> </i> Settings </a>
						</li>
						<li>
							<a class="dropdown-toggle" href="../" target="_blank"> <i class="glyphicon glyphicon-home"> </i> Notetones.com </a>
						</li>
						<li>
							<a class="dropdown-toggle" href="includes/php/logout.php"> <i class="glyphicon glyphicon-log-out"> </i> Logout </a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="container-main">
			<div class="container-wrapper">
				<div class="sidebar-wrapper">
					<ul class="sidebar-nav">
						<?php require_once("includes/php/home/homeSidebar.php"); ?>
					</ul>
				</div>
				<div class="sidebar-toggle">
					<a href="#menu-toggle" class="menu-toggle btn btn-default">
						<i class="fa fa-toggle-left"> </i>
					</a>
				</div>
				<div class="page-content-wrapper">
					<div class="container-fluid">
						<h1 class="page-header">
							Edit Website<br><br>
							<small id="PlatformDate"></small>
							<script>
								var date = new Date(); 
								document.getElementById('PlatformDate').innerHTML = date.toDateString() + " " + date.toLocaleTimeString();
								
								setInterval(function(){
									var date = new Date();
									
									document.getElementById('PlatformDate').innerHTML = date.toDateString() + " " + date.toLocaleTimeString();
								},1000);
							</script>
						</h1>
						<h1 class="page-header" data-toggle="collapse" data-target="#createCarousel" style="cursor: pointer;" id="carousel">
							Carousel <a class="btn" style="float: right;">Collapse Table&raquo;</a>
							<br>
							<p class="btn">The carousel that can be seen on the main page of notetones.com</p>
						</h1>
						<?php 
							echo '<div class="collapse in" id="createCarousel">';
							require_once("includes/php/site/carousel/loadCarousel.php");
							echo '</div>';
						?>
						<h1 class="page-header" data-toggle="collapse" data-target="#createVacancies" style="cursor: pointer; padding-top: 20px;" id="jobs">
							Vacancies <a class="btn" style="float: right;">Collapse Table&raquo;</a>
							<br>
							<p class="btn">Update job vacancies and openings, also sends email to all recipients when a new vacancy is created.</p>
						</h1>
						<?php 
							echo '<div class="collapse in" id="createVacancies">';
							require_once("includes/php/site/vacancies/loadVacancies.php");
							echo '</div>';
						?>
						<h1 class="page-header" data-toggle="collapse" data-target="#createPeople" style="cursor: pointer; padding-top: 20px;" id="staff">
							People <a class="btn" style="float: right;">Collapse Table&raquo;</a>
							<br>
							<p class="btn">The staff of Notetones displayed on the people page of notetones.com</p>
						</h1>
						<?php 
							echo '<div class="collapse in" id="createPeople">';
							require_once("includes/php/site/people/loadPeople.php");
							echo '</div>';
						?>
						<h1 class="page-header" data-toggle="collapse" data-target="#createLibrary" style="cursor: pointer; padding-top: 20px;" id="library">
							Library <a class="btn"  style="float: right;">Collapse Table&raquo;</a>
							<br>
							<p class="btn">A store of Notetones music, available to tier one users.</p>
						</h1>
						<?php 
							echo '<p>To enter a soundlcoud track <i>(SCLink)</i>, go to the track on <a href="https://soundcloud.com" target="_blank" style="color: blue;">soundcloud.com</a> 
							click the share icon, "Embed" heading, and copy the "Code & Preview" text. Then paste it into the table, and it will automatically find the desired number.</p>';
							
							echo '<div class="collapse in" id="createLibrary">';
							require_once("includes/php/site/library/loadLibrary.php");
							echo '</div>';
						?>
						<h1 class="page-header" data-toggle="collapse" data-target="#createSfx" style="cursor: pointer; padding-top: 20px;" id="sfx">
							Sound Effects <a class="btn"  style="float: right;">Collapse Table&raquo;</a>
							<br>
							<p class="btn">A store of Notetones SFX dispalyed in the library.</p>
						</h1>
						<?php 
							echo '<div class="collapse in" id="createSfx">';
							require_once("includes/php/site/sfx/loadSfx.php");
							echo '</div>';
						?>
						<h1 class="page-header" data-toggle="collapse" data-target="#createPortfolio" style="cursor: pointer; padding-top: 20px;" id="portfolio">
							Portfolio <a class="btn" style="float: right;">Collapse Table&raquo;</a>
							<br>
							<p class="btn">A collection of our past clients.</p>
						</h1>
						<?php 
							echo '<div class="collapse in" id="createPortfolio">';
							require_once("includes/php/site/portfolio/loadPortfolio.php");
							echo '</div><br>';
							
							echo '<p>To enter a soundlcoud playlist <i>(SCLink)</i>, go to the playlist on <a href="https://soundcloud.com" target="_blank" style="color: blue;">soundcloud.com</a> 
							click the share icon, "Embed" heading, and copy the "Code & Preview" text. Then paste it into the table, and it will automatically find the desired number.</p>';
							
							echo '<div class="collapse in" id="createPortfolioLinks">';
							require_once("includes/php/site/portfolio/loadPortfolioLinks.php");
							echo '</div>';
						?>
					</div>
				</div>
			</div>
		</div>
		<script>$('.sidebar-wrapper').scrollTop($('.sidebar-wrapper #editSite').offset().top);</script>
	</body>
</html>