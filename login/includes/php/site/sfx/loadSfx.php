<?php
    require(dirname(__FILE__)."/../../config.php");
	
	function sfxFileSelect($sfxData){
		$sfxFileString = "";
		
		if ($handle = opendir(dirname(__FILE__).'/../../../../../includes/sound/sfx')) {
	    	while (false !== ($entry = readdir($handle))) {
	        	if ($entry != "." && $entry != "..") {
					if($sfxData == $entry) $sfxFileString .= "<option selected value='$entry'>$entry</option>";
					else $sfxFileString .= "<option value='$entry'>$entry</option>";
	        	}
	    	}
			closedir($handle);
		}
		
		return $sfxFileString;
	}
	
	$stmt = $conn -> prepare("SELECT id, effect, date, tags, directory FROM public_sfx ORDER BY effect");
	$stmt -> execute();
	$stmt -> bindColumn('id', $idData);
	$stmt -> bindColumn('effect', $effectData);
	$stmt -> bindColumn('date', $dateData);
	$stmt -> bindColumn('tags', $tagsData);
	$stmt -> bindColumn('directory', $directoryData);
	
	echo '<table class="table-feature" id="sfx">
				<tbody>
					<tr>
						<th class="table-header">Effect</th>
						<th class="table-header">Date</th>
						<th class="table-header">Tags</th>
						<th class="table-header">File</th>
						<th class="button-header">DEL</th>
						<th class="button-header">EDIT</th>
					</tr>
				';
				
	$i = 0;
	while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) {
		echo '<tr>
				<form name="sfx-'.$idData.'" method="POST" action="" onsubmit="return false;">
				  <td class="row-feature"><textarea class="form-control" name="sfxEffect">'.$effectData.'</textarea></td>
				  <td class="row-feature"><input class="form-control" type="date" name="sfxDate" value="'.(str_replace("/", "-", $dateData)).'"/></td>
				  <td class="row-feature"><textarea class="form-control" name="sfxTags">'.$tagsData.'</textarea></td>
				  <td class="row-feature"><select class="form-control" name="sfxDirectory">'.sfxFileSelect($directoryData).'</select></td>
				  <td class="button-feature"><button onclick="deleteSfx('.$i.');" style="color:red;" type="input">&#10008;</button></td>
				  <td class="button-feature"><button onclick="updateSfx('.$i.');" style="color:green;" type="input">&#10004;</button></td>
				  <input type="hidden" value="'.$idData.'" name="sfxId"/>
				</form>
			  </tr>';
		
		$i++;
	}
	
	echo '</tr>
		  	  <th class="table-header">Effect</th>
			  <th class="table-header">Date</th>
			  <th class="table-header">Tags</th>
			  <th class="table-header">File</th>
			  <td class="table-header" colspan="2">NEW</td>
		  </tr>
		  <tr>
		  	<form name="newSfx" method="POST" action="" onsubmit="return false;">
		  	  <td class="row-feature"><textarea class="form-control" name="sfxEffect"></textarea></td>
			  <td class="row-feature"><input class="form-control" type="date" name="sfxDate"/></td>
			  <td class="row-feature"><textarea class="form-control" name="sfxTags" placeholder="insert, tags, like, this"></textarea></td>
			 <td class="row-feature"><select class="form-control" name="sfxDirectory">'.sfxFileSelect("").'</select></td>
			  <td class="button-feature" colspan="2"><button onclick="newTfx('.$i.');" style="color:green;" type="input">&#10004;</button></td>
			</form>
		  </tr>
		</tbody>
	</table>
	Choose a Sound Effect to add to the library page. After this page has reloaded, the file will be able to be selected. If your file does
	 not upload due to its extention please message Ed. 
	<br><br>
	<div class="col-md-6">
		<form action="#sfx" method="post" enctype="multipart/form-data">
			<input type="file" name="file" value="Choose File"/>
			<input type="hidden" name="directory" value="includes/sound/sfx/"/>
			<input type="submit" name="newAudio" value="Submit"/>
		</form>
	</div>
	<div class="col-md-6">
		<form action="#sfx" method="post">
			<select name="file">'.sfxFileSelect("").'</select><br>
			<input type="hidden" name="directory" value="includes/sound/sfx/"/>
			<input type="submit" name="deleteFile" value="Delete" onclick="return confirm('."'Are your sure you want to delete this file?'".')"/>
		</form>
	</div>
	<br>';
?>