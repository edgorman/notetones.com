<?php
    require(dirname(__FILE__)."/../../config.php");
	
	$stmt = $conn -> prepare("SELECT id, track, artist, genre, date, tags, favourite, SCLink FROM public_library ORDER BY track");
	$stmt -> execute();
	$stmt -> bindColumn('id', $idData);
	$stmt -> bindColumn('track', $trackData);
	$stmt -> bindColumn('artist', $artistData);
	$stmt -> bindColumn('genre', $genreData);
	$stmt -> bindColumn('date', $dateData);
	$stmt -> bindColumn('tags', $tagsData);
	$stmt -> bindColumn('favourite', $favouriteData);
	$stmt -> bindColumn('SCLink', $SCLinkData);
	
	echo '<table class="table-feature" id="library">
				<tbody>
					<tr>
						<th class="table-header">Track</th>
						<th class="table-header">Artist</th>
						<th class="table-header">Genre</th>
						<th class="table-header">Date</th>
						<th class="table-header">Tags</th>
						<th class="button-header">Favourite</th>
						<th class="table-header">SCLink</th>
						<th class="button-header">DEL</th>
						<th class="button-header">EDIT</th>
					</tr>
				';
				
	$i = 0;
	while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) {
		echo '<tr>
				<form name="library-'.$idData.'" method="POST" action="" onsubmit="return false;">
				  <td class="row-feature"><textarea class="form-control" name="libraryTrack">'.$trackData.'</textarea></td>
				  <td class="row-feature"><textarea class="form-control" name="libraryArtist">'.$artistData.'</textarea></td>
				  <td class="row-feature"><textarea class="form-control" name="libraryGenre">'.$genreData.'</textarea></td>
				  <td class="row-feature"><input class="form-control" type="date" name="libraryDate" value="'.(str_replace("/", "-", $dateData)).'"/></td>
				  <td class="row-feature"><textarea class="form-control" name="libraryTags">'.$tagsData.'</textarea></td>
				  <td class="button-feature"><input type="checkbox" name="libraryFavourite" '; if($favouriteData) echo "checked"; echo '/></td>
				  <td class="row-feature"><textarea class="form-control" name="librarySCLink" onkeyup="this.value = ConvertSCTrack(this.value);">'.$SCLinkData.'</textarea></td>
				  <td class="button-feature"><button onclick="deleteLibrary('.$i.');" style="color:red;" type="input">&#10008;</button></td>
				  <td class="button-feature"><button onclick="updateLibrary('.$i.');" style="color:green;" type="input">&#10004;</button></td>
				  <input type="hidden" value="'.$idData.'" name="libraryId"/>
				</form>
			  </tr>';
		
		$i++;
	}
	
	echo '</tr>
		  	  <th class="table-header">Track</th>
			  <th class="table-header">Artist</th>
			  <th class="table-header">Genre</th>
			  <th class="table-header">Date</th>
			  <th class="table-header">Tags</th>
			  <th class="button-header">Favourite</th>
			  <th class="table-header">SCLink</th>
			  <td class="table-header" colspan="2">NEW</td>
		  </tr>
		  <tr>
		  	<form name="newlibrary" method="POST" action="" onsubmit="return false;">
		  	  <td class="row-feature"><textarea class="form-control" name="libraryTrack"></textarea></td>
			  <td class="row-feature"><textarea class="form-control" name="libraryArtist"></textarea></td>
			  <td class="row-feature"><textarea class="form-control" name="libraryGenre"></textarea></td>
			  <td class="row-feature"><input class="form-control" type="date" name="libraryDate"/></td>
			  <td class="row-feature"><textarea class="form-control" name="libraryTags"></textarea></td>
			  <td class="button-feature"><input type="checkbox" name="libraryFavourite"/></td>
			  <td class="row-feature"><textarea class="form-control" name="librarySCLink" onkeyup="this.value = ConvertSCTrack(this.value);"></textarea></td>
			  <td class="button-feature" colspan="2"><button onclick="newLibrary('.$i.');" style="color:green;" type="input">&#10004;</button></td>
			</form>
		  </tr>
		</tbody>
	</table>';
?>