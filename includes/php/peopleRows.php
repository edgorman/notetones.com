<?php
	require_once("config.php");
	
	function createPeopleRows($deptData, $deptBackground){
		require("config.php");
		
		$stmt = $conn -> prepare("SELECT name, title, img, torder, email, twitter, linkedin, soundcloud, about FROM employees WHERE dept= :deptData ORDER BY torder" );
		$stmt -> bindParam(":deptData", $deptData);
		$stmt -> execute();
		$stmt -> bindColumn("name", $nameData);
		$stmt -> bindColumn("title", $titleData);
		$stmt -> bindColumn("img", $imgData);
		$stmt -> bindColumn("torder", $orderData);
		$stmt -> bindColumn("email", $emailLinkData);
		$stmt -> bindColumn("twitter", $twitLinkData);
		$stmt -> bindColumn("linkedin", $linkLinkData);
		$stmt -> bindColumn("soundcloud", $soundCloudData);
		$stmt -> bindColumn("about", $aboutData);
		$numRows = $stmt -> rowCount();
		$numRowOffset = true;

		while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) {
			if($numRows >= 5){
				echo '<div class="col-lg-4 col-md-12">
						<div class="people-div">
							<div class="people-background">
								<i class="fa '.$deptBackground.' hidden-sm hidden-xs"'; 
								if($deptBackground == "fa-university") echo ' style="padding-left: 3.5vh;"';
								echo '></i>
							</div>
							<div class="people-img" style="background-image: url(&#39;../includes/images/people/'.$imgData.'&#39;)">
								<div class="people-img-overlay"></div>
								<p onclick="$(this).parent(&#39;.people-img&#39;).parent(&#39;.people-div&#39;).toggleClass(&#39;active&#39;);">
									<span><i class="fa fa-search" style="padding-right: 5px;"></i> Learn More</span>
									<span><i class="fa fa-times" style="padding-right: 5px;"></i> Close Profile</span>
								</p>
							</div>
							<h4><span>'.$nameData.'</span></h4>
							<h6 style="color: #AAA; font-weight: bold;"><span>'.$titleData.'</span></h6>
							<br class="hidden-xs hidden-sm">
							<div class="people-social">';
				if(isset($emailData) && $emailData != "" && $emailData != " ") echo '<a href="'.$emailData.'"><i class="fa fa-evelope"></i></a>';
				if(isset($twitLinkData) && $twitLinkData != "" && $twitLinkData != " ") echo '<a href="'.$twitLinkData.'"><i class="fa fa-twitter"></i></a>';
				if(isset($linkLinkData) && $linkLinkData != "" && $linkLinkData != " ") echo '<a href="'.$linkLinkData.'"><i class="fa fa-linkedin-square"></i></a>';
				if(isset($soundCloudData) && $soundCloudData != "" && $soundCloudData != " ") echo '<a href="'.$soundCloudData.'"><i class="fa fa-soundcloud"></i></a>';
				echo'		</div>
							<br>
							<div class="people-about-toggle"></div>
							<div class="people-about">
								<b>About '.$nameData.'</b><br>
								'.$aboutData.'
							</div>
						</div>
					</div>';
			}
			else if($numRows >= 3){
				if($numRowOffset) {echo '<div class="col-lg-5 col-md-offset-1 col-md-12">'; $numRowOffset = false;}
				else {echo '<div class="col-lg-5 col-md-12">'; $numRowOffset = true;}
				
				echo '	<div class="people-div">
							<div class="people-background">
								<i class="fa '.$deptBackground.' hidden-sm hidden-xs"'; 
								if($deptBackground == "fa-university") echo ' style="padding-left: 3.5vh;"';
								echo '></i>
							</div>
							<div class="people-img" style="background-image: url(&#39;../includes/images/people/'.$imgData.'&#39;)">
								<div class="people-img-overlay"></div>
								<p onclick="$(this).parent(&#39;.people-img&#39;).parent(&#39;.people-div&#39;).toggleClass(&#39;active&#39;);">
									<span><i class="fa fa-search" style="padding-right: 5px;"></i> Learn More</span>
									<span><i class="fa fa-times" style="padding-right: 5px;"></i> Close Profile</span>
								</p>
							</div>
							<h4><span>'.$nameData.'</span></h4>
							<h6 style="color: #AAA; font-weight: bold;"><span>'.$titleData.'</span></h6>
							<br class="hidden-xs hidden-sm">
							<div class="people-social">';
				if(isset($emailData) && $emailData != "" && $emailData != " ") echo '<a href="'.$emailData.'"><i class="fa fa-evelope"></i></a>';
				if(isset($twitLinkData) && $twitLinkData != "" && $twitLinkData != " ") echo '<a href="'.$twitLinkData.'"><i class="fa fa-twitter"></i></a>';
				if(isset($linkLinkData) && $linkLinkData != "" && $linkLinkData != " ") echo '<a href="'.$linkLinkData.'"><i class="fa fa-linkedin-square"></i></a>';
				if(isset($soundCloudData) && $soundCloudData != "" && $soundCloudData != " ") echo '<a href="'.$soundCloudData.'"><i class="fa fa-soundcloud"></i></a>';
				echo'		</div>
							<br>
							<div class="people-about-toggle"></div>
							<div class="people-about">
								<b>About '.$nameData.'</b><br>
								'.$aboutData.'
							</div>
						</div>
					</div>';
			}
			else if($numRows <= 2){
				echo '<div class="col-lg-6 col-lg-offset-3 col-md-12">
						<div class="people-div">
							<div class="people-background">
								<i class="fa '.$deptBackground.' hidden-sm hidden-xs"'; 
								if($deptBackground == "fa-university") echo ' style="padding-left: 3.5vh;"';
								echo '></i>
							</div>
							<div class="people-img" style="background-image: url(&#39;../includes/images/people/'.$imgData.'&#39;)">
								<div class="people-img-overlay"></div>
								<p onclick="$(this).parent(&#39;.people-img&#39;).parent(&#39;.people-div&#39;).toggleClass(&#39;active&#39;);">
									<span><i class="fa fa-search" style="padding-right: 5px;"></i> Learn More</span>
									<span><i class="fa fa-times" style="padding-right: 5px;"></i> Close Profile</span>
								</p>
							</div>
							<h4><span>'.$nameData.'</span></h4>
							<h6 style="color: #AAA; font-weight: bold;"><span>'.$titleData.'</span></h6>
							<br class="hidden-xs hidden-sm">
							<div class="people-social">';
				if(isset($emailData) && $emailData != "" && $emailData != " ") echo '<a href="'.$emailData.'"><i class="fa fa-evelope"></i></a>';
				if(isset($twitLinkData) && $twitLinkData != "" && $twitLinkData != " ") echo '<a href="'.$twitLinkData.'"><i class="fa fa-twitter"></i></a>';
				if(isset($linkLinkData) && $linkLinkData != "" && $linkLinkData != " ") echo '<a href="'.$linkLinkData.'"><i class="fa fa-linkedin-square"></i></a>';
				if(isset($soundCloudData) && $soundCloudData != "" && $soundCloudData != " ") echo '<a href="'.$soundCloudData.'"><i class="fa fa-soundcloud"></i></a>';
				echo'		</div>
							<br>
							<div class="people-about-toggle"></div>
							<div class="people-about">
								<b>About '.$nameData.'</b><br>
								'.$aboutData.'
							</div>
						</div>
					</div>';
			}
		}
	}

	function departmentHasPeople($deptData){
		require("config.php");
		
		$stmt = $conn -> prepare("SELECT id FROM employees WHERE dept= :deptData" );
		$stmt -> bindParam(":deptData", $deptData);
		$stmt -> execute();
		$stmt -> bindColumn("id", $idData);
		$numRows = $stmt -> rowCount();
		
		while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) {}
		return $numRows;
	}
	
	if(departmentHasPeople("SLT") >= 1){
		echo'<div class="about-section">
				<div style="position: absolute; top: -100px;" id="leadership"></div>
				<h1 class="about-title" style="color: black; text-align: center; padding-top: 0;">
					<span style="border-bottom: 3px solid black; margin-left: 20px;">LEADERSHIP</span> 
					<small><a href="#leadership"><i class="fa fa-link"></i></a></small>
				</h1>
				<div class="people-scroll">
					<div class="people-scroll-direction hidden-xs" onclick="$(&#39;html, body&#39;).animate({ scrollTop: $(&#39;.about-section:eq(1)&#39;).offset().top - 100}, 750);"><i class="fa fa-angle-down"></i></div>
				</div>';
		createPeopleRows("SLT","fa-university");
		echo '</div>
				<div class="col-md-12" style="margin-top: 0; margin-bottom: 0;"><hr style="margin: 0;"></div>';
	}
		
	if(departmentHasPeople("PRD") >= 1){
		echo'<div class="about-section">
				<div style="position: absolute; top: -100px;" id="production"></div>
				<h1 class="about-title" style="color: black; text-align: center; padding-top: 0;">
					<span style="border-bottom: 5px solid black; margin-left: 20px;">PRODUCTION</span> 
					<small><a href="#production"><i class="fa fa-link"></i></a></small>
				</h1>
				<div class="people-scroll">
					<div class="people-scroll-direction hidden-xs" onclick="$(&#39;html, body&#39;).animate({ scrollTop: $(&#39;.about-section:eq(0)&#39;).offset().top - 100}, 750);"><i class="fa fa-angle-up"></i></div>
					<div class="people-scroll-direction hidden-xs" onclick="$(&#39;html, body&#39;).animate({ scrollTop: $(&#39;.about-section:eq(2)&#39;).offset().top - 100}, 750);"><i class="fa fa-angle-down"></i></div>
				</div>';
		createPeopleRows("PRD","fa-headphones");
		echo '</div>
				<div class="col-md-12" style="margin-top: 0; margin-bottom: 0;"><hr style="margin: 0;"></div>';
	}
		
	if(departmentHasPeople("CNT") >= 1){
		echo'<div class="about-section">
				<div style="position: absolute; top: -100px;" id="content"></div>
				<h1 class="about-title" style="color: black; text-align: center; padding-top: 0;">
					<span style="border-bottom: 5px solid black; margin-left: 20px;">CONTENT</span> 
					<small><a href="#content"><i class="fa fa-link"></i></a></small>
				</h1>
				<div class="people-scroll">
					<div class="people-scroll-direction hidden-xs" onclick="$(&#39;html, body&#39;).animate({ scrollTop: $(&#39;.about-section:eq(1)&#39;).offset().top - 100}, 750);"><i class="fa fa-angle-up"></i></div>
					<div class="people-scroll-direction hidden-xs" onclick="$(&#39;html, body&#39;).animate({ scrollTop: $(&#39;.about-section:eq(3)&#39;).offset().top - 100}, 750);"><i class="fa fa-angle-down"></i></div>
				</div>';
		createPeopleRows("CNT","fa-language");
		echo '</div>
				<div class="col-md-12" style="margin-top: 0; margin-bottom: 0;"><hr style="margin: 0;"></div>';
	}
		
	if(departmentHasPeople("ADM") >= 1){
		echo'<div class="about-section">
				<div style="position: absolute; top: -100px;" id="admin"></div>
				<h1 class="about-title" style="color: black; text-align: center; padding-top: 0;">
					<span style="border-bottom: 5px solid black; margin-left: 20px;">ADMIN</span> 
					<small><a href="#admin"><i class="fa fa-link"></i></a></small>
				</h1>
				<br>
				<div class="people-scroll">
					<div class="people-scroll-direction hidden-xs" style="margin-right: 54px;" onclick="$(&#39;html, body&#39;).animate({ scrollTop: $(&#39;.about-section:eq(2)&#39;).offset().top - 100}, 750);"><i class="fa fa-angle-up"></i></div>
				</div>';
		createPeopleRows("ADM","fa-keyboard-o");
		echo '</div>
				<div class="col-md-12" style="margin-top: 0; margin-bottom: 0;"><hr style="margin: 0;"></div>';
	}
	
?>