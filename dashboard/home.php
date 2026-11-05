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
		
		<script type="text/javascript" src="includes/flot/jquery.flot.js"></script>
		<script type="text/javascript" src="includes/flot/jquery.flot.pie.min.js"></script>
		<script type="text/javascript" src="includes/flot/jquery.flot.time.min.js"></script>
		<script type="text/javascript" src="includes/flot/jquery.flot.stack.min.js"></script>
		<script type="text/javascript" src="includes/flot/jquery.flot.resize.min.js"></script>
		<script type="text/javascript" src="includes/flot/jquery.flot.axislabels.js"></script>
		<script type="text/javascript" src="includes/flot/jquery.flot.tooltip.js"></script>

		<link rel="shortcut icon" href="../includes/images/Icon.ico">
		<script src="includes/js/script.js"></script>
		<link type="text/css" rel="stylesheet" href="includes/css/stylesheet.css"/>

		<title>Notetones | Home</title>
	</head>
	<body>
		<?php require_once('includes/php/home/firstTime.php'); ?>
		<?php require_once('includes/php/dash/tracks/addTrack.php'); ?>
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
						<div class="col-lg-12 col-md-12">
							<?php
								require_once('includes/php/home/homeAlerts.php');
							?>
						</div>
						<div class="col-lg-8 col-md-12 main-graph">
							<div id="commission-line-graph-0" style="width: 100%; height: 100%;"></div>
							<div class="commission-line-graph-overlay">
								<i class="fa fa-info" data-toggle="tooltip" data-placement="left" title="Graph to show the total time spent on your commission overall."></i>
							</div>
						</div>
						<script>
							<?php
								require_once('includes/php/dash/commission/commissionGraph.php');
							?>
							
							$(document).ready(function() {
								var clg =  {label: " Time Spent Overall",  data: dataCLG, color: 'red'};
								$.plot($("#commission-line-graph-0"), [clg], {
									xaxis : {
										axisLabel: 'Days Elapsed',
								        axisLabelUseCanvas: true,
								        axisLabelFontSizePixels: 12,
								        axisLabelFontFamily: 'Verdana, Arial, Helvetica, Tahoma, sans-serif',
								        axisLabelPadding: 5,
								        min: 1,
								        tickLength: 0,
								        tickDecimals: 0
									},yaxis : {
										axisLabel: 'Hours Spent',
								        axisLabelUseCanvas: true,
								        axisLabelFontSizePixels: 12,
								        axisLabelFontFamily: 'Verdana, Arial, Helvetica, Tahoma, sans-serif',
								        axisLabelPadding: 5,
								        min: 0,
								        tickLength: 0,
								        tickDecimals: 0
									},series: {
										lines: {
				    	        			show: true,
							    			fill: false
										},
										points: {
			    							show: false
			           					}
									},grid: {
										borderWidth: 0
									},legend: {
										show: false,
										noColumns: 2,
										labelBoxBorderColor: "none",
										position: "right"
									}
								});
							});
						</script>
						<div class="col-lg-4 col-md-12 main-status">
							<div class="col-lg-12 col-md-12">
								<?php
									require_once('includes/php/dash/commission/commissionStatus.php')
								?>
							</div>
							<div class="col-lg-12 col-md-12">
								<?php
									require_once('includes/php/dash/commission/commissionPhase.php')
								?>
							</div>
						</div>
						<div class="col-lg-12 col-md-12"><hr></div>
					</div>
					<div class="main-commission">
						<?php
							require_once('includes/php/dash/tracks/loadTracks.php');
						?>
					</div>
					<?php
						require_once('includes/php/dash/commission/commissionProgress.php');
					?>
				</div>
			</div>
		</div>
	</body>
</html>