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
		<link type="text/css" rel="stylesheet" href="bootstrap/css/bootstrap.min.css"/>
		<link type="text/css" rel="stylesheet" href="includes/css/font-awesome.min.css"/>
		<link type="text/css" rel="stylesheet" href="includes/css/sidebar.css"/>

		<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css">
		<link href="http://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet" type="text/css">
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet" type="text/css">

		<link rel="shortcut icon" href="../includes/images/Icon.ico">
		<script src="includes/js/script.js"></script>
		<link type="text/css" rel="stylesheet" href="includes/css/stylesheet.css"/>

		<title>Notetones | Settings</title>
	</head>
	<body>
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
							<a class="dropdown-toggle" href="home.php"> <i class="glyphicon glyphicon-user"> </i> Home </a>
						</li>
						<li>
							<a data-original-title="Help?" class="dropdown-toggle" style="cursor: pointer;" onclick="$('#firstTime').modal('show');" rel="tooltip" title=""> <i class="glyphicon glyphicon-info-sign"></i></a>
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
					<div class="row">
						<div class="col-lg-6 col-md-12">
							<h1 class="page-header" id="nickname" style="margin-top: 20px;">
								Update Nickname
								<br>
								<p style="font-size: 14px; margin-top: 10px; line-height: 20px; cursor: default;">
									This is the name that will be seen by the Notetones staff.
								</p>
							</h1>
							<?php 
								echo '<div id="updateNickname">';	
								require_once("includes/php/settings/nickname/loadNickname.php");
								echo '</div>';
							?>
							<h1 class="page-header" id="password">
								New Password
								<br>
								<p style="font-size: 14px; margin-top: 10px; line-height: 20px; cursor: default;">
									Here you can change your password. If you ever forget your password please contact the Notetones staff 
									using your email address seen below, who will reset your password.
									<br>
									Please enter your old password, followed by the new password twice.
								</p>
							</h1>
							<?php 
								echo '<div id="updatePassword">';	
								require_once("includes/php/settings/password/loadPassword.php");
								echo '</div>';
							?>
							<h1 class="page-header" id="contact">
								Update Contact Info
								<br>
								<p style="font-size: 14px; margin-top: 10px; line-height: 20px; cursor: default;">
									This information will be used as contact information for the Notetones staff.
								</p>
							</h1>
							<?php 
								echo '<div id="updateContact">';
								require_once("includes/php/settings/contact/loadContact.php");
								echo '</div>';
							?>
						</div>
					</div>
					<?php
						require_once('includes/php/dash/commission/commissionProgress.php');
					?>
				</div>
			</div>
		</div>
	</body>
</html>