<?php
    require(dirname(__FILE__)."/../config.php");
	
    $yearNumData = $_POST['year'];
	$monthNumData = $_POST['month'];
	$dayNumData = $_POST['day'];
	$dayInMonthData = cal_days_in_month(0, $monthNumData, $yearNumData);
	
	$dayBeforeData = $dayNumData - 1;
	$monthBeforeData = $monthNumData;
	$yearBeforeData = $yearNumData;
	if ($dayBeforeData <= 0) {
		$monthBeforeData--;
		$dayBeforeData = $dayInMonthData;
		
		if ($monthBeforeData == 0) {
			$yearBeforeData--;
			$monthBeforeData = 12;
		}
	}
	
	$dayAfterData = $dayNumData + 1;
	$monthAfterData = $monthNumData;
	$yearAfterData = $yearNumData;
	if ($dayAfterData >= $dayInMonthData) {
		$monthAfterData++;
		$dayAfterData = 1;
		
		if ($monthAfterData == 13) {
			$yearAfterData++;
			$monthAfterData = 1;
		}
	}
	
	//CREATE HEAD OF CALENDAR
	echo '
	<tbody>
		<tr class="calendarBlack">
			<td colspan="3" style="text-align: right;">
				<a class="btn" onclick="toggleCalendarType(1, &apos;'.$dayBeforeData.'/'.$monthBeforeData.'/'.$yearBeforeData.'&apos;, 0);">←</a>
			</td>
			<td>
				'.$dayNumData.' / '.$monthNumData.'
			</td>
			<td colspan="3" style="text-align: left;">
				<a class="btn" onclick="toggleCalendarType(1, &apos;'.$dayAfterData.'/'.$monthAfterData.'/'.$yearAfterData.'&apos;, 0);">→</a>
			</td>
		</tr>
		<tr class="calendarBlack">
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>';
	
	$stmt = $conn -> prepare("SELECT id, title, info, type FROM calendar WHERE day= :dayData AND month= :monthData AND year= :yearData");
	$stmt -> bindParam(":dayData", $dayNumData);
	$stmt -> bindParam(":monthData", $monthNumData);
	$stmt -> bindParam(":yearData", $yearNumData);
	$stmt -> execute();
	$stmt -> bindColumn('id', $idData);
	$stmt -> bindColumn('title', $titleData);
	$stmt -> bindColumn('info', $infoData);
	$stmt -> bindColumn('type', $typeData);
	
	while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) {
		echo "<tr class='calendarWhite'>
				<td colspan='6' style='min-height: 250px; padding: 0 20px 20px 20px;'>
					<h1>".$titleData."</h1>
					<p>".$infoData."</p>
				</td>
				<td onclick='toggleCalendarType(3, &apos;".$dayNumData."/".$monthNumData."/".$yearNumData."&apos;, &apos;".$idData."&apos;);'>
					<h1 style='text-align: center;'><i class='fa fa-wrench'></i></h1>
				</td>
			</tr>";
	}
	
	echo '<tr class="calendarBlack">
			<td colspan="3">
				<a class="btn" onclick="toggleCalendarType(0, &apos;'.date("m/Y").'&apos;, 0);">Back</a>
			</td>
			<td></td>
			<td colspan="3">
				<a class="btn" onclick="toggleCalendarType(2, &apos;'.$dayNumData."/".$monthNumData."/".$yearNumData.'&apos;, 0);">New Event</a>
			</td>
		</tr>
	</tbody>';
?>