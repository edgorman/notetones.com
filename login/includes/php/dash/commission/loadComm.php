<?php
	function commClient($loginIdData){
		require(dirname(__FILE__)."/../../config.php");
		$stmt = $conn -> prepare("SELECT nickname FROM login WHERE id= :id");
		$stmt -> bindParam(':id', $loginIdData);
		$stmt -> execute();
		$stmt -> bindColumn('nickname', $nicknameData);
		while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) { return $nicknameData; }
	}
	
	function commManager($managerData){
		require(dirname(__FILE__)."/../../config.php");
		$commManagerString = "";
		$stmt = $conn -> prepare("SELECT nickname FROM login WHERE level IN(1,4)");
		$stmt -> execute();
		$stmt -> bindColumn('nickname', $nicknameData);
		while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) {
			if($nicknameData == $managerData) $commManagerString .= '<option selected value="'.$nicknameData.'">'.$nicknameData.'</option>';
			else $commManagerString .= '<option value="'.$nicknameData.'">'.$nicknameData.'</option>';
		}
		return $commManagerString;
	}
	
	function commPhase($phaseData){
		$commPhaseString = "";
		if($phaseData == "Planning Phase") $commPhaseString = '<option selected value="Planning Phase">Planning Phase</option>';
		else $commPhaseString = '<option value="Planning Phase">Planning Phase</option>';
		if($phaseData == "Production Phase") $commPhaseString .= '<option selected value="Production Phase">Production Phase</option>';
		else $commPhaseString .= '<option value="Production Phase">Production Phase</option>';
		if($phaseData == "Mastering Phase") $commPhaseString .= '<option selected value="Mastering Phase">Mastering Phase</option>';
		else $commPhaseString .= '<option value="Mastering Phase">Mastering Phase</option>';
		if($phaseData == "Finalising Phase") $commPhaseString .= '<option selected value="Finalising Phase">Finalising Phase</option>';
		else $commPhaseString .= '<option value="Finalising Phase">Finalising Phase</option>';
		if($phaseData == "Completed") $commPhaseString .= '<option selected value="Completed">Completed</option>';
		else $commPhaseString .= '<option value="Completed">Completed</option>';
		return $commPhaseString;
	}

	function commFileSelect($fileData){
		$fileString = "";
		if ($handle = opendir(dirname(__FILE__).'/../../../../../dashboard/includes/download/commission/')) {
	    	while (false !== ($entry = readdir($handle))) {
	        	if ($entry != "." && $entry != "..") {
					if($fileData == $entry) $fileString .= "<option selected value='$entry'>$entry</option>";
					else $fileString .= "<option value='$entry'>$entry</option>";
	        	}
	    	}
			closedir($handle);
		}
		return $fileString;
	}
	
	function commDownload($downloadData){
		$fileString = "";
		if($downloadData == "") $fileString .= "<option selected value=''>None</option>";
		else $fileString .= "<option value=''>None</option>";
		
		if ($handle = opendir(dirname(__FILE__).'/../../../../../dashboard/includes/download/commission/')) {
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
	
	function commComplete($completeData){
		$commCompletedString = "";
		if($completeData == "0") $commCompletedString = '<option selected value="0">No</option>';
		else $commCompletedString = '<option value="0">No</option>';
		if($completeData == "1") $commCompletedString .= '<option selected value="1">Yes</option>';
		else $commCompletedString .= '<option value="1">Yes</option>';
		return $commCompletedString;
	}
	
	require(dirname(__FILE__)."/../config.php");
	
   	$stmt = $conn -> prepare("SELECT id, login_id, manager, phase, download, complete FROM commission");
	$stmt -> execute();
	$stmt -> bindColumn('id', $idData);
	$stmt -> bindColumn('login_id', $loginIdData);
	$stmt -> bindColumn('manager', $managerData);
	$stmt -> bindColumn('phase', $phaseData);
	$stmt -> bindColumn('download', $downloadData);
	$stmt -> bindColumn('complete', $completeData);
	$count = $stmt -> rowCount();
	
	echo '<table class="table-feature" id="commission">
				<tbody>
					<tr>
						<th class="table-header">Client Name</th>
						<th class="table-header">Manager</th>
						<th class="table-header">Phase</th>
						<th class="table-header">Download</th>
						<th class="table-header">Complete & Paid</th>
						<th class="table-header">EDIT</th>
					</tr>
				';
				
	$i = 0;
	
	while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) {
		echo '<tr>
				<form name="comm-'.$idData.'" method="POST" action="" onsubmit="return false;">
				  <td class="row-feature"><textarea class="form-control" name="commClientName" readonly>'.commClient($loginIdData).'</textarea></td>
				  <td class="row-feature"><select class="form-control" name="commManager">'.commManager($managerData).'</select></td>
				  <td class="row-feature"><select class="form-control" name="commPhase">'.commPhase($phaseData).'</select></td>
				  <td class="row-feature"><select class="form-control" name="commDownload">'.commDownload($downloadData).'</select></td>
				  <td class="row-feature"><select class="form-control" name="commComplete">'.commComplete($completeData).'</select></td>
				  <td class="button-feature"><button onclick="updateCommission('.$i.');" style="color:green;" type="input">&#10004;</button></td>
				  <input type="hidden" value="'.$loginIdData.'" name="commClient"/>
				</form>
			  </tr>';
		
		$i++;
	}
	
	echo '
		</tbody>
	</table>
	<br>
	Here you can upload the final zip file for the clients. The folder will be hidden from the user, and the file given a random jumble of letters
	 so they cannot find the file. We recommend you write down the name of the renamed file, or assign the file quickly to the appropriate client before you forget.
	<br><br>
	<div class="col-md-6">
		<form action="#commission" method="post" enctype="multipart/form-data">
			<input type="file" name="file" value="Choose File"/>
			<input type="hidden" name="directory" value="dashboard/includes/download/commission/"/>
			<input type="submit" name="newZip" value="Submit"/>
		</form>
	</div>
	<div class="col-md-6">
		<form action="#commission" method="post">
			<select name="file">'.commFileSelect("").'</select><br>
			<input type="hidden" name="directory" value="dashboard/includes/download/commission/"/>
			<input type="submit" name="deleteFile" value="Delete" onclick="return confirm('."'Are your sure you want to delete this file?'".')"/>
		</form>
	</div>
	<br><br>';
?>