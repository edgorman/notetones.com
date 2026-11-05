<?php
	require(dirname(__FILE__)."/../config.php");
	
	$stmt = $conn -> prepare("SELECT id FROM commission WHERE login_id= :loginIdData LIMIT 1");
	$stmt -> bindParam(":loginIdData", $myIdData);
	$stmt -> execute();
	$stmt -> bindColumn('id', $commIdData);
		
	while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) {
		echo '<div id="newTrack" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">
								<span aria-hidden="true">×</span><span class="sr-only">Close</span>
							</button>
							<h2 class="modal-title" id="myModalLabel">ADD NEW TRACK</h2>
						</div>
						<form name="newTrack" method="POST" onsubmit="return false;">
							<input type="hidden" name="commId" value="'.$commIdData.'"/>
							<div class="modal-body" style="line-height: 25px; font-size: 14px; text-align: left; ">
								<div class="input-group" style="width: 100%;">
									<span class="input-group-addon" id="trackNameTag" style="width: 150px; font-size: 13px;">Track Name: </span>
								  	<input type="text" class="form-control" aria-describedby="trackNameTag" name="trackName" style="font-size: 13px;" placeholder="e.g. home coming">
								</div>
								<div class="input-group" style="width: 100%;">
									<span class="input-group-addon" id="trackLengthTag" style="width: 150px; font-size: 13px;">Est. End Date: </span>
								  	<input type="text" class="form-control" aria-describedby="trackLengthTag" name="trackLength" style="font-size: 13px;" placeholder="e.g. one month from now">
								</div>
								<div class="input-group" style="width: 100%;">
									<span class="input-group-addon" id="trackLengthTag" style="width: 150px; font-size: 13px;">Description: </span>
								  	<textarea class="form-control" aria-describedby="trackLengthTag" name="trackDesc" style="font-size: 13px; height: 250px; resize: none;" placeholder="Let us know what kind of track your thinking of." maxlength="9999"></textarea>
								</div>
								<br>
								<div style="text-align: center;">
									<button name="save" type="button" class="btn btn-primary" style="border-radius: 0;" onclick="createNewTrack();">
										<h5>CREATE TRACK</h5>
									</button>
								</div>
								<br>
								<hr>
								<h6 style="text-align: center; line-height: 20px;">
									Please note: all inputs in the form above are needed to complete this form.
									<br>
									By adding tracks through the dashboard, a member of staff will follow it up with you to double check your request.
								</h6>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-danger" onclick="deleteNewTrack();">
									Discard
								</button>
								<button type="button" class="btn btn-default" data-dismiss="modal">
									Close
								</button>
							</div>
						</form>
					</div>
				</div>
			</div>';
	}
?>