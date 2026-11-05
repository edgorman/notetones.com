<?php
	function tierSelect($tierData){
		$tierTypeString = "";
		
		if($tierData == "10") $tierTypeString = '<option selected value="10">Tier 2</option>';
		else $tierTypeString = '<option value="10">Tier 2</option>';
		
		if($tierData == "11") $tierTypeString .= '<option selected value="11">Tier 3</option>';
		else $tierTypeString .= '<option value="11">Tier 3</option>';
		
		return $tierTypeString;
	}
	
	require(dirname(__FILE__)."/../../config.php");
   	$stmt = $conn -> prepare("SELECT id, username, nickname, level, contact, lockState FROM login WHERE level IN(10,11)");
	$stmt -> execute();
	$stmt -> bindColumn('id', $idData);
	$stmt -> bindColumn('username', $usernameData);
	$stmt -> bindColumn('nickname', $nicknameData);
	$stmt -> bindColumn('level', $levelData);
	$stmt -> bindColumn('contact', $contactData);
	$stmt -> bindColumn('lockState', $lockData);
	
	echo '<table class="table-feature" id="clients">
				<tbody>
					<tr>
						<th class="table-header">Client Username<i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" data-original-title="Format: &quot;Client<NUM>_<TIER>&quot;"> </i></th>
						<th class="table-header">Client Nickname</th>
						<th class="table-header">Client Level</th>
						<th class="table-header">Contact Info</th>
						<th class="button-header">Lock Out</th>
						<th class="button-header" style="border-left: 1px solid #ccc;">DEL</th>
						<th class="button-header">EDIT</th>
					</tr>
				';
				
	$i = 0;
	while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) {
		echo '<tr>
				<form name="client-'.$idData.'" method="POST" action="" onsubmit="return false;">
				  <td class="row-feature"><textarea class="form-control" name="clientUsername" readonly>'.$usernameData.'</textarea></td>
				  <td class="row-feature"><textarea class="form-control" name="clientNickname" maxlength="14">'.$nicknameData.'</textarea></td>
				  <td class="row-feature"><select class="form-control" onchange="tierClient('.$i.',true)" name="clientTier">'.tierSelect($levelData).'</select></td>
				  <td class="row-feature"><textarea class="form-control" name="clientContact">'.$contactData.'</textarea></td>
				  <td class="button-feature"><input type="checkbox" name="clientLock" '; if($lockData == "1") echo "checked"; echo '/></td>
				  <td class="button-feature"><button onclick="deleteClient('.$i.');" style="color:red;" type="input">&#10008;</button></td>
				  <td class="button-feature"><button onclick="updateClient('.$i.');" style="color:green;" type="input">&#10004;</button></td>
				  <input type="hidden" value="'.$idData.'" name="clientId"/>
				</form>
			  </tr>';
		
		$i++;
	}
	
	require(dirname(__FILE__)."/../../config.php");
	$stmt = $conn -> prepare("SELECT `AUTO_INCREMENT` FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'notekuee_staff_use' AND TABLE_NAME = 'login';");
	$stmt -> execute();
	$stmt -> bindColumn('AUTO_INCREMENT', $idData);
	while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) {}
	
	$clientNumData = $idData;
	if($clientNumData <= 99 && $clientNumData >= 1){
		$clientNumData = str_pad(((string)$idData), 3, "0", STR_PAD_LEFT);
	}
	
	echo '</tr>
		  	  <th class="table-header">Client Username<i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" data-original-title="Automatically generates next client unsername."> </i></th>
			  <th class="table-header">Client Nickname</th>
			  <th class="table-header">Client Level</th>
			  <th class="table-header">Contact Info</th>
			  <th class="button-header">Lock Out</th>
			  <td class="table-header" colspan="2">NEW</td>
		  </tr>
		  <tr>
		  	<form name="newclient" method="POST" action="" onsubmit="return false;">
		  	  <td class="row-feature"><textarea class="form-control" name="clientUsername" readonly>Client'.$clientNumData.'_2</textarea></td>
			  <td class="row-feature"><textarea class="form-control" name="clientNickname" maxlength="14"></textarea></td>
			  <td class="row-feature"><select class="form-control" onchange="tierClient('.$i.',false)" name="clientTier">'.tierSelect("10").'</select></td>
			  <td class="row-feature"><textarea class="form-control" name="clientContact"></textarea></td>
			  <td class="button-feature"><input type="checkbox" name="clientLock"/></td>
			  <td class="button-feature" colspan="2"><button onclick="newTlient('.$i.');" style="color:green;" type="input">&#10004;</button></td>
			</form>
		  </tr>
		</tbody>
	</table>';
?>