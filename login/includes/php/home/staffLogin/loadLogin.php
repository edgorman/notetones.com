<?php
    require(dirname(__FILE__)."/../../config.php");
	
	function deptSelect($leveData){
		$deptString = "";
		
		if($leveData == "1") $deptString = '<option selected value="1">SLT</option>';
		else $deptString = '<option value="1">SLT</option>';
		
		if($leveData == "2") $deptString .= '<option selected value="2">ADM</option>';
		else $deptString .= '<option value="2">ADM</option>';
		
		if($leveData == "3") $deptString .= '<option selected value="3">CNT</option>';
		else $deptString .= '<option value="3">CNT</option>';
		
		if($leveData == "4") $deptString .= '<option selected value="4">PRD</option>';
		else $deptString .= '<option value="4">PRD</option>';
		
		return $deptString;
	}
	
	$stmt = $conn -> prepare("SELECT id, username, nickname, level, contact, lockState FROM login WHERE level IN(1,2,3,4) ORDER BY level");
	$stmt -> execute();
	$stmt -> bindColumn('id', $idData);
	$stmt -> bindColumn('username', $usernameData);
	$stmt -> bindColumn('nickname', $nicknameData);
	$stmt -> bindColumn('level', $leveData);
	$stmt -> bindColumn('contact', $contactData);
	$stmt -> bindColumn('lockState', $lockData);
	
	echo '<table class="table-feature" id="login">
				<tbody>
					<tr>
						<th class="table-header">Username</th>
						<th class="table-header">Nickname</th>
						<th class="table-header">Department</th>
						<th class="table-header">Contact</th>
						<th class="button-header" style="border-left: 1px solid #ccc;">Lock Out</th>
						<th class="button-header">DEL</th>
						<th class="button-header">EDIT</th>
					</tr>
				';
				
	$i = 0;
	while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) {
		echo '<tr>
				<form name="login-'.$idData.'" method="POST" action="" onsubmit="return false;">
				  <td class="row-feature"><textarea class="form-control" name="loginUser">'.$usernameData.'</textarea></td>
				  <td class="row-feature"><textarea class="form-control" name="loginNick">'.$nicknameData.'</textarea></td>
				  <td class="row-feature"><select class="form-control" name="loginDept" onchange="deptLogin('.$i.')">'.deptSelect($leveData).'</select></td>
				  <td class="row-feature"><textarea class="form-control" name="loginContact">'.$contactData.'</textarea></td>
				  <td class="button-feature"><input type="checkbox" name="loginLock" '; if($lockData == "1") echo "checked"; echo '/></td>
				  <td class="button-feature"><button onclick="deleteLogin('.$i.');" style="color:red;" type="input">&#10008;</button></td>
				  <td class="button-feature"><button onclick="updateLogin('.$i.');" style="color:green;" type="input">&#10004;</button></td>
				  <input type="hidden" value="'.$idData.'" name="loginId"/>
				</form>
			  </tr>';
		
		$i++;
	}
	
	echo '</tr>
		  	  <th class="table-header">Username</th>
			  <th class="table-header">Nickname</th>
			  <th class="table-header">Department</th>
			  <th class="table-header">Contact</th>
			  <th class="button-header">Lock Out</th>
			  <td class="table-header" colspan="2">NEW</td>
		  </tr>
		  <tr>
		  	<form name="newCarousel" method="POST" action="" onsubmit="return false;">
			  <td class="row-feature"><textarea class="form-control" name="loginUser"></textarea></td>
			  <td class="row-feature"><textarea class="form-control" name="loginNick"></textarea></td>
			  <td class="row-feature"><select class="form-control" name="loginDept" onchange="deptLogin('.$i.')">'.deptSelect("").'</select></td>
			  <td class="row-feature"><textarea class="form-control" name="loginContact"></textarea></td>
			  <td class="button-feature"><input type="checkbox" name="loginLock"/></td>
			  <td class="button-feature" colspan="2"><button onclick="newLogin('.$i.');" style="color:green;" type="input">&#10004;</button></td>
			</form>
		  </tr>
		</tbody>
	</table>';
?>