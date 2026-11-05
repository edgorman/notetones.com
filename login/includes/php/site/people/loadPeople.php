<?php
    require(dirname(__FILE__)."/../../config.php");
	
	function peopleSelect($fileData){
		$fileString = "";
		
		if ($handle = opendir(dirname(__FILE__).'/../../../../../includes/images/people')) {
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
	
	$stmt = $conn -> prepare("SELECT id, name, title, img, torder, about FROM employees ORDER BY dept DESC, torder ASC");
	$stmt -> execute();
	$stmt -> bindColumn('id', $idData);
	$stmt -> bindColumn('name', $nameData);
	$stmt -> bindColumn('title', $titleData);
	$stmt -> bindColumn('img', $imgData);
	$stmt -> bindColumn('torder', $torderData);
	$stmt -> bindColumn('about', $aboutData);
	
	echo '<table class="table-feature" id="people">
				<tbody>
					<tr>
						<th class="table-header">Name</th>
						<th class="table-header">Job Title</th>
						<th class="table-header">Image</th>
						<th class="table-header">Order</th>
						<th class="table-header">About</th>
						<th class="button-header">EDIT</th>
					</tr>
				';
				
	$i = 0;
	while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) {
		echo '<tr>
				<form name="people-'.$idData.'" method="POST" action="" onsubmit="return false;">
				  <td class="row-feature"><textarea class="form-control" name="peopleName">'.$nameData.'</textarea></td>
				  <td class="row-feature"><textarea class="form-control" name="peopleTitle">'.$titleData.'</textarea></td>
				  <td class="row-feature"><select class="form-control" name="peopleImg">'.peopleSelect($imgData).'</select></td>
				  <td class="row-feature"><textarea class="form-control" name="peopleOrder">'.$torderData.'</textarea></td>
				  <td class="row-feature"><textarea class="form-control" name="peopleDesc">'.$aboutData.'</textarea></td>
				  <td class="button-feature"><button onclick="updatePeople('.$i.');" style="color:green;" type="input">&#10004;</button></td>
				  <input type="hidden" value="'.$idData.'" name="peopleId"/>
				</form>
			  </tr>';
		
		$i++;
	}
	
	echo '
		</tbody>
	</table>
	Choose a File to add to the people page. After this page has reloaded, the file will be able to be selected.
	It must be an image type which is 180 x 180 and not have the same name as another file.
	<br><br>
	<div class="col-md-6">
		<form action="#people" method="post" enctype="multipart/form-data">
			<input type="file" name="file" value="Choose File"/>
			<input type="hidden" name="directory" value="includes/images/people/"/>
			<input type="submit" name="newFile" value="Submit"/>
		</form>
	</div>
	<div class="col-md-6">
		<form action="#people" method="post">
			<select name="file">'.peopleSelect("").'</select><br>
			<input type="hidden" name="directory" value="includes/images/people/"/>
			<input type="submit" name="deleteFile" value="Delete" onclick="return confirm('."'Are your sure you want to delete this file?'".')"/>
		</form>
	</div>
	<br>';
?>