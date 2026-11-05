<?php
	require(dirname(__FILE__)."/../config.php");
	
    $stmt = $conn -> prepare("SELECT day, month, year, info, upload FROM calendar WHERE type='upload' AND date >= CURDATE() ORDER BY date ASC LIMIT 5");
	$stmt -> execute();
	$stmt -> bindColumn('day', $dayData);
	$stmt -> bindColumn('month', $monthData);
	$stmt -> bindColumn('year', $yearData);
	$stmt -> bindColumn('info', $infoData);
	$stmt -> bindColumn('upload', $uploadData);
	
	echo '<table class="table-feature" id="tracks">
				<tbody>
					<tr>
						<th class="table-header">Track Producer</th>
						<th class="table-header">Track Type</th>
						<th class="button-header">Date</th>
						<th class="button-header">Due</th>
					</tr>
				';
	while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) {
		echo '<tr>
				  <td class="row-feature">'.$infoData.'</td>
				  <td class="row-feature">'.$uploadData.'</td>
				  <td class="row-feature" colspan="2">'.$dayData."/".$monthData."/".$yearData.'</td>
			  </tr>';
	}
	
	echo '</tbody>
			<tfoot>
				<td colspan="4"><b><a href="calendar.php">Calendar Link</a></b></td>
			</tfoot>
		</table>';

?>