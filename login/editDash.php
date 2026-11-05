<?php
	session_start();
	
	require_once ("includes/php/config.php");
	require_once ("includes/php/loginCheck.php");
	
	require_once ("includes/php/upload/audioUpload.php");
	require_once ("includes/php/upload/pdfUpload.php");
	require_once ("includes/php/upload/zipUpload.php");
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

		<title>Notetones | Client Dash</title>
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
							Client Dash<br><br>
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
						<h1 class="page-header" data-toggle="collapse" data-target="#createCommission" style="cursor: pointer;" id="commission">
							Commission <a class="btn" style="float: right;">Collapse Table &raquo;</a>
							<br>
							<p class="btn">Update information about each clients commission. <a href="editClient.php" style="color: blue;">Click here to update basic info about each commission</a>.</p>
						</h1>
						<?php 
							echo '<div class="collapse in" id="createCommission">';	
							require_once("includes/php/dash/commission/loadCommStats.php");
							echo '</div>';
						?>
						<h1 class="page-header" data-toggle="collapse" data-target="#createTracks" style="cursor: pointer;" id="tracks">
							Client Tracks <a class="btn" style="float: right;">Collapse Table &raquo;</a>
							<br>
							<p class="btn">Create, update and delete tracks we've been commissioned to create by our clients.</p>
						</h1>
						<?php 
							echo '<div class="collapse in" id="createTracks">';	
							require_once("includes/php/dash/tracks/loadTracks.php");
							echo '</div>';
						?>
						<h1 class="page-header" data-toggle="collapse" data-target="#createProducers" style="cursor: pointer;" id="producers">
							Producers <a class="btn" style="float: right;">Collapse Table &raquo;</a>
							<br>
							<p class="btn">Assign and update producers hours for each track that we are commissioned to create by out clients.</p>
						</h1>
						<?php 
							echo '<div class="collapse in" id="createProducers">';	
							require_once("includes/php/dash/producers/loadProducers.php");
							echo '</div>';
						?>
					</div>
				</div>
			</div>
		</div>
		<script>$('.sidebar-wrapper').scrollTop($('.sidebar-wrapper #editDash').offset().top);</script>
	</body>
</html>