<?php
	require(dirname(__FILE__)."/../config.php");
	
	$stmt = $conn -> prepare("SELECT complete, download FROM commission WHERE login_id= :loginIdData LIMIT 1");
	$stmt -> bindParam(":loginIdData", $myIdData);
	$stmt -> execute();
	$stmt -> bindColumn('complete', $completeData);
	$stmt -> bindColumn('download', $downloadData);
		
	while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) {
		echo '<h4>FILE READY TO BE COLLECTED</h4>
				<div style="text-align: center;">	
					<i class="fa fa-cloud hidden-xs"></i>';
		
		if($completeData && $downloadData != "") echo '<a href="includes/download/commission/'.$downloadData.'" download onclick="downloadCommClick('.$myIdData.')"><i class="fa fa-cloud-download"></i></a>';
		else echo '<a href=""><i class="fa fa-cloud-download"></i></a>';
		
		echo '<i class="fa fa-cloud hidden-xs"></i>
					<br>
					<b>CLICK ABOVE TO DOWNLOAD</b>
				</div>';
				
		if($completeData) echo '<div class="main-download-overlay" style="display: none;">';
		else echo '<div class="main-download-overlay" style="display: block;">';
		
		echo '<h3>Your file isn&#39;t quite ready to pick up yet.<br>We&#39;ll tell you when it is.</h3>
				<h6>
					<b>SO WHEN?</b> Take a look at the <a href="home.php" style="color: blue;">Dashboard</a> for updates on the stage we&#39;re at.
					<br><br>
					<b>PLEASE NOTE:</b>
					<br>
					<ul style="line-height: 20px; width: 100%; max-width: 300px; margin: 0 auto;">
						<li>Your tracks won&#39;t be available until payment of the commission has been confirmed.</li>
						<li>Any previews shown here will have an audio template overlay of the original track.</li>
						<li>The final downloadable file will be of the .zip file type, so extraction of said files will be necessary.</li>
					</ul> 
				</h6>
			</div>';
	}
?>