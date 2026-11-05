<?php
	require(dirname(__FILE__)."/../config.php");
	
	$dateObj = time();
    $yearNumData = $_POST['year'];
	$monthNumData = $_POST['month'];
	$dayNumData = date('d', $dateObj);
	
	$firstDayData = mktime(0, 0, 0, $monthNumData, 1, $yearNumData);
	$monthNameData = date('F', $firstDayData);
	$dayOfWeekData = date('D', $firstDayData);
	
	switch($dayOfWeekData) {
		case "Sun" :
			$blankData = 0;
			break;
		case "Mon" :
			$blankData = 1;
			break;
		case "Tue" :
			$blankData = 2;
			break;
		case "Wed" :
			$blankData = 3;
			break;
		case "Thu" :
			$blankData = 4;
			break;
		case "Fri" :
			$blankData = 5;
			break;
		case "Sat" :
			$blankData = 6;
			break;
	}
	
	//We then determine how many days are in the current month
	$dayInMonthData = cal_days_in_month(0, $monthNumData, $yearNumData);
	$monthCurData = 1 * date('m', $dateObj);
	$yearCurData = date('Y', $dateObj);
	
	$monthBeforeData = $monthNumData - 1;
	$yearBeforeData = $yearNumData;
	if ($monthBeforeData == 0) {
		$yearBeforeData--;
		$monthBeforeData = 12;
	}
	
	$monthAfterData = $monthNumData + 1;
	$yearAfterData = $yearNumData;
	if ($monthAfterData == 13) {
		$yearAfterData++;
		$monthAfterData = 1;
	}
	
	//CREATE HEAD OF CALENDAR
	echo '
	<tbody>
		<tr class="calendarBlack">
			<td colspan="3" style="text-align: right;">
				<a class="btn" onclick="toggleCalendarType(0, &apos;'.$monthBeforeData.'/'.$yearBeforeData.'&apos;, 0);">←</a>
			</td>
			<td>
				'.$monthNameData.'
			</td>
			<td colspan="3" style="text-align: left;">
				<a class="btn" onclick="toggleCalendarType(0, &apos;'.$monthAfterData.'/'.$yearAfterData.'&apos;, 0);">→</a>
			</td>
		</tr>
		<tr class="calendarBlack">
			<td>S</td>
			<td>M</td>
			<td>T</td>
			<td>W</td>
			<td>T</td>
			<td>F</td>
			<td>S</td>
		</tr>';
		
	$dayCountData = 1;
	
	//INSERT BLANKS BEFORE DAYS
	echo '
		<tr class="calendarWhite">';
	
	while ($blankData > 0) {
		echo "<td><div class='nothing'></div></td>";
		$blankData--;
		$dayCountData++;
	}
	
	//FIRST DAY OF MONTH
	$curNumData = 1;
	
	while ($curNumData <= $dayInMonthData) {
		
		$stmt = $conn -> prepare("SELECT id, title, info, type FROM calendar WHERE day= :dayData AND month= :monthData AND year= :yearData");
		$stmt -> bindParam(":dayData", $curNumData);
		$stmt -> bindParam(":monthData", $monthNumData);
		$stmt -> bindParam(":yearData", $yearNumData);
		$stmt -> execute();
		$stmt -> bindColumn('id', $idData);
		$stmt -> bindColumn('title', $titleData);
		$stmt -> bindColumn('info', $infoData);
		$stmt -> bindColumn('type', $typeData);
		$count = $stmt -> rowCount();
		
		if($count == 1) {		//ONLY ONE EVENT
			while($stmt -> fetch()){
				echo "<td onclick='toggleCalendarType(1, &apos;".$curNumData."/".$monthNumData."/".$yearNumData."&apos;, 0);'>
						<div class='".$typeData."'>
							<p class='date'>".$curNumData."</p>
							<p class='title'>".$titleData."</p>
							<p class='msg'>".$infoData."</p>
						</div>
					  </td>";
			}				
		}
		else if($count >= 2) {	//MORE THAN ONE EVENT
			echo "<td onclick='toggleCalendarType(1, &apos;".$curNumData."/".$monthNumData."/".$yearNumData."&apos;, 0);'>
					<div>
						<p class='date'>".$curNumData."</p><br>";
						while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) {
							echo '<span class="'.$typeData.'">'.$titleData."</span>";
						}
			echo "		</div>
					</td>";
		}
		else {
			echo "<td onclick='toggleCalendarType(1, &apos;".$curNumData."/".$monthNumData."/".$yearNumData."&apos;, 0);'>
					<div class='general'>
						<p class='date'>".$curNumData."</p>
					</div>
				  </td>";
		}
		
		$curNumData++;
		$dayCountData++;
		
		if ($dayCountData > 7) {echo "</tr><tr class='calendarWhite'>"; $dayCountData = 1;}
	}
	
	while ($dayCountData > 1 && $dayCountData <= 7) {
		echo "<td><div class='nothing'></div></td>";
		$dayCountData++;
	}
	echo "</tr>";
	
	echo '<tr class="calendarBlack">
			<td colspan="2">
				<a class="btn" onclick="toggleCalendarType(0, &apos;'.$monthCurData."/".($yearNumData - 1).'&apos;, 0);">← '.($yearNumData - 1).'</a>
			</td>
			<td colspan="3">
				<a class="btn" onclick="toggleCalendarType(0, &apos;'.date("m/Y").'&apos;, 0);">Current Date</a>
			</td>
			<td colspan="2">
				<a class="btn" onclick="toggleCalendarType(0, &apos;'.$monthCurData."/".($yearNumData + 1).'&apos;, 0);">'.($yearNumData + 1).' →</a>
			</td>
		</tr>
	</tbody>';
?>