<?php
	require(dirname(__FILE__)."/../config.php");
	$trackTallyData = 0;
	$trackTallyResetData = 0;
	
	$stmt = $conn -> prepare("SELECT id FROM commission WHERE login_id= :loginIdData LIMIT 1");
	$stmt -> bindParam(":loginIdData", $myIdData);
	$stmt -> execute();
	$stmt -> bindColumn('id', $commIdData);
		
	while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) {
		require(dirname(__FILE__)."/../config.php");
		
		$stmtTwo = $conn -> prepare("SELECT id, name, status, s_date, e_date, staff_info, client_info, download, updated FROM tracks WHERE commission_id= :commIdData ORDER BY name");
		$stmtTwo -> bindParam(":commIdData", $commIdData);
		$stmtTwo -> execute();
		$stmtTwo -> bindColumn('id', $trackIdData);
		$stmtTwo -> bindColumn('name', $nameData);
		$stmtTwo -> bindColumn('status', $statusData);
		$stmtTwo -> bindColumn('s_date', $startDData);
		$stmtTwo -> bindColumn('e_date', $endDData);
		$stmtTwo -> bindColumn('staff_info', $staffIData);
		$stmtTwo -> bindColumn('client_info', $clientIData);
		$stmtTwo -> bindColumn('download', $downloadData);
		$stmtTwo -> bindColumn('updated', $updatedData);
		
		if($stmtTwo -> rowCount() == 0){
			echo '<div class="col-lg-6 col-lg-offset-3 col-md-12 col-md-offset-0" style="text-align: center;">
						<div class="alert alert-info">
							<h4><b>PLEASE NOTE:</b></h4>
							<h5 style="line-height: 25px;">
								No samples have been prepared at this time because 
								no tracks have been commissioned. You can do so by going to the
								<a href="home.php" style="color: blue;">Dashboard Page</a> or
								contacting a member of the Notetones Staff. 
							</h5>
						</div>
					</div>
				</div>';
		}
			
		while ($row = $stmtTwo -> fetch(PDO::FETCH_BOUND)) {
			if($trackTallyResetData == 0) echo '<div class="row">';
			
			echo '<div class="col-lg-6 col-md-12 audio-sample" id="track-'.$trackTallyData.'">
					<div class="panel panel-primary">
	                    <div class="panel-heading">
	                    	<h3> '.$nameData.' <i class="fa fa-music" style="float: right;"></i> </h3>
	                    </div>
	                    <div class="panel-body">
	                        <div class="col-lg-6 col-md-12 audio-sample-content" style="text-align: left;">
								<h5>Total time spent: <span>6 hours</span></h5>
								<h5>Current track status: <span>'.ucfirst($statusData).'</span></h5>
								<h5>Info: <span>'.$staffIData.'</span></h5>
							</div>
							<div class="col-lg-6 col-md-12 audio-sample-content" style="text-align: right;">
								<h5>Start date: <span>'.$startDData.'</span></h5>
								<h5>End date: <span>'.$endDData.'</span></h5>
								<h5>Last Updated: <span>'.$updatedData.'</span></h5>
							</div>
	                    </div>
	                    <div class="panel-footer">';
	                    
	                    if(isset($downloadData) && !($downloadData == " ") && !($downloadData == "")){
	                    	echo '<audio src="includes/download/sound/samples/'.$downloadData.'" preload="none"></audio>
	                    	<div class="audio-sample-disclaimer"><h6><b>NOTE: </b>There is an audio overlay because this is not the final download.</h6></div>';
	                    }
						else echo '<div class="audio-sample-disclaimer"><h6>No sample to display at this time.</h6></div>';
						
	               echo '</div>
	                </div>
				</div>';
			
			$trackTallyData++;
			$trackTallyResetData++;
			if($trackTallyResetData == 2) {echo '</div>'; $trackTallyResetData = 0;}
		}
	}
?>