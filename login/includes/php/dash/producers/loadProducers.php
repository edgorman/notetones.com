<?php
	require(dirname(__FILE__)."/../config.php");
	
	function producerTrack($trackIdData){
		$trackIdString = "";
		
		require(dirname(__FILE__)."/../config.php");
		$stmtTQ = $conn -> prepare("SELECT id, name FROM tracks");
		$stmtTQ -> execute();
		$stmtTQ -> bindColumn('id', $idData);
		$stmtTQ -> bindColumn('name', $nameData);
		
		while ($row = $stmtTQ -> fetch(PDO::FETCH_BOUND)) {
			if($idData == $trackIdData) $trackIdString .= "<option selected value='$idData'>$nameData</option>";
			else $trackIdString .= "<option value='$idData'>$nameData</option>";
		}
		return $trackIdString;
	}
	
	function producerStaff($producerData){
		$producerString = "";
		
		require(dirname(__FILE__)."/../../config.php");
		$stmtTQ = $conn -> prepare("SELECT id, nickname FROM login WHERE level IN(4)");
		$stmtTQ -> execute();
		$stmtTQ -> bindColumn('id', $idData);
		$stmtTQ -> bindColumn('nickname', $nameData);
		
		while ($row = $stmtTQ -> fetch(PDO::FETCH_BOUND)) {
			if($nameData == $producerData) $producerString .= "<option selected value='$nameData'>$nameData</option>";
			else $producerString .= "<option value='$nameData'>$nameData</option>";
		}
		return $producerString;
	}
		
   	$stmt = $conn -> prepare("SELECT id, track_id, producer, time_spent FROM producers ORDER BY track_id ASC, producer ASC");
	$stmt -> execute();
	$stmt -> bindColumn('id', $idData);
	$stmt -> bindColumn('track_id', $trackIdData);
	$stmt -> bindColumn('producer', $producerData);
	$stmt -> bindColumn('time_spent', $timeSData);
	
	echo '<table class="table-feature" id="producers">
				<tbody>
					<tr>
						<th class="table-header">Track Name</th>
						<th class="table-header">Producer</th>
						<th class="table-header">Time Spent</th>
						<th class="button-header">DEL</th>
						<th class="button-header">EDIT</th>
					</tr>
				';
				
	$i = 0;
	while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) {
		echo '<tr>
				<form name="producer-'.$idData.'" method="POST" action="" onsubmit="return false;">
				  <td class="row-feature"><select class="form-control" name="producerTrack">'.producerTrack($trackIdData).'</select></td>
				  <td class="row-feature"><select class="form-control" name="producerStaff">'.producerStaff($producerData).'</select></td>
				  <td class="row-feature"><textarea class="form-control" name="producerTime" placeholder="1,5,5,0,12">'.$timeSData.'</textarea></td>
				  <td class="button-feature"><button onclick="deleteProducer('.$i.');" style="color:red;" type="input">&#10008;</button></td>
				  <td class="button-feature"><button onclick="updateProducer('.$i.');" style="color:green;" type="input">&#10004;</button></td>
				  <input type="hidden" value="'.$idData.'" name="producerId"/>
				</form>
			  </tr>';
		
		$i++;
	}
	echo '</tr>
		  	  <th class="table-header">Track Name</th>
			  <th class="table-header">Producer</th>
			  <th class="table-header">Time Spent</th>
			  <td class="table-header" colspan="2">NEW</td>
		  </tr>
		  <tr>
		  	<form name="newProducer" method="POST" action="" onsubmit="return false;">
		  	  <td class="row-feature"><select class="form-control" name="producerTrack">'.producerTrack("").'</select></td>
			  <td class="row-feature"><select class="form-control" name="producerStaff">'.producerStaff("").'</select></td>
			  <td class="row-feature"><textarea class="form-control" name="producerTime" placeholder="1,5,5,0,12"></textarea></td>
			  <td class="button-feature" colspan="2"><button onclick="newTroducer('.$i.');" style="color:green;" type="input">&#10004;</button></td>
			</form>
		  </tr>
		</tbody>
	</table>
	<br><br>';
?>