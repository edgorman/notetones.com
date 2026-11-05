<?php
	function logoLinkSelect($fileData){
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

    require(dirname(__FILE__)."/../../config.php");
	$stmt = $conn -> prepare("SELECT id, name, site, SCLink, youtube, twitter, soundcloud, facebook FROM portfolio ORDER BY name");
	$stmt -> execute();
	$stmt -> bindColumn('id', $idData);
	$stmt -> bindColumn('name', $nameData);
	$stmt -> bindColumn('site', $siteData);
	$stmt -> bindColumn('SCLink', $SCLinkData);
	$stmt -> bindColumn('youtube', $youtubeData);
	$stmt -> bindColumn('twitter', $twitterData);
	$stmt -> bindColumn('soundcloud', $soundcloudData);
	$stmt -> bindColumn('facebook', $facebookData);
	
	echo '<table class="table-feature" id="portfolioLinks">
				<tbody>
					<tr>
						<th class="table-header">Name</th>
						<th class="table-header">Website</th>
						<th class="table-header">SCLink</th>
						<th class="table-header">Youtube</th>
						<th class="table-header">Twitter</th>
						<th class="table-header">SoundCloud</th>
						<th class="table-header">Facebook</th>
						<th class="table-header">EDIT</th>
					</tr>
				';
				
	$i = 0;
	while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) {
		echo '<tr>
				<form name="portfolio-'.$idData.'" method="POST" action="" onsubmit="return false;">
				  <td class="row-feature"><textarea class="form-control" name="portfolioLName" readonly>'.$nameData.'</textarea></td>
				  <td class="row-feature"><textarea class="form-control" name="portfolioSite" placeholder="http://notetones.com">'.$siteData.'</textarea></td>
				  <td class="row-feature"><textarea class="form-control" name="portfolioSCLink" placeholder="22100279" onkeyup="this.value = ConvertSCPlaylist(this.value);">'.$SCLinkData.'</textarea></td>
				  <td class="row-feature"><textarea class="form-control" name="portfolioYoutube" placeholder="https://www.youtube.com/user/notetonesmusic">'.$youtubeData.'</textarea></td>
				  <td class="row-feature"><textarea class="form-control" name="portfolioTwitter" placeholder="https://twitter.com/notetones">'.$twitterData.'</textarea></td>
				  <td class="row-feature"><textarea class="form-control" name="portfolioSoundcloud" placeholder="https://soundcloud.com/notetones">'.$soundcloudData.'</textarea></td>
				  <td class="row-feature"><textarea class="form-control" name="portfolioFacebook" placeholder="https://facebook.com/notetones">'.$facebookData.'</textarea></td>
				  <td class="row-feature"><button onclick="updatePortfolioLinks('.$i.');" style="color:green;" type="input">&#10004;</button></td>
				  <input type="hidden" value="'.$idData.'" name="portfolioLId"/>
				</form>
			  </tr>';
		
		$i++;
	}
	
	echo '
		</tbody>
	</table>
	Choose a File to add to the portfolio page. After this page has reloaded, the file will be able to be selected.
	It must be an image type which is 160 x 160 and not have the same name as another file.
	<br><br>
	<div class="col-md-6">
		<form action="#portfolio" method="post" enctype="multipart/form-data">
			<input type="file" name="file" value="Choose File"/>
			<input type="hidden" name="directory" value="includes/images/portfolio/"/>
			<input type="submit" name="newFile" value="Submit"/>
		</form>
	</div>
	<div class="col-md-6">
		<form action="#portfolio" method="post">
			<select name="file">'.logoLinkSelect("").'</select><br>
			<input type="hidden" name="directory" value="includes/images/portfolio/"/>
			<input type="submit" name="deleteFile" value="Delete" onclick="return confirm('."'Are your sure you want to delete this file?'".')"/>
		</form>
	</div>
	<br>';
?>