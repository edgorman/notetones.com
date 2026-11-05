<?php
	require(dirname(__FILE__)."/../config.php");
	$trackTallyData = 0;
	$trackTallyResetData = 0;
	if(isset($_POST['id'])) $myIdData = $_POST['id'];
	
	$stmt = $conn -> prepare("SELECT id FROM commission WHERE login_id= :loginIdData LIMIT 1");
	$stmt -> bindParam(":loginIdData", $myIdData);
	$stmt -> execute();
	$stmt -> bindColumn('id', $commIdData);
		
	while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) {
		require(dirname(__FILE__)."/../config.php");
		
		$stmtTwo = $conn -> prepare("SELECT id, name, status, e_date, staff_info, client_info, download FROM tracks WHERE commission_id= :commIdData ORDER BY name");
		$stmtTwo -> bindParam(":commIdData", $commIdData);
		$stmtTwo -> execute();
		$stmtTwo -> bindColumn('id', $trackIdData);
		$stmtTwo -> bindColumn('name', $nameData);
		$stmtTwo -> bindColumn('status', $statusData);
		$stmtTwo -> bindColumn('e_date', $endDData);
		$stmtTwo -> bindColumn('staff_info', $staffIData);
		$stmtTwo -> bindColumn('client_info', $clientIData);
		$stmtTwo -> bindColumn('download', $downloadData);
		
		echo '<input type="hidden" name="userLoginId" value="'.$myIdData.'"/>';
		while ($row = $stmtTwo -> fetch(PDO::FETCH_BOUND)) {
			if($trackTallyResetData == 0) echo '<div class="row">';
			
			echo '<div class="col-lg-4 col-md-12 commission-single" >
					<input type="hidden" name="commTrackId" value="'.$trackIdData.'"/>
					<div class="commission-edit">
						<span style="float: left;">
							<i class="fa fa-pencil" onclick="$(&#39;.commission-single:eq('.$trackTallyData.')&#39;).toggleClass(&#39;expand&#39;); updateOldTrack('.$trackTallyData.',0);" title="Edit Track"></i>
						</span>
						<p style="position: absolute; margin-top: 10px; left: 0; right: 0; text-align: center; text-transform: uppercase; opacity: 0.7; font-weight: bold; z-index: -1;">'.$nameData.'</p>
						<span style="float: right;">
							<i class="fa fa-minus" onclick="$(&#39;.commission-single:eq('.$trackTallyData.')&#39;).toggleClass(&#39;expand&#39;);" title="Minimise"></i>
							<i class="fa fa-times" onclick="deleteOldTracks('.$trackTallyData.');" title="Delete"></i>
						</span>
					</div>
					<div class="commission-data">
						<div class="commission-pie">
							<div id="commission-pie-'.$trackTallyData.'" style="height: 200px; width: 300px; margin: 0 auto;"></div>
							<script>
								var data = [';
								$producerStringData = clientPieData($trackIdData);
								echo '];
								
								if(data.length >= 1){
									$.plot("#commission-pie-'.$trackTallyData.'", data, {
									    series: {
									        pie: {
									            show: true,
									            radius: 1,
									            label: {
									                show: true,
									                radius: 2/3,
									                formatter: function (label, series) {
								                        return "<div style=font-size:8pt;text-align:center;padding:2px;color:white;>" + label + "<br/>" + series.data[0][1] + " hrs</div>";
								                    },
									                threshold: 0.2
									            }
									        }
									    },
									    legend: {
									        show: false
									    }
									});
								}
								else {
									$("#commission-pie-'.$trackTallyData.'").html("<br><br><h6 style=opacity:0.7;>There are no producers to display at this time.</h6>")
								}
							</script>
							<div class="commission-pie-annotation"><i class="fa fa-info" data-toggle="tooltip" data-placement="left" title="Pie chart to show each producers contribution to this track."></i></div>
						</div>
						<div class="commission-info" title="Click to see more." onclick="$(&#39;.commission-single:eq('.$trackTallyData.')&#39;).addClass(&#39;expand&#39;);">
							<div class="commission-info-overlay">
								<span style="display: block;">Click to see more.</span>
							</div>
							<h6><b>TRACK NAME</b>: <span>'.$nameData.'</span></h6>
							<h6><b>TRACK STATUS</b>: <span>'.ucfirst($statusData).'</span></h6>
							<h6><b>PRODUCER(S)</b>: </h6><span style="margin-top: -25px; width: 100%; padding-bottom: 5px;">'.$producerStringData.'</span>
							<h6><b>INFO</b>: </h6><p style="margin: 0; line-height: 16px; font-size: 12px;">'.$staffIData.'</p>';
							if(isset($downloadData) && !($downloadData == " ") && !($downloadData == "")) echo '<h6><a href="download.php#track-'.$trackTallyData.'" style="color: blue;">Sample has been prepared</a></h6>';
					echo '</div>
					</div>
					<div class="commission-edit-data">
						<h3>EDITING TRACK</h3>
						<div class="input-group" style="width: 100%;">
							<span class="input-group-addon" id="trackNameTag" style="width: 150px; font-size: 13px;">Track Name: </span>
						  	<input type="text" class="form-control" aria-describedby="trackNameTag" name="oldTrackName" style="font-size: 13px;" value="'.$nameData.'">
						</div>
						<div class="input-group" style="width: 100%;">
							<span class="input-group-addon" id="trackNameDate" style="width: 150px; font-size: 13px;">Est. End Date: </span>
						  	<input type="text" class="form-control" aria-describedby="trackNameDate" name="oldTrackDate" style="font-size: 13px;" value="'.$endDData.'">
						</div>
						<div class="input-group" style="width: 100%;">
							<span class="input-group-addon" id="trackLengthTag" style="width: 150px; font-size: 13px;">Description: </span>
						  	<textarea class="form-control" aria-describedby="trackLengthTag" name="oldTrackDesc" style="font-size: 13px; height: 200px; resize: none;" placeholder="Let us know what kind of track your thinking of.">'.$clientIData.'</textarea>
						</div>
						<br>
						<div style="text-align: center;">
							<button type="button" class="btn btn-primary" style="border-radius: 0;" onclick="updateOldTrack('.$trackTallyData.',1);">
								<h5>SAVE TRACK</h5>
							</button>
							<button type="button" class="btn btn-danger" style="border-radius: 0;" onclick="deleteOldTracks('.$trackTallyData.');">
								<h5>DISCARD TRACK</h5>
							</button>
						</div>
						<br>
						<div style="text-align: center; color: blue; font-size: 12px;"><span style="cursor: pointer;" onclick="updateOldTrack('.$trackTallyData.',0);">END EDITING</span></div>
					</div>
				</div>';
			
			$trackTallyData++;
			$trackTallyResetData++;
			if($trackTallyResetData == 3) {echo '</div>'; $trackTallyResetData = 0;}
		}
	}
	
	if($trackTallyResetData == 0) echo '<div class="row">';
	
	echo '<div class="col-lg-4 col-md-12 commission-single new">
			<br><h3>ADD NEW TRACK</h3>
			<span class="fa-stack fa-lg" onclick="$(&#39;#newTrack&#39;).modal(&#39;show&#39;);">
				<i class="fa fa-circle fa-stack-2x"></i>
			  	<i class="fa fa-plus fa-stack-1x fa-inverse"></i>
			</span>
			<h6 id="newTrackDraft" style="display: none; color: #C50000;">Draft has been saved</h6>
		</div>';
	
	$trackTallyData++;
	$trackTallyResetData++;
	if($trackTallyResetData != 0) echo '</div>';
	
	function clientPieData($trackIdData){
		require(dirname(__FILE__)."/../config.php");
		
		$stmtThree = $conn -> prepare("SELECT producer, time_spent FROM producers WHERE track_id= :trackIdData");
		$stmtThree -> bindParam(":trackIdData", $trackIdData);
		$stmtThree -> execute();
		$stmtThree -> bindColumn('producer', $producerData);
		$stmtThree -> bindColumn('time_spent', $timeSData);
		$producerTallyCount = 1;
		$producerHourCount = 0;
		$producerStringData = "";
		$maxProducerCount = $stmtThree -> rowCount();
			
		while ($row = $stmtThree -> fetch(PDO::FETCH_BOUND)) {
			$prodTimeArray = explode(",",$timeSData);
			for($i = 0; $i < sizeof($prodTimeArray); $i++){$producerHourCount += $prodTimeArray[$i];}
			echo '{label: " '.$producerData.'", data: '.$producerHourCount.'}';
			
			if(!($maxProducerCount == $producerTallyCount)) {echo ','; $producerStringData .= $producerData.'<br>';}
			else{$producerStringData .= $producerData;}
			$producerTallyCount++;
			$producerHourCount = 0;
		}
		
		if($producerStringData == "") return "No producers currently."; 
		else return $producerStringData;
	}
?>