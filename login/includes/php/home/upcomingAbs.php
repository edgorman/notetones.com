<?php
	require(dirname(__FILE__)."/../config.php");
	
    $stmt = $conn -> prepare("SELECT day, month, year, info, title FROM calendar WHERE type='absence' AND date >= CURDATE() ORDER BY date ASC LIMIT 5");
	$stmt -> execute();
	$stmt -> bindColumn('day', $dayData);
	$stmt -> bindColumn('month', $monthData);
	$stmt -> bindColumn('year', $yearData);
	$stmt -> bindColumn('info', $infoData);
	$stmt -> bindColumn('title', $titleData);
	
	echo '<table class="table-feature" id="abs">
				<tbody>
					<tr>
						<th class="table-header">Name</th>
						<th class="table-header">Reason</th>
						<th class="button-header">Date</th>
						<th class="button-header">Out</th>
					</tr>
				';
	while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) {
		echo '<tr>
				  <td class="row-feature">'.$titleData.'</td>
				  <td class="row-feature">'.$infoData.'</td>
				  <td class="row-feature" colspan="2">'.$dayData."/".$monthData."/".$yearData.'</td>
			  </tr>';
	}
	
	echo '</tbody>
			<tfoot>
				<td colspan="4"><b><a href="calendar.php">Calendar Link</a></b></td>
			</tfoot>
		</table>';
?>