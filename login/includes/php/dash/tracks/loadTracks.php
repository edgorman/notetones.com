<?php
	require(dirname(__FILE__)."/../config.php");
	
	function trackClient($commIdData){
		$commissionString = "";
		require(dirname(__FILE__)."/../config.php");
		
		$stmtHalf = $conn -> prepare("SELECT login_id FROM commission WHERE id= :commIdData");
		$stmtHalf -> bindParam(':commIdData', $commIdData);
		$stmtHalf -> execute();
		$stmtHalf -> bindColumn('login_id', $loginIdData);
		while ($row = $stmtHalf -> fetch(PDO::FETCH_BOUND)) {}
			
		require(dirname(__FILE__)."/../../config.php");
		
		$stmtTQ = $conn -> prepare("SELECT id, nickname FROM login WHERE level IN(10,11)");
		$stmtTQ -> execute();
		$stmtTQ -> bindColumn('nickname', $nicknameData);
		$stmtTQ -> bindColumn('id', $idData);
		
		while ($row = $stmtTQ -> fetch(PDO::FETCH_BOUND)) {
			if($loginIdData == $idData) $commissionString .= "<option selected value='$idData'>$nicknameData</option>";
			else $commissionString .= "<option value='$idData'>$nicknameData</option>";
		}
		return $commissionString;
	}
	
	function trackStatus($trackSData){
		require(dirname(__FILE__)."/../config.php");
		$trackStatusString = "";
		
		if($trackSData == "Planning Phase") $trackStatusString = '<option selected value="Planning Phase">Planning Phase</option>';
		else $trackStatusString = '<option value="Planning Phase">Planning Phase</option>';
		
		if($trackSData == "Production Phase") $trackStatusString .= '<option selected value="Production Phase">Production Phase</option>';
		else $trackStatusString .= '<option value="Production Phase">Production Phase</option>';
		
		if($trackSData == "Mastering Phase") $trackStatusString .= '<option selected value="Mastering Phase">Mastering Phase</option>';
		else $trackStatusString .= '<option value="Mastering Phase">Mastering Phase</option>';
		
		if($trackSData == "Finalising Phase") $trackStatusString .= '<option selected value="Finalising Phase">Finalising Phase</option>';
		else $trackStatusString .= '<option value="Finalising Phase">Finalising Phase</option>';
		
		if($trackSData == "Completed") $trackStatusString .= '<option selected value="Completed">Completed</option>';
		else $trackStatusString .= '<option value="Completed">Completed</option>';
		
		return $trackStatusString;
	}

	function trackSample($downloadData, $noneDisplay){
		$fileString = "";
		if($noneDisplay){
			if($downloadData == "") $fileString .= "<option selected value=''>None</option>";
			else $fileString .= "<option value=''>None</option>";
		}
		
		if ($handle = opendir(dirname(__FILE__).'/../../../../../dashboard/includes/download/sound/samples/')) {
	    	while (false !== ($entry = readdir($handle))) {
	        	if ($entry != "." && $entry != "..") {
					if($downloadData == $entry) $fileString .= "<option selected value='$entry'>$entry</option>";
					else $fileString .= "<option value='$entry'>$entry</option>";
	        	}
	    	}
			closedir($handle);
		}
		return $fileString;
	}
	
   	$stmt = $conn -> prepare("SELECT id, commission_id, name, status, e_date, download FROM tracks ORDER BY commission_id ASC, name ASC");
	$stmt -> execute();
	$stmt -> bindColumn('id', $idData);
	$stmt -> bindColumn('commission_id', $commIdData);
	$stmt -> bindColumn('name', $trackNData);
	$stmt -> bindColumn('status', $trackSData);
	$stmt -> bindColumn('e_date', $trackEData);
	$stmt -> bindColumn('download', $downloadData);
	
	echo '<table class="table-feature" id="tracks">
				<tbody>
					<tr>
						<th class="table-header">Track Name</th>
						<th class="table-header">Client</th>
						<th class="table-header">Track Status</th>
						<th class="table-header">End Date</th>
						<th class="table-header">Track Sample</th>
						<th class="button-header">DEL</th>
						<th class="button-header">EDIT</th>
					</tr>
				';
				
	$i = 0;
	while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) {
		echo '<tr>
				<form name="track-'.$idData.'" method="POST" action="" onsubmit="return false;">
				  <td class="row-feature"><textarea class="form-control" name="trackName">'.$trackNData.'</textarea></td>
				  <td class="row-feature"><select class="form-control" name="trackClient">'.trackClient($commIdData).'</select></td>
				  <td class="row-feature"><select class="form-control" name="trackStatus">'.trackStatus($trackSData).'</select></td>
				  <td class="row-feature"><input class="form-control" type="date" name="trackEnd" value="'.(str_replace("/", "-", $trackEData)).'" min="'.(str_replace("/", "-", date("Y/m/d"))).'"/></td>
				  <td class="row-feature"><select class="form-control" name="trackSample">'.trackSample($downloadData, 1).'</select></td>
				  <td class="button-feature"><button onclick="deleteTrack('.$i.');" style="color:red;" type="input">&#10008;</button></td>
				  <td class="button-feature"><button onclick="updateTrack('.$i.');" style="color:green;" type="input">&#10004;</button></td>
				  <input type="hidden" value="'.$idData.'" name="trackId"/>
				</form>
			  </tr>';
		
		$i++;
	}
	echo '</tr>
		  	  <th class="table-header">Track Name</th>
			  <th class="table-header">Client</th>
			  <th class="table-header">Track Status</th>
			  <th class="table-header">End Date</th>
			  <th class="table-header">Track Sample</th>
			  <td class="table-header" colspan="2">NEW</td>
		  </tr>
		  <tr>
		  	<form name="newTrack" method="POST" action="" onsubmit="return false;">
		  	  <td class="row-feature"><textarea class="form-control" name="trackName"></textarea></td>
		  	  <td class="row-feature"><select class="form-control" name="trackClient">'.trackClient("").'</select></td>
			  <td class="row-feature"><select class="form-control" name="trackStatus">'.trackStatus("").'</select></td>
			  <td class="row-feature"><input class="form-control" type="date" name="trackEnd" min="'.(str_replace("/", "-", date("Y/m/d"))).'"/></td>
			  <td class="row-feature"><select class="form-control" name="trackSample">'.trackSample("", 1).'</select></td>
			  <td class="button-feature" colspan="2"><button onclick="newBrack('.$i.');" style="color:green;" type="input">&#10004;</button></td>
			</form>
		  </tr>
		</tbody>
	</table>
	<br>
	Here we upload samples of the tracks we are producing. <b>Please remember to add an audio overlay to prevent them from
	 downloading our music without confirmation</b>.
	<br><br>
	<div class="col-md-6">
		<form action="#track" method="post" enctype="multipart/form-data">
			<input type="file" name="file" value="Choose File"/>
			<input type="hidden" name="directory" value="dashboard/includes/download/sound/samples/"/>
			<input type="submit" name="newAudio" value="Submit"/>
		</form>
	</div>
	<div class="col-md-6">
		<form action="#track" method="post">
			<select name="file">'.trackSample("", 0).'</select><br>
			<input type="hidden" name="directory" value="dashboard/includes/download/sound/samples/"/>
			<input type="submit" name="deleteFile" value="Delete" onclick="return confirm('."'Are your sure you want to delete this file?'".')"/>
		</form>
	</div>
	<br><br>';
?>