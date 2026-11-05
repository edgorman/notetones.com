<?php
    require(dirname(__FILE__)."/../../config.php");
	
	function departmentSelect($deptData){
		$deptString = "";
		
		if($deptData == "leadership") $deptString = '<option selected value="leadership">Leadership</option>';
		else $deptString = '<option value="leadership">Leadership</option>';
		
		if($deptData == "production") $deptString .= '<option selected value="production">Production</option>';
		else $deptString .= '<option value="production">Production</option>';
		
		if($deptData == "content") $deptString .= '<option selected value="content">Content</option>';
		else $deptString .= '<option value="content">Content</option>';
		
		if($deptData == "administration") $deptString .= '<option selected value="administration">Administration</option>';
		else $deptString .= '<option value="administration">Administration</option>';
		
		return $deptString;
	}
	
	$stmt = $conn -> prepare("SELECT id, title, description, department FROM jobs ORDER BY title ASC");
	$stmt -> execute();
	$stmt -> bindColumn('id', $idData);
	$stmt -> bindColumn('title', $titleData);
	$stmt -> bindColumn('description', $descData);
	$stmt -> bindColumn('department', $deptData);
	
	echo '<table class="table-feature" id="vacancies">
				<tbody>
					<tr>
						<th class="table-header">Job Title</th>
						<th class="table-header">Job Description</th>
						<th class="table-header">Job Department</th>
						<th class="button-header">DEL</th>
						<th class="button-header">EDIT</th>
					</tr>
				';
				
	$i = 0;
	while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) {
		echo '<tr>
				<form name="vacancies-'.$idData.'" method="POST" action="" onsubmit="return false;">
				  <td class="row-feature"><textarea class="form-control" name="vacanciesTitle">'.$titleData.'</textarea></td>
				  <td class="row-feature"><textarea class="form-control" name="vacanciesDesc">'.$descData.'</textarea></td>
				  <td class="row-feature"><select class="form-control" name="vacanciesDept">'.departmentSelect($deptData).'</select></td>
				  <td class="button-feature"><button onclick="deleteVacancies('.$i.');" style="color:red;" type="input">&#10008;</button></td>
				  <td class="button-feature"><button onclick="updateVacancies('.$i.');" style="color:green;" type="input">&#10004;</button></td>
				  <input type="hidden" value="'.$idData.'" name="vacanciesId"/>
				</form>
			  </tr>';
		
		$i++;
	}
	
	echo '</tr>
		  	  <th class="table-header">Job Title</th>
			  <th class="table-header">Job Description</th>
			  <th class="table-header">Job Department</th>
			  <td class="table-header" colspan="2">NEW</td>
		  </tr>
		  <tr>
		  	<form name="newVacancies" method="POST" action="" onsubmit="return false;">
		  	  <td class="row-feature"><textarea class="form-control" name="vacanciesTitle"></textarea></td>
				  <td class="row-feature"><textarea class="form-control" name="vacanciesDesc"></textarea></td>
				  <td class="row-feature"><select class="form-control" name="vacanciesDept">'.departmentSelect("").'</select></td>
			  <td class="button-feature" colspan="2"><button onclick="newTacancies('.$i.');" style="color:green;" type="input">&#10004;</button></td>
			</form>
		  </tr>
		</tbody>
	</table>';
?>