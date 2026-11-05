<?php
	require(dirname(__FILE__)."/../config.php");
	
	function alertSelect($typeData){
		$alertTypeString = "";
		
		if($typeData == "info") $alertTypeString = '<option selected value="info">Info</option>';
		else $alertTypeString = '<option value="info">Info</option>';
		
		if($typeData == "warning") $alertTypeString .= '<option selected value="warning">Warning</option>';
		else $alertTypeString .= '<option value="warning">Warning</option>';
		
		if($typeData == "danger") $alertTypeString .= '<option selected value="danger">Danger</option>';
		else $alertTypeString .= '<option value="danger">Danger</option>';
		
		if($typeData == "success") $alertTypeString .= '<option selected value="success">Success</option>';
		else $alertTypeString .= '<option value="success">Success</option>';
		
		return $alertTypeString;
	}
	
    $stmt = $conn -> prepare("SELECT id, title, description, type FROM alerts WHERE destination='staff'");
	$stmt -> execute();
	$stmt -> bindColumn('id', $idData);
	$stmt -> bindColumn('title', $titleData);
	$stmt -> bindColumn('description', $descData);
	$stmt -> bindColumn('type', $typeData);
	
	echo '<table class="table-feature" id="tracks">
				<tbody>
					<tr>
						<th class="table-header">Alert Title</th>
						<th class="table-header">Alert Description</th>
						<th class="table-header">Alert Type <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="Choose between success, info, warning and danger!"> </i></th>
						<th class="button-header">DEL</th>
						<th class="button-header">EDIT</th>
					</tr>
				';
				
	$i = 0;
	while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) {
		echo '<tr>
				<form name="alert-'.$idData.'" method="POST" action="" onsubmit="return false;">
				  <td class="row-feature"><textarea class="form-control" name="alertTitle">'.$titleData.'</textarea></td>
				  <td class="row-feature"><textarea class="form-control" name="alertDesc">'.$descData.'</textarea></td>
				  <td class="row-feature"><select class="form-control" name="alertType">'.alertSelect($typeData).'</select></td>
				  <td class="button-feature"><button onclick="deleteStaffAlert('.$i.');" style="color:red;" type="input">&#10008;</button></td>
				  <td class="button-feature"><button onclick="updateStaffAlert('.$i.');" style="color:green;" type="input">&#10004;</button></td>
				  <input type="hidden" value="'.$idData.'" name="alertId"/>
				</form>
			  </tr>';
		
		$i++;
	}
	
	echo '</tr>
		  	  <td class="table-header">Alert Title</td>
			  <td class="table-header">Alert Description</td>
			  <td class="table-header">Alert Type <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="Choose between success, info, warning and danger!"> </i></td>
			  <td class="table-header" colspan="2">NEW</td>
		  </tr>
		  <tr>
		  	<form name="newAlert" method="POST" action="" onsubmit="return false;">
		  	  <td class="row-feature"><textarea class="form-control" name="alertTitle"></textarea></td>
			  <td class="row-feature"><textarea class="form-control" name="alertDesc"></textarea></td>
			  <td class="row-feature"><select class="form-control" name="alertType">'.alertSelect("info").'</select></td>
			  <td class="button-feature" colspan="2"><button onclick="newStaffAlert('.$i.');" style="color:green;" type="input">&#10004;</button></td>
			</form>
		  </tr>
		</tbody>
	</table>';
?>