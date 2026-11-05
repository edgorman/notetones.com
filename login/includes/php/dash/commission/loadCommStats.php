<?php
	function commClient($loginIdData){
		require(dirname(__FILE__)."/../../config.php");
		$stmt = $conn -> prepare("SELECT nickname FROM login WHERE id= :id");
		$stmt -> bindParam(':id', $loginIdData);
		$stmt -> execute();
		$stmt -> bindColumn('nickname', $nicknameData);
		while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) { return $nicknameData; }
	}
	
	function commInvoice($downloadData){
		$fileString = "";
		if($downloadData == "") $fileString .= "<option selected value=''>None</option>";
		else $fileString .= "<option value=''>None</option>";
		
		if ($handle = opendir(dirname(__FILE__).'/../../../../../dashboard/includes/download/invoices/')) {
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
	
	function invFileSelect($fileData){
		$fileString = "";
		if ($handle = opendir(dirname(__FILE__).'/../../../../../dashboard/includes/download/invoices/')) {
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
	
	require(dirname(__FILE__)."/../config.php");
	
   	$stmt = $conn -> prepare("SELECT id, login_id, s_date, e_date, invoice_num, invoice_link FROM commission");
	$stmt -> execute();
	$stmt -> bindColumn('id', $idData);
	$stmt -> bindColumn('login_id', $loginIdData);
	$stmt -> bindColumn('s_date', $startDData);
	$stmt -> bindColumn('e_date', $endDData);
	$stmt -> bindColumn('invoice_num', $invNData);
	$stmt -> bindColumn('invoice_link', $invLData);
	
	echo '<table class="table-feature" id="commission">
				<tbody>
					<tr>
						<th class="table-header">Client Name</th>
						<th class="table-header">Start Date</th>
						<th class="table-header">End Date</th>
						<th class="table-header">Invoice Num</th>
						<th class="table-header">Invoice Link</th>
						<th class="table-header">EDIT</th>
					</tr>
				';
				
	$i = 0;
	while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) {
		echo '<tr>
				<form name="comm-'.$idData.'" method="POST" action="" onsubmit="return false;">
				  <td class="row-feature"><textarea class="form-control" name="commClientName" readonly>'.commClient($loginIdData).'</textarea></td>
				  <td class="row-feature"><input class="form-control" type="date" name="commSDate" value="'.(str_replace("/", "-", $startDData)).'" max="'.(str_replace("/", "-", date("Y/m/d"))).'"/></td>
				  <td class="row-feature"><input class="form-control" type="date" name="commEDate" value="'.(str_replace("/", "-", $endDData)).'" min="'.(str_replace("/", "-", date("Y/m/d"))).'"/></td>
				  <td class="row-feature"><textarea class="form-control" name="commINum">'.$invNData.'</textarea></td>
				  <td class="row-feature"><select class="form-control" name="commIDown">'.commInvoice($invLData).'</select></td>
				  <td class="button-feature"><button onclick="updateCommissionStats('.$i.');" style="color:green;" type="input">&#10004;</button></td>
				  <input type="hidden" value="'.$loginIdData.'" name="commClient"/>
				  <input type="hidden" value="'.$idData.'" name="commId"/>
				</form>
			  </tr>';
		
		$i++;
	}
	
	echo '
		</tbody>
	</table>
	<br>
	This is the client invoice upload section. Until one has been uploaded, the client will see 
	a message that says their invoice is being prepared. This will be a file that can be downloaded by the client. 
	<br><br>
	<div class="col-md-6">
		<form action="#commission" method="post" enctype="multipart/form-data">
			<input type="file" name="file" value="Choose File"/>
			<input type="hidden" name="directory" value="dashboard/includes/download/invoices/"/>
			<input type="submit" name="newFile" value="Submit"/>
		</form>
	</div>
	<div class="col-md-6">
		<form action="#commission" method="post">
			<select name="file">'.invFileSelect("").'</select><br>
			<input type="hidden" name="directory" value="dashboard/includes/download/invoices/"/>
			<input type="submit" name="deleteFile" value="Delete" onclick="return confirm('."'Are your sure you want to delete this file?'".')"/>
		</form>
	</div>
	<br><br>';
	
?>