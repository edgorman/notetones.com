<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-9" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="We are producers of royalty free music including an extensive range of tracks, from orchestral and cinematic to electronica and EDM. We are present on several major platforms such as Youtube and SoundCloud.">

		<script src="bootstrap/js/jquery-2.1.0.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<link type="text/css" rel="stylesheet" href="bootstrap/css/bootstrap.min.css"/>
		<link type="text/css" rel="stylesheet" href="includes/css/font-awesome.min.css"/>

		<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css">
		<link href="http://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet" type="text/css">
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet" type="text/css">

		<link rel="shortcut icon" href="includes/images/Icon.ico">
		<script src="includes/js/script.js"></script>
		<link type="text/css" rel="stylesheet" href="includes/css/stylesheet.css"/>

		<title>Notetones | Music Productions Services</title>
	</head>
	<body onload="navbarAnimation();">
		<nav class="navbar navbar-default navbar-fixed-top navbar-main" role="navigation">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse" style="background-color: inherit;">
						<i class="fa fa-bars"> </i>
					</button>
					<a class="navbar-brand" href=""> <div class="navbar-image"></div> </a>
				</div>
				<div class="navbar-collapse navbar-right collapse">
					<ul class="nav navbar-nav">
						<li>
							<a href="" class="active">Home</a>
						</li>
						<li>
							<a href="about/">What We Do</a>
						</li>
						<li>
							<a href="hire_us/">Hire Us</a>
						</li>
						<li>
							<a href="portfolio/">Portfolio</a>
						</li>
						<li>
							<a href="library/">Library</a>
						</li>
						<li>
							<a href="contact/">Contact</a>
						</li>
						<li>
							<a href="people/">People</a>
						</li>
						<li>
							<a href="jobs/">Jobs</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="nav-slider"> </div>
		</nav>
		<div class="container-main">
			<header id="main-carousel" class="main-carousel carousel slide">
				<?php
					require_once("includes/php/homeCarousel.php");
				?>
				<a class="left carousel-control" href="#main-carousel" data-slide="prev"> <i class="glyphicon glyphicon-chevron-left"></i> </a>
				<a class="right carousel-control" href="#main-carousel" data-slide="next"> <i class="glyphicon glyphicon-chevron-right"></i> </a>
			</header>
			<div class="row">
				<div class="col-md-12 textTitle" style="padding-bottom: 30px;">
					HELLO. 
					WE MAKE MUSIC. 
					:-)
				</div>
				<div class="col-md-10 col-md-offset-1 textText" style="padding: 0 50px 0 50px;">
					Music is pretty damn fundamental in every single creative production.
					Just try to imagine how Lord of the Rings would be without a soundtrack.
					It would suck. It's the same with games, too.
					Skyrim or Minecraft just wouldn't be the same without music.
					It's about generating an atmosphere; one that is appropriate for the project, one that works.
				</div>
			</div>
			<div class="section">
				<div class="row">
					<div class="col-md-12">
						<hr style="margin-top: 30px; margin-bottom: 0; padding: 0;">
						<div id="music-carousel" class="music-carousel carousel slide">
						 	<div class="carousel-inner" style="padding: 0; margin: 0;">
								<?php require_once("includes/php/homeMusic.php") ?>
							</div>
							<a class="left carousel-control-ntversion" href="#music-carousel" data-slide="prev"> 
								<i class="glyphicon glyphicon-chevron-left"></i> 
							</a>
							<a class="right carousel-control-ntversion" href="#music-carousel" data-slide="next" style="padding-left: 0;"> 
								<i class="glyphicon glyphicon-chevron-right" style="padding-left: 0;  margin-left: -10px;"></i>
							</a>
						</div>
						<hr style="margin-top: 0; margin-bottom: 0; padding: 0;">
					</div>
				</div>
				<div class="row">
					<div class="col-md-10 col-md-offset-1 col-sm-12">
						<div class="col-md-4 col-sm-6 featuring">
							<div class="container-fluid">
								<a href="hire_us/#professional"><i class="fa fa-clock-o"></i></a>
								<h4>Professional Service</h4>
								<p>No dilly-dallying.</p>
								<a href="hire_us/#professional">Learn more &#8680;</a>
							</div>
						</div>
						<div class="col-md-4 col-sm-6 featuring">
							<div class="container-fluid" >
								<a href="hire_us/#indies"><a href="about#indies"><i class="fa fa-heart"></i></a>
								<h4>Ideal for Indies</h4>
								<p>Hey, we're just like you.</p>
								<a href="hire_us/#indies">Learn more &#8680;</a>
							</div>
						</div>
						<div class="col-md-4 col-sm-6 featuring">
							<div class="container-fluid" >
								<a href="hire_us/#dashboard"><i class="fa fa-dashboard"></i></a>
								<h4>Client Dashboard</h4>
								<p>Keep track of progress.</p>
								<a href="hire_us/#dashboard">Learn more &#8680;</a>
							</div>
						</div>
						<div class="col-md-4 col-sm-6 featuring">
							<div class="container-fluid" >
								<a href="hire_us/#packages"><i class="fa fa-cogs"></i></a>
								<h4>Flexible Packages</h4>
								<p>Get exactly what you want.</p>
								<a href="hire_us/#packages">Learn more &#8680;</a>
							</div>
						</div>
						<div class="col-md-4 col-sm-6 featuring">
							<div class="container-fluid" >
								<a href="hire_us/#support"><i class="fa fa-bullhorn"></i></a>
								<h4>Unlimited Support</h4>
								<p>Here to help.</p>
								<a href="hire_us/#support">Learn more &#8680;</a>
							</div>
						</div>
						<div class="col-md-4 col-sm-6 featuring">
							<div class="container-fluid" >
								<a href="hire_us/#charges"><i class="fa fa-wrench"></i></a>
								<h4>No Hidden Charges</h4>
								<p>They suck.</p>
								<a href="hire_us/#charges">Learn more &#8680;</a>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<hr style="margin-top: 30px; margin-bottom: 0; padding: 0;">
						<div id="quote-carousel" class="quote-carousel carousel slide">
						 	<div class="carousel-inner" style="padding: 0; margin: 0;">
								<?php require_once('includes/php/homeQuotes.php'); ?>
							</div>
							<a class="left carousel-control-ntversion" href="#quote-carousel" data-slide="prev"> 
								<i class="glyphicon glyphicon-chevron-left"></i> 
							</a>
							<a class="right carousel-control-ntversion" href="#quote-carousel" data-slide="next" style="padding-left: 0;"> 
								<i class="glyphicon glyphicon-chevron-right" style="padding-left: 0; margin-left: -10px;"></i> 
							</a>
						</div>
						<hr style="margin-top: 0; margin-bottom: 0; padding: 0;">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 textTitle" style="padding-top: 30px;">
					SO HERE'S WHAT WE OFFER:
				</div>
				<div class="tier-div">
					<div class="col-md-4">
						<div class="tier">
							<div class="tier-header">
								<h5 style="letter-spacing: 2px; font-weight: bold;">TIER ONE</h5>
								<h3 style="letter-spacing: 3px;">PUBLIC LIBRARY</h3>
							</div>
							<div class="tier-body">
								<div class="tier-pricing" onclick="location.href='hire_us/'">
									<h1 style="margin: 28px auto;">£0</h1>
								</div>
								<h6 style="letter-spacing: 2px; font-weight: bold;">PER TRACK</h6>
							</div>
							<div class="tier-footer">
								<h5 style="letter-spacing: 1px; line-height: 30px;">
									If you're after something quick, take a dip into our ever-growing public library of royalty free music. 
									Be sure to check the licence, but you can use it for just about anything. 
									You can find them on this very website, in the 'Library' tab, or just by clicking below!
								</h5>
								<br><br>
								<a href="library/" class="tier-button">TAKE ME THERE</a>
								<br><br><br>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="tier">
							<div class="tier-header">
								<h5 style="letter-spacing: 2px; font-weight: bold;">TIER TWO</h5>
								<h3 style="letter-spacing: 3px;">INDIVIDUAL COMMISSIONS</h3>
							</div>
							<div class="tier-body">
								<div class="tier-pricing" onclick="location.href='hire_us/'">
									<h3 style="margin: 35px auto;">£0.80</h3>
								</div>
								<h6 style="letter-spacing: 2px; font-weight: bold;">PER TRACK</h6>
							</div>
							<div class="tier-footer">
								<h5 style="letter-spacing: 1px; line-height: 30px;">
									We can work with you to create a few super-awesome custom pieces of fabulous music, 
									voiceover or sound effect on an individual basis for you to use in your project. 
									Each piece is bespoke and never used elsewhere. (Unless you want it to be)
								</h5>
								<br><br>
								<a href="contact/" class="tier-button">GET IN TOUCH</a>
								<br><br><br>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="tier">
							<div class="tier-header">
								<h5 style="letter-spacing: 2px; font-weight: bold;">TIER THREE</h5>
								<h3 style="letter-spacing: 3px;">FULL-SCALE PROJECT</h3>
							</div>
							<div class="tier-body">
								<div class="tier-pricing" onclick="location.href='hire_us/'">
									<h2 style="margin: 33px auto;">£30</h2>
								</div>
								<h6 style="letter-spacing: 2px; font-weight: bold;">PER BUNDLE</h6>
							</div>
							<div class="tier-footer">
								<h5 style="letter-spacing: 1px; line-height: 30px;">
									Hiring us to create the entire OST for your game or the entire score for your film will be the best decision you make all year. 
									Letting us handle all boring parts of music will allow you to focus on the parts of your project that really matter to you.
								</h5>
								<br><br>
								<a href="contact/" class="tier-button">GET IN TOUCH</a>
								<br><br><br>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<br>
		<div class="footer"> 
			<div class="row">
				<div class="copyright">
					<div class="col-md-4 col-sm-3 hidden-xs" style="text-align: right;">
						<a href="" class="copyright-sub">HOME</a>
						<a href="about/" class="copyright-sub">WHAT WE DO</a>
						<a href="hire_us/" class="copyright-sub">HIRE US</a>
						<a href="portfolio/" class="copyright-sub">PORTFOLIO</a>
						<a href="library/" class="copyright-sub">LIBRARY</a>
					</div>
					<div class="col-md-4 col-sm-5" style="text-align: center;">
						<a href="" class="copyright-title">
							NOTETONES MUSIC PRODUCTIONS<br>
							<small>COPYRIGHT <i class="fa fa-copyright"></i> 2015</small><br>
							<small>COMPANY NUMBER: 9347598</small></a>
						<br><br>
						<a href=""><h1 style="font-weight: bold;" class="hidden-xs">N T</h1></a>
					</div>
					<div class="hidden-sm hidden-md hidden-lg" style="text-align: center;">
						<a href="" class="copyright-sub">HOME</a>
						<a href="about/" class="copyright-sub">WHAT WE DO</a>
						<a href="hire_us/" class="copyright-sub">HIRE US</a>
						<a href="portfolio/" class="copyright-sub">PORTFOLIO</a>
						<a href="library/" class="copyright-sub">LIBRARY</a>
					</div>
					<div class="col-md-4 col-sm-3" style="text-align: left;">
						<a href="contact/" class="copyright-sub">CONTACT</a>
						<a href="people/" class="copyright-sub">PEOPLE</a>
						<a href="jobs/" class="copyright-sub">JOBS</a>
						<a href="login/" class="copyright-sub">STAFF LOGIN</a>
						<a href="dashboard/" class="copyright-sub">CLIENT DASHBOARD</a>
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
			<a href="http://www.facebook.com/notetones" target="_blank"> <img src="includes/images/facebook-icon.png"> </a>
			<a href="https://soundcloud.com/notetones" target="_blank"> <img src="includes/images/soundcloud-icon.png"> </a>
			<a href="http://www.twitter.com/notetones" target="_blank"> <img src="includes/images/twitter-icon.png"> </a>
			<a href="http://notetones.tumblr.com/" target="_blank"> <img src="includes/images/tumblr-icon.png"> </a>
			<a href="http://www.youtube.com/notetonesmusic" target="_blank"> <img src="includes/images/youtube-icon.png"> </a>
			<a href="https://instagram.com/notetones/" target="_blank"> <img src="includes/images/instagram-icon.jpg"> </a>
		</div>
	</body>
</html>
