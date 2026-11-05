<?php
    require(dirname(__FILE__)."/../../config.php");
	
	function logoSelect($fileData){
		$fileString = "";
		
		if ($handle = opendir(dirname(__FILE__).'/../../../../../includes/images/portfolio')) {
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
	
	function portfolioSelect($typeData){
		$typeDataString = "";
		
		if($typeData == "Game") $typeDataString = '<option selected value="Game">Game</option>';
		else $typeDataString = '<option value="Game">Game</option>';
		
		if($typeData == "Film") $typeDataString .= '<option selected value="Film">Film</option>';
		else $typeDataString .= '<option value="Film">Film</option>';
		
		if($typeData == "Documentary") $typeDataString .= '<option selected value="Documentary">Documentary</option>';
		else $typeDataString .= '<option value="Documentary">Documentary</option>';
		
		if($typeData == "Presentation") $typeDataString .= '<option selected value="Presentation">Presentation</option>';
		else $typeDataString .= '<option value="Presentation">Presentation</option>';
		
		if($typeData == "Animation") $typeDataString .= '<option selected value="Animation">Animation</option>';
		else $typeDataString .= '<option value="Animation">Animation</option>';
		
		if($typeData == "Advert") $typeDataString .= '<option selected value="Advert">Advert</option>';
		else $typeDataString .= '<option value="Advert">Advert</option>';
		
		if($typeData == "Radio") $typeDataString .= '<option selected value="Radio">Radio</option>';
		else $typeDataString .= '<option value="Radio">Radio</option>';
		
		if($typeData == "Sound Effects") $typeDataString .= '<option selected value="Sound Effects">Sound Effects</option>';
		else $typeDataString .= '<option value="Sound Effects">Sound Effects</option>';
		
		return $typeDataString;
	}
	
	$stmt = $conn -> prepare("SELECT id, name, description, quote, logo, tracknum, tier, type FROM portfolio ORDER BY name");
	$stmt -> execute();
	$stmt -> bindColumn('id', $idData);
	$stmt -> bindColumn('name', $nameData);
	$stmt -> bindColumn('description', $descData);
	$stmt -> bindColumn('quote', $quoteData);
	$stmt -> bindColumn('logo', $logoData);
	$stmt -> bindColumn('tracknum', $trackNoData);
	$stmt -> bindColumn('tier', $tierData);
	$stmt -> bindColumn('type', $typeData);
	
	echo '<table class="table-feature" id="portfolio">
				<tbody>
					<tr>
						<th class="table-header">Name</th>
						<th class="table-header">Description</th>
						<th class="table-header">Quote</th>
						<th class="table-header">Logo</th>
						<th class="button-header">Track No.</th>
						<th class="button-header" style="border-right: 1px solid white;">Tier</th>
						<th class="table-header">Type</th>
						<th class="button-header">DEL</th>
						<th class="button-header">EDIT</th>
					</tr>
				';
				
	$i = 0;
	while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) {
		echo '<tr>
				<form name="portfolio-'.$idData.'" method="POST" action="" onsubmit="return false;">
				  <td class="row-feature"><textarea class="form-control" name="portfolioName">'.$nameData.'</textarea></td>
				  <td class="row-feature"><textarea class="form-control" name="portfolioDesc">'.$descData.'</textarea></td>
				  <td class="row-feature"><textarea class="form-control" name="portfolioQuote">'.$quoteData.'</textarea></td>
				  <td class="row-feature"><select class="form-control" name="portfolioLogo">'.logoSelect($logoData).'</select></td>
				  <td class="row-feature"><textarea class="form-control" name="portfolioTrackNo">'.$trackNoData.'</textarea></td>
				  <td class="row-feature"><textarea class="form-control" name="portfolioTier">'.$tierData.'</textarea></td>
				  <td class="row-feature"><select class="form-control" name="portfolioType">'.portfolioSelect($typeData).'</select></td>
				  <td class="button-feature"><button onclick="deletePortfolio('.$i.');" style="color:red;" type="input">&#10008;</button></td>
				  <td class="button-feature"><button onclick="updatePortfolio('.$i.');" style="color:green;" type="input">&#10004;</button></td>
				  <input type="hidden" value="'.$nameData.'" name="portfolioOldName"/>
				  <input type="hidden" value="'.$idData.'" name="portfolioId"/>
				</form>
			  </tr>';
		
		$i++;
	}
	
	echo '</tr>
		  	  <th class="table-header">Name</th>
			  <th class="table-header">Description</th>
			  <th class="table-header">Quote</th>
			  <th class="table-header">Logo</th>
			  <th class="button-header">Track No.</th>
			  <th class="button-header">Tier</th>
			  <th class="table-header">Type</th>
			  <td class="table-header" colspan="2">NEW</td>
		  </tr>
		  <tr>
		  	<form name="newportfolio" method="POST" action="" onsubmit="return false;">
		  	  <td class="row-feature"><textarea class="form-control" name="portfolioName"></textarea></td>
			  <td class="row-feature"><textarea class="form-control" name="portfolioDesc"></textarea></td>
			  <td class="row-feature"><textarea class="form-control" name="portfolioQuote"></textarea></td>
			  <td class="row-feature"><select class="form-control" name="portfolioLogo">'.logoSelect("").'</select></td>
			  <td class="row-feature"><textarea class="form-control" name="portfolioTrackNo"></textarea></td>
			  <td class="row-feature"><textarea class="form-control" name="portfolioTier"></textarea></td>
			  <td class="row-feature"><select class="form-control" name="portfolioType">'.portfolioSelect("").'</select></td>
			  <td class="button-feature" colspan="2"><button onclick="newPortfolio('.$i.');" style="color:green;" type="input">&#10004;</button></td>
			</form>
		  </tr>
		</tbody>
	</table>
	<br>';
?>