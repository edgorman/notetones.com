<?php
    require(dirname(__FILE__)."/../config.php");
	
	$idData = $_POST['id'];
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
	
	echo "<tr class='calendarWhite'>
			<td colspan='7' style='min-height: 250px; padding: 20px;'>
				<form action='' name='editEvent' onsubmit='return false;' class='form-inline'>
					<div class='form-group' style='font-size: 30px;'>";
					
					$stmt = $conn -> prepare("SELECT id, title, info, type, time FROM calendar WHERE id= :idData");
					$stmt -> bindParam(":idData", $idData);
					$stmt -> execute();
					$stmt -> bindColumn('id', $idData);
					$stmt -> bindColumn('title', $titleData);
					$stmt -> bindColumn('info', $infoData);
					$stmt -> bindColumn('type', $typeData);
					$stmt -> bindColumn('time', $timeData);
					
					while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) {
						echo '<label for="eventTitle">TITLE: </label> <input style="width: 80%; float:right;" type="text" value="'.$titleData.'" class="form-control" id="eventTitle" placeholder="Enter info here" name="eventTitle">
								<br>
							  <label for="eventTime">TIME: </label> <input style="width: 80%; float:right;" type="text" value="'.$timeData.'" class="form-control" id="eventTime" placeholder="Enter info here" name="eventTime">
							  	<br>
							  <label for="eventMessage">MESSAGE: </label> <textarea style="width: 80%; resize: none; float:right;" class="form-control" id="eventMessage" placeholder="Enter info here" name="eventMessage">'.$infoData.'</textarea>
							  	<br><br>
							  <input type="hidden" name="eventUpload" value=""/>
							  <div style="text-align: center;">
							  	<a class="btn" onclick="updateCalendar(1, &apos;'.$dayNumData."/".$monthNumData."/".$yearNumData.'&apos;, &apos;'.$idData.'&apos;);">Update</a>
							  	<select name="eventType" style="font-size: 20px;" onchange="changeCalendar();">';
									if($typeData == "general") echo "<option value='general' selected>General</option>";
									else echo "<option value='general'>General</option>";
									if($typeData == "upload") echo "<option value='upload' selected>Upload</option>";
									else echo "<option value='upload'>Upload</option>";
									if($typeData == "absence") echo "<option value='absence' selected>Absence</option>";
									else echo "<option value='absence'>Absence</option>";
									if($typeData == "misc") echo "<option value='misc' selected>Misc</option>";
									else echo "<option value='misc'>Misc</option>";
						  echo '</select>
							  	<a class="btn" onclick="deleteCalendar(1, &apos;'.$dayNumData."/".$monthNumData."/".$yearNumData.'&apos;, &apos;'.$idData.'&apos;);">Delete</a>
							  </div>';
					}
						
	echo "			</div>
				</form>
			</td>
		</tr>";
	
	echo '<tr class="calendarBlack">
			<td colspan="3">
				<a class="btn" onclick="toggleCalendarType(1, &apos;'.$dayNumData."/".$monthNumData."/".$yearNumData.'&apos;, 0);">Back</a>
			</td>
			<td></td>
			<td colspan="3">
				
			</td>
		</tr>
	</tbody>';
?>