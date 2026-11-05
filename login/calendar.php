<?php
	session_start();
	
	require_once ("includes/php/config.php");
	require_once ("includes/php/loginCheck.php");
	
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

		<title>Notetones | Calendar</title>
	</head>
	<body onload="toggleCalendarType(0, 0);">
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
						<div class="calendarType"> <!-- month -->
							<h1 class="page-header">
								Notetones Calendar
							</h1>
							<table class="calendarTable"></table>
						</div>
						<div class="calendarType"> <!-- day -->
							<h1 class="page-header">
								Notetones Calendar - Day
							</h1>
							<table class="calendarTable"></table>
						</div>
						<div class="calendarType"> <!-- new -->
							<h1 class="page-header">
								Notetones Calendar - New Event
							</h1>
							<table class="calendarTable"></table>
						</div>
						<div class="calendarType"> <!-- edit -->
							<h1 class="page-header">
								Notetones Calendar - Edit Event
							</h1>
							<table class="calendarTable"></table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>