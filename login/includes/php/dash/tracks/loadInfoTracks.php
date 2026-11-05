<?php
	require(dirname(__FILE__)."/../config.php");
	$loginIdData = $_POST['id'];
	$stmt = $conn -> prepare("SELECT id FROM commission WHERE login_id= :login_id");
	$stmt -> bindParam(':login_id', $loginIdData);
	$stmt -> execute();
	$stmt -> bindColumn('id', $commIdData);
	while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) {}
	
	require(dirname(__FILE__)."/../config.php");
   	$stmt = $conn -> prepare("SELECT id, commission_id, name, client_info, staff_info FROM tracks WHERE commission_id= :commission_id ORDER BY name ASC");
	$stmt -> bindParam(':commission_id', $commIdData);
	$stmt -> execute();
	$stmt -> bindColumn('id', $idData);
	$stmt -> bindColumn('commission_id', $commIdData);
	$stmt -> bindColumn('name', $trackNData);
	$stmt -> bindColumn('staff_info', $trackSData);
	$stmt -> bindColumn('client_info', $trackCData);
	
	echo '<table class="table-feature" id="tracks">
				<tbody>
					<tr>
						<th class="table-header">Track Name</th>
						<th class="table-header">Client Info</th>
						<th class="table-header">Staff Info</th>
						<th class="button-header">EDIT</th>
					</tr>
				';
				
	$i = 0;
	while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) {
		echo '<tr>
				<form name="track-'.$idData.'" method="POST" action="" onsubmit="return false;">
				  <td class="row-feature"><textarea class="form-control" name="trackName" readonly>'.$trackNData.'</textarea></td>
				  <td class="row-feature"><textarea class="form-control" name="trackClientInfo" readonly>'.$trackCData.'</textarea></td>
				  <td class="row-feature"><textarea class="form-control" name="trackInfo">'.$trackSData.'</textarea></td>
				  <td class="button-feature"><button onclick="updateTrackInfo('.$i.','.$loginIdData.');" style="color:green;" type="input">&#10004;</button></td>
				  <input type="hidden" value="'.$idData.'" name="trackId"/>
				</form>
			  </tr>';
		
		$i++;
	}
	echo '
			<tr>
				<td colspan="4"><br><br><a href="editDash.php#tracks" style="color: blue;">To add tracks to this client, click here.</a></td>
			</tr>
		</tbody>
	</table>';
?>