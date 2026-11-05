<?php
    require(dirname(__FILE__)."/../../config.php");
	
	function fileSelect($fileData){
		$fileString = "";
		
		if ($handle = opendir(dirname(__FILE__).'/../../../../../includes/images/carousel')) {
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
	
	function positionSelect($captionPosData){
		$positionString = "";
		
		if($captionPosData == "top-right") $positionString = '<option selected value="top-right">Top Right</option>';
		else $positionString = '<option value="top-right">Top Right</option>';
		
		if($captionPosData == "top-left") $positionString .= '<option selected value="top-left">Top Left</option>';
		else $positionString .= '<option value="top-left">Top Left</option>';
		
		if($captionPosData == "bottom-right") $positionString .= '<option selected value="bottom-right">Bottom Right</option>';
		else $positionString .= '<option value="bottom-right">Bottom Right</option>';
		
		if($captionPosData == "bottom-left") $positionString .= '<option selected value="bottom-left">Bottom Left</option>';
		else $positionString .= '<option value="bottom-left">Bottom Left</option>';
		
		return $positionString;
	}
	
	function screenPositionSelect($screenPosData){
		$screenPosString = "";
		
		if($screenPosData == "left") $screenPosString = '<option selected value="left">Left</option>';
		else $screenPosString = '<option value="left">Left</option>';
		
		if($screenPosData == "center") $screenPosString .= '<option selected value="center">Center</option>';
		else $screenPosString .= '<option value="center">Center</option>';
		
		if($screenPosData == "right") $screenPosString .= '<option selected value="right">Right</option>';
		else $screenPosString .= '<option value="right">Right</option>';
		
		return $screenPosString;
	}
	
	$stmt = $conn -> prepare("SELECT id, file, captionTitle, captionDesc, captionPos, torder, screenPos FROM carousel ORDER BY torder");
	$stmt -> execute();
	$stmt -> bindColumn('id', $idData);
	$stmt -> bindColumn('file', $fileData);
	$stmt -> bindColumn('captionTitle', $captionTitleData);
	$stmt -> bindColumn('captionDesc', $captionDescData);
	$stmt -> bindColumn('captionPos', $captionPosData);
	$stmt -> bindColumn('torder', $torderData);
	$stmt -> bindColumn('screenPos', $screenPosData);
	
	echo '<table class="table-feature" id="carousel">
				<tbody>
					<tr>
						<th class="table-header">Caption Title</th>
						<th class="table-header">Caption Description</th>
						<th class="table-header">Caption Position</th>
						<th class="table-header">File</th>
						<th class="table-header">Screen Position</th>
						<th class="table-header">Order</th>
						<th class="button-header">DEL</th>
						<th class="button-header">EDIT</th>
					</tr>
				';
				
	$i = 0;
	while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) {
		echo '<tr>
				<form name="carousel-'.$idData.'" method="POST" action="" onsubmit="return false;">
				  <td class="row-feature"><textarea class="form-control" name="carouselTitle">'.$captionTitleData.'</textarea></td>
				  <td class="row-feature"><textarea class="form-control" name="carouselDesc">'.$captionDescData.'</textarea></td>
				  <td class="row-feature"><select class="form-control" name="carouselPosition">'.positionSelect($captionPosData).'</select></td>
				  <td class="row-feature"><select class="form-control" name="carouselFile">'.fileSelect($fileData).'</select></td>
				  <td class="row-feature"><select class="form-control" name="carouselScreenPos">'.screenPositionSelect($screenPosData).'</select></td>
				  <td class="row-feature"><textarea class="form-control" name="carouselOrder">'.$torderData.'</textarea></td>
				  <td class="button-feature"><button onclick="deleteCarousel('.$i.');" style="color:red;" type="input">&#10008;</button></td>
				  <td class="button-feature"><button onclick="updateCarousel('.$i.');" style="color:green;" type="input">&#10004;</button></td>
				  <input type="hidden" value="'.$idData.'" name="carouselId"/>
				</form>
			  </tr>';
		
		$i++;
	}
	
	echo '</tr>
		  	  <th class="table-header">Caption Title</th>
			  <th class="table-header">Caption Description</th>
			  <th class="table-header">Caption Position</th>
			  <th class="table-header">File</th>
			  <th class="table-header">Screen Position</th>
			  <th class="table-header">Order</th>
			  <td class="table-header" colspan="2">NEW</td>
		  </tr>
		  <tr>
		  	<form name="newCarousel" method="POST" action="" onsubmit="return false;">
			  <td class="row-feature"><textarea class="form-control" name="carouselTitle"></textarea></td>
			  <td class="row-feature"><textarea class="form-control" name="carouselDesc"></textarea></td>
			  <td class="row-feature"><select class="form-control" name="carouselPosition">'.positionSelect("").'</select></td>
			  <td class="row-feature"><select class="form-control" name="carouselFile">'.fileSelect("").'</select></td>
			  <td class="row-feature"><select class="form-control" name="carouselScreenPos">'.screenPositionSelect("").'</select></td>
			  <td class="row-feature"><textarea class="form-control" name="carouselOrder"></textarea></td>
			  <td class="button-feature" colspan="2"><button onclick="newTarousel('.$i.');" style="color:green;" type="input">&#10004;</button></td>
			</form>
		  </tr>
		</tbody>
	</table>
	Choose a File to add to the carousel page. After this page has reloaded, the file will be able to be selected.
	It must be an image type which is 1200 x 450, and not have the same name as another file.
	<br><br>
	<div class="col-md-6">
		<form action="#carousel" method="post" enctype="multipart/form-data">
			<input type="file" name="file" value="Choose File"/>
			<input type="hidden" name="directory" value="includes/images/carousel/"/>
			<input type="submit" name="newFile" value="Submit"/>
		</form>
	</div>
	<div class="col-md-6">
		<form action="#carousel" method="post">
			<select name="file">'.fileSelect("").'</select><br>
			<input type="hidden" name="directory" value="includes/images/carousel/"/>
			<input type="submit" name="deleteFile" value="Delete" onclick="return confirm('."'Are your sure you want to delete this file?'".')"/>
		</form>
	</div>
	<br>';
?>