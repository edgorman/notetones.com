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

		<title>Notetones | Home</title>
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
							Notetones Resource Platform<br><br>
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
						<?php
							require_once("includes/php/alerts/homeAlerts.php");
						?>
						<div class="row">
							<div class="col-lg-6 col-md-12">
								<h1 class="page-header">
									Upcoming Tracks
								</h1>
								<?php 
									require_once("includes/php/home/upcomingTracks.php");
								?>
							</div>
							<div class="col-lg-6 col-md-12">
								<h1 class="page-header">
									Upcoming Absences
								</h1>
								<?php 
									require_once("includes/php/home/upcomingAbs.php");
								?>
							</div>
						</div>
						<h1 class="page-header" id="contact">
							Contact List
						</h1>
						<?php
							echo "<div style='padding-bottom: 30px;'>";
							require_once("includes/php/home/homeContact.php");
							echo "</div>";
						?>
						</h1>
						<?php
							if($myLevelData == 1 || $myLevelData == 2){
								echo '<div class="col-lg-6 col-md-12">
										<h1 class="page-header" id="clientlock">
											Client Lock Out
										</h1>
										<p>
											This feature allows you to temporarily block the clients from the 
											<a style="color:blue;" href="../dashboard" target="_blank">Dashboard</a>. 
											It will display a message informing them that the service is temporarily down due to maintenance.
											If a client is already logged in, the page will not display the block message, it will wait until 
											they click onto another page before displaying the message.
										</p>';
								echo '<div id="homeClientLock" style="padding-bottom: 30px; text-align: center;"><br>';
								require_once("includes/php/home/dashboardLock/loadLock.php");
								echo '</div>
									</div>';
								
								
								echo '<div class="col-lg-6 col-md-12">
										<h1 class="page-header" id="jobsubs">
											Openings Email List
										</h1>';
								
								echo '<div id="homeJobList" style="padding-bottom: 30px;">';
								require_once("includes/php/home/emailList.php");
								echo '</div>
									</div>';
									
								echo '<div class="col-lg-12 col-md-12">
										<h1 class="page-header" id="login">
											Staff Logins
										</h1>
										<p>
											Similarly to client lockout, this allows you to disable specific accounts to
											 prevent them from logging in.
										</p>';
								
								echo '<div id="createLogin">';
								require_once("includes/php/home/staffLogin/loadLogin.php");
								echo '</div>
									</div>';
								
								echo '<div class="col-lg-12 col-md-12">
										<h1 class="page-header" id="alerts">
											Create Alerts
										</h1>
										<p>
											Choose between info, succcess, warning, and danger depending on your message. 
											Your name and the date will automatically be added. 
											The changes will be applied the next time you reload the page.
										</p>';
								
								echo '<div id="createAlerts">';
								require_once("includes/php/alerts/loadAlerts.php");
								echo '</div>
									</div>';
							}
						?>
					</div>
				</div>
			</div>
		</div>
		<script>$('.sidebar-wrapper').scrollTop($('.sidebar-wrapper').offset().top);</script>
	</body>
</html>