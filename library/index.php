<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-9" />
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<script src="../bootstrap/js/jquery-2.1.0.min.js"></script>
		<script src="../bootstrap/js/bootstrap.min.js"></script>
		<link type="text/css" rel="stylesheet" href="../bootstrap/css/bootstrap.min.css"/>
		<link type="text/css" rel="stylesheet" href="../includes/css/font-awesome.min.css"/>

		<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css">
		<link href="http://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet" type="text/css">
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet" type="text/css">

		<link rel="shortcut icon" href="../includes/images/Icon.ico">
		<script src="../includes/js/script.js"></script>
		<link type="text/css" rel="stylesheet" href="../includes/css/stylesheet.css"/>
		
		<script src="../includes/sound/audiojs/audio.min.js"></script>
		
		<title>Notetones | Library</title>
	</head>
	<body onload="navbarAnimation(); toggleLibraryType(<?php if(isset($_GET['type'])) echo $_GET['type']; else echo "0";?>);">
		<nav class="navbar navbar-default navbar-fixed-top navbar-main" role="navigation">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse" style="background-color: inherit;">
						<i class="fa fa-bars"> </i>
					</button>
					<a class="navbar-brand" href="../"> <div class="navbar-image"></div> </a>
				</div>
				<div class="navbar-collapse navbar-right collapse">
					<ul class="nav navbar-nav">
						<li>
							<a href="../">Home</a>
						</li>
						<li>
							<a href="../about/">What We Do</a>
						</li>
						<li>
							<a href="../hire_us/">Hire Us</a>
						</li>
						<li>
							<a href="../portfolio/">Portfolio</a>
						</li>
						<li>
							<a class="active" href="../library/">Library</a>
						</li>
						<li>
							<a href="../contact/">Contact</a>
						</li>
						<li>
							<a href="../people/">People</a>
						</li>
						<li>
							<a href="../jobs/">Jobs</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="nav-slider"> </div>
		</nav>
		<div class="container-main">
			<div class="container-fluid">
				<div class="col-md-10 col-md-offset-1">
					<h1 class="pageTitle">PUBLIC LIBRARY</h1>
					<h4 class="textText page-header"> Before downloading any music from our library for the very first time,
					please make sure you fully understand our <a href="http://creativecommons.org/licenses/by-nd/4.0/" target="_blank" style="text-decoration: underline;">licence agreement</a>. </h4>
				</div>
				<div class="col-md-10 col-md-offset-1 librarySort" style="margin-top: 30px;">
					<div class="col-md-4 col-sm-6" onclick="toggleLibraryType(0);">
						<h1>MUSIC</h1>
					</div>
					<div class="col-md-4 col-sm-6" onclick="toggleLibraryType(1);">
						<h1>SFX</h1>
					</div>
					<div class="col-md-4 col-sm-6" onclick="toggleLibraryType(2);">
						<h1>ALBUMS</h1>
					</div>
				</div>
				<!-- MUSIC -->
				<div class="libraryType">
					<div class="col-md-10 col-md-offset-1" style="margin-top: 60px;">
						<form name="musicSearch" method="post" onsubmit="return false;">
							<div class="input-group">
								<input type="text" class="form-control" placeholder="Search!" name="query" value="" style="height: 50px;">
								<input type="reset" value="X" title="Clear Content" style="right: 110px; height: 50px; z-index: 999; position: absolute; cursor: pointer; background-color: transparent; border: 0px solid white;" />
								<div class="input-group-btn">
									<button class="librarySearch" onclick="musicBar(0, 1, document.musicSearch.query.value);">
										<h3><span class="glyphicon glyphicon-search"></span></h3>
									</button>
								</div>
							</div>
						</form>
					</div>
					<div class="col-md-11 col-sm-12 col-xs-12" style=" margin-bottom:20px; float: right; z-index: 500;">
						<div class="input-group-btn musicPagination">
							
						</div>
					</div>
					<div class="col-md-10 col-md-offset-1 col-sm-12 musicTag hidden-xs">
						
					</div>
					<div class="col-md-10 col-md-offset-1 col-sm-12 musicArea">
						<div class="col-md-12 col-sm-12 musicSort">
							<div class="col-md-2 col-sm-3" onclick="musicBar(0, 1, document.musicSearch.query.value);" data-toggle="tooltip" data-placement="top" title="Sort by Track.">
								Track
							</div>
							<div class="col-md-2 col-md-offset-4 col-sm-3" onclick="musicBar(1, 1, document.musicSearch.query.value);" data-toggle="tooltip" data-placement="top" title="Sort by Artist.">
								Artist
							</div>
							<div class="col-md-2 col-sm-3" onclick="musicBar(2, 1, document.musicSearch.query.value);" data-toggle="tooltip" data-placement="top" title="Sort by Genre.">
								Genre
							</div>
							<div class="col-md-2 col-sm-3" onclick="musicBar(3, 1, document.musicSearch.query.value);" data-toggle="tooltip" data-placement="top" title="Sort by Date.">
								Date
							</div>
						</div>
						<script>
							musicBar(4, 1, document.musicSearch.query.value);
						</script>
					</div>
					<div class="col-md-11 col-sm-12 col-xs-12" style="margin-bottom:20px; float: right;">
						<div class="input-group-btn musicPagination">
							
						</div>
					</div>
				</div>
				<!-- SFX -->
				<div class="libraryType">
					<div class="col-md-10 col-md-offset-1" style="margin-top: 60px;">
						<form name="sfxSearch" method="post" onsubmit="return false;">
							<div class="input-group">
								<input type="text" class="form-control" placeholder="Search!" name="query" value="" style="height: 50px;">
								<input type="reset" value="X" title="Clear Content" style="right: 110px; height: 50px; z-index: 999; position: absolute; cursor: pointer; background-color: transparent; border: 0px solid white;" />
								<div class="input-group-btn">
									<button class="librarySearch" onclick="sfxBar(0, 1, document.sfxSearch.query.value);">
										<h3><span class="glyphicon glyphicon-search"></span></h3>
									</button>
								</div>
							</div>
						</form>
					</div>
					<div class="col-md-11 col-sm-12 col-xs-12" style=" margin-bottom:20px; float: right; z-index: 500;">
						<div class="input-group-btn sfxPagination">
							
						</div>
					</div>
					<div class="col-md-10 col-md-offset-1 col-sm-12 sfxTag hidden-xs">
						
					</div>
					<div class="col-md-10 col-md-offset-1 col-sm-12 sfxArea">
						<div class="col-md-12 col-sm-12 sfxSort">
							<div class="col-md-3 col-sm-6" onclick="sfxBar(0, 1, document.sfxSearch.query.value);" title="Sort by Track.">
								Sound Effect
							</div>
							<div class="col-md-3 col-md-offset-6 col-sm-6" onclick="sfxBar(1, 1, document.sfxSearch.query.value);" title="Sort by Date.">
								Date
							</div>
						</div>
						<script>
							sfxBar(0, 1, document.sfxSearch.query.value);
						</script>
					</div>
					<div class="col-md-11 col-sm-12 col-xs-12" style="margin-bottom:20px; float: right;">
						<div class="input-group-btn sfxPagination">
							
						</div>
					</div>
				</div>
				<!-- ALBUMS -->
				<div class="libraryType">
					<div class="col-md-10 col-md-offset-1 col-sm-12" style="margin-top: 60px;">
						<div class="col-md-5">
							<div class="input-group-btn">

							</div>
						</div>
						<div class="col-md-6 col-md-offset-1">
							<!--<form name="sfxSearch" method="post" onsubmit="return false;">
							<div class="input-group">
							<input type="text" class="form-control" placeholder="Search!" name="query" value="">
							<div class="input-group-btn">
							<button class="btn btn-danger" style="height: 34px;" onclick="sfxBar(document.sfxSearch.query.value);">
							<span class="glyphicon glyphicon-search"></span>
							</button>
							</div>
							</div>
							</form>-->
						</div>
					</div>
					<div class="col-md-10 col-md-offset-1 col-sm-12 albumsArea" style="margin-top: 30px; min-height: 130px;">
						<h1 class="pageSubCurly" style="-ms-transform: rotate(17deg); /* IE 9 */-webkit-transform: rotate(17deg); /* Chrome, Safari, Opera */transform: rotate(17deg); text-align : center;">ALBUMS COMING SOON</h1>
					</div>
				</div>
			</div>
		</div>
		<div class="footer"> 
			<div class="row">
				<div class="copyright">
					<div class="col-md-4 col-sm-3 hidden-xs" style="text-align: right;">
						<a href="../" class="copyright-sub">HOME</a>
						<a href="../about/" class="copyright-sub">WHAT WE DO</a>
						<a href="../hire_us/" class="copyright-sub">HIRE US</a>
						<a href="../portfolio/" class="copyright-sub">PORTFOLIO</a>
						<a href="/" class="copyright-sub">LIBRARY</a>
					</div>
					<div class="col-md-4 col-sm-5" style="text-align: center;">
						<a href="../" class="copyright-title">
							NOTETONES MUSIC PRODUCTIONS<br>
							<small>COPYRIGHT <i class="fa fa-copyright"></i> 2015</small><br>
							<small>COMPANY NUMBER: 9347598</small></a>
						<br><br>
						<a href="../"><h1 style="font-weight: bold;" class="hidden-xs">N T</h1></a>
					</div>
					<div class="hidden-sm hidden-md hidden-lg" style="text-align: center;">
						<a href="../" class="copyright-sub">HOME</a>
						<a href="../about/" class="copyright-sub">WHAT WE DO</a>
						<a href="../hire_us/" class="copyright-sub">HIRE US</a>
						<a href="../portfolio/" class="copyright-sub">PORTFOLIO</a>
						<a href="../library/" class="copyright-sub">LIBRARY</a>
					</div>
					<div class="col-md-4 col-sm-3" style="text-align: left;">
						<a href="../contact/" class="copyright-sub">CONTACT</a>
						<a href="../people/" class="copyright-sub">PEOPLE</a>
						<a href="../jobs/" class="copyright-sub">JOBS</a>
						<a href="../login/" class="copyright-sub">STAFF LOGIN</a>
						<a href="../dashboard/" class="copyright-sub">CLIENT DASHBOARD</a>
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
			<a href="http://www.facebook.com/notetones" target="_blank"> <img src="../includes/images/facebook-icon.png"> </a>
			<a href="https://soundcloud.com/notetones" target="_blank"> <img src="../includes/images/soundcloud-icon.png"> </a>
			<a href="http://www.twitter.com/notetones" target="_blank"> <img src="../includes/images/twitter-icon.png"> </a>
			<a href="http://notetones.tumblr.com/" target="_blank"> <img src="../includes/images/tumblr-icon.png"> </a>
			<a href="http://www.youtube.com/notetonesmusic" target="_blank"> <img src="../includes/images/youtube-icon.png"> </a>
			<a href="https://instagram.com/notetones/" target="_blank"> <img src="../includes/images/instagram-icon.jpg"> </a>
		</div>
	</body>
</html>
