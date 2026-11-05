<?php
	require(dirname(__FILE__)."/../config.php");
	
    $stmt = $conn -> prepare("SELECT email FROM jobemails ORDER BY email ASC");
	$stmt -> execute();
	$stmt -> bindColumn('email', $emailData);
	$incEmailData = 1;
	
	echo '<table class="table table-striped table-hover" style="max-width: 1000px;">
				<thead>
					<tr>
						<th>No. </th>
						<th>Email Name </th>
					</tr>
				</thead>
				<tbody>
				';
	while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) {
		echo '<tr style="cursor: default;">
				  <td>'.$incEmailData.'</td>
				  <td>'.$emailData.'</td>
			  </tr>';
		
		$incEmailData = $incEmailData + 1;
	}
	
	echo '</tbody>
		</table>';
?>