<?php
   	echo '
		<li class="sidebar-brand">
			<a href="home.php">Dashboard</a>
		</li>
		<li>
			<a href="home.php#contact"><i class="fa fa-user"> </i> Contact List</a>
		</li>';
		
	if($myLevelData == 1 || $myLevelData == 2){
		echo '<li>
				<a href="home.php#clientlock"><i class="fa fa-lock"> </i> Client Lock Out</a>
			  </li>';
		echo '<li>
				<a href="home.php#jobsubs"><i class="fa fa-envelope"> </i> Job Sub List</a>
			  </li>';
		echo '<li>
				<a href="home.php#login"><i class="fa fa-users"> </i> Staff Login</a>
			  </li>';
		echo '<li>
				<a href="home.php#alerts"><i class="fa fa-bell"> </i> Create Alerts</a>
			  </li>';
	}
	
	echo'<li>
			<a href="https://server91.web-hosting.com:2096/" target="_blank"><i class="fa fa-envelope"> </i> Webmail Portal</a>
		</li>
		<li>
			<a href="http://www.notetones.com/cpanel" target="_blank"><i class="fa fa-external-link"> </i> cPanel Portal</a>
		</li>
		<li>
			<a href="../dashboard/" target="_blank"><i class="fa fa-dashboard"> </i> Dashboard</a>
		</li>
		<li>
			<a data-target="#socialCollapse" data-toggle="collapse" aria-expanded="true" style="cursor:pointer;"><i class="fa fa-caret-down"> </i> Social Sites</a>
		</li>
		<div class="collapse" id="socialCollapse">
			<li>
				<a href="http://www.soundcloud.com/notetones" target="_blank" style="font-weight:bold; padding-left: 15px;"> Soundcloud Portal</a>
			</li>
			<li>
				<a href="http://www.youtube.com/notetonesmusic" target="_blank" style="font-weight:bold; padding-left: 15px;"> Youtube Portal</a>
			</li>
			<li>
				<a href="http://www.facebook.com/notetones" target="_blank" style="font-weight:bold; padding-left: 15px;"> Facebook Portal</a>
			</li>
			<li>
				<a href="http://www.notetones.bandcamp.com" target="_blank" style="font-weight:bold; padding-left: 15px;"> Bandcamp Portal</a>
			</li>
			<li>
				<a href="http://www.motionelements.com/artists/notetones" target="_blank" style="font-weight:bold; padding-left: 15px;"> Motion Elements Portal</a>
			</li>
		</div>
		<li>
			<a href="calendar.php"><i class="fa fa-calendar"> </i> Calendar Portal</a>
		</li>
		<li>
			<a href="https://docs.google.com/spreadsheets/d/1cn_Y5PkNEb0dqSbiUmP6RCSLq70FWipP4k2iAPBh__U/edit?usp=sharing" target="_blank"><i class="fa fa-calendar"> </i> Upload Schedule</a>
		</li>
		<li>
			<a href="https://drive.google.com/drive/folders/0B722g5MPoQJKWGRwTlNVWGwwSUU" target="_blank"><i class="fa fa-music"> </i> Track Dump</a>
		</li>
		<li>
			<a href="http://goo.gl/forms/FX2dB0qFE8" target="_blank"><i class="fa fa-info"> </i> Incident Form</a>
		</li>';

	//EDIT SITE
	
	if($myLevelData == 1 || $myLevelData == 2 || $myLevelData == 3){
		echo '<br>
				<hr style=" border-top: 1px solid #444;" id="editSite">
				<li class="sidebar-brand">
					<a href="editSite.php">Edit Website</a>
				</li>
				<li>
					<a href="editSite.php#carousel">Carousel</a>
				</li>
				<li>
					<a href="editSite.php#jobs">Vacancies</a>
				</li>
				<li>
					<a href="editSite.php#staff">People</a>
				</li>
				<li>
					<a href="editSite.php#library">Library</a>
				</li>
				<li>
					<a href="editSite.php#sfx">Sound Effects</a>
				</li>
				<li>
					<a href="editSite.php#portfolio">Portfolio</a>
				</li>';
	}
	
	//EDIT DASHBOARD
	
	if($myLevelData == 1 || $myLevelData == 2 || $myLevelData == 3){
		echo '<br>
				<hr style=" border-top: 1px solid #444;" id="editDash">
				<li class="sidebar-brand">
					<a href="editClient.php">Client Admin</a>
				</li>
				<li>
					<a href="editClient.php#clients">Create Clients</a>
				</li>
				<li>
					<a href="editClient.php#commission">Commission Info</a>
				</li>
				<li>
					<a href="editClient.php#alerts">Client Alerts</a>
				</li>
			  <br>
				<li class="sidebar-brand">
					<a href="editDash.php">Client Dash</a>
				</li>
				<li>
					<a href="editDash.php#commission">Commission Data</a>
				</li>
				<li>
					<a href="editDash.php#tracks">Client Tracks</a>
				</li>
				<li>
					<a href="editDash.php#producers">Producer Hours</a>
				</li>
			  <br>
				<li class="sidebar-brand">
					<a href="clientProgress.php">Client Info</a>
				</li>
				<li>
					<a href="clientProgress.php">Track Updates</a>
				</li>
				<li>
					<a href="clientProgress.php">Production Log</a>
				</li>
				<li>
					<a href="clientProgress.php">Messaging</a>
				</li>
			  <br>
			  <hr style=" border-top: 1px solid #444;">';
	}
?>