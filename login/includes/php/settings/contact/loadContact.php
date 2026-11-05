<?php
    require(dirname(__FILE__)."/../../config.php");
	
	if(!isset($myIdData)) $myIdData = $_POST['id'];
			
	$stmt = $conn -> prepare("SELECT email, twitter, linkedin, soundcloud, about FROM employees WHERE user_id= :userIData LIMIT 1");
	$stmt -> bindParam(":userIData", $myIdData);
	$stmt -> execute();
	$stmt -> bindColumn('email', $emailData);
	$stmt -> bindColumn('twitter', $twitterData);
	$stmt -> bindColumn('linkedin', $linkedinData);
	$stmt -> bindColumn('soundcloud', $soundcloudData);
	$stmt -> bindColumn('about', $aboutData);
	
	while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) {
		echo '<div class="input-group input-group-lg" style="max-width: 800px;">
				<span class="input-group-addon  " id="emailInfo">Email</span>
				<input class="form-control" name="emailInfo" aria-describedby="emailInfo" value="'.$emailData.'" type="text" placeholder="someone@notetones.com"/>
			  </div>
			  <br>
			  <div class="input-group input-group-lg" style="max-width: 800px;">
				<span class="input-group-addon  " id="twitterInfo">Twitter</span>
				<input class="form-control" name="twitterInfo" aria-describedby="twitterInfo" value="'.$twitterData.'" type="text" placeholder="https://twitter.com/"/>
			  </div>
			  <br>
			  <div class="input-group input-group-lg" style="max-width: 800px;">
				<span class="input-group-addon  " id="linkedinInfo">LinkedIn</span>
				<input class="form-control" name="linkedinInfo" aria-describedby="linkedinInfo" value="'.$linkedinData.'" type="text" placeholder="https://linkedin.com/"/>
			  </div>
			  <br>
			  <div class="input-group input-group-lg" style="max-width: 800px;">
				<span class="input-group-addon  " id="soundcloudInfo">SoundCloud</span>
				<input class="form-control" name="soundcloudInfo" aria-describedby="soundcloudInfo" value="'.$soundcloudData.'" type="text" placeholder="https://www.soundcloud.com/"/>
			  </div>
			  <br>
			  <div class="input-group input-group-lg" style="max-width: 800px;">
				<span class="input-group-addon  " id="aboutInfo">About You</span>
				<input class="form-control" name="aboutInfo" aria-describedby="aboutInfo" value="'.$aboutData.'" type="text" maxlength="230" placeholder="Hi, i&apos;m... and I like..."/>
			  </div>
			  <br>
			  <div class="input-group input-group-lg" style="max-width: 800px; text-align: center;">
				    <span class="input-group-btn">
        				<button class="btn btn-danger" type="button" onclick="updateContact();">Submit</button>
      		  		</span>
			  </div>
			  
			  <input type="hidden" name="contactId" value="'.$myIdData.'"/>';
	}
?>