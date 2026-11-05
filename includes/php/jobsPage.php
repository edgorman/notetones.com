<?php
    require_once("config.php");
	
	$stmt = $conn -> prepare("SELECT id, title, description, department FROM jobs ORDER BY title");
    $stmt -> execute();
	$stmt -> bindColumn('id', $idData);
	$stmt -> bindColumn('title', $titleData);
	$stmt -> bindColumn('description', $descData);
	$stmt -> bindColumn('department', $deptData);
	$jobArray = array();
	
	while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) {
		$deptAlert = "default";
		if($deptData == "leadership") $deptAlert = 'info';
		else if($deptData == "production") $deptAlert = 'danger';
		else if($deptData == "content") $deptAlert = 'success';
		else if($deptData == "administration") {$deptAlert = 'warning'; $deptData = "admin";}
		$jobArray[(sizeof($jobArray))] = array($titleData, $descData, $deptData, $deptAlert);
	}
	
	for($j = 0; $j < 3; $j++){
		echo '<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12" style="padding: 1px 3px 3px 1px;">';
		for($i = $j; $i < sizeof($jobArray); $i = $i + 3){
			echo '<div onclick="document.location.href = &quot;../people#'.$jobArray[$i][2].'&quot;" style="cursor: pointer;" title="View Department">
					<div class="alert alert-'.$jobArray[$i][3].'" style="padding-bottom: 30px; border-radius: 0px; margin-bottom: 6px;">
					  	<b>'.$jobArray[$i][0].'</b>
						<br><br>
						'.$jobArray[$i][1].'<br><br>
						<a href="../contact/" style="float: right;">
							<i>Contact Us Here <i class="fa fa-envelope" style="padding-left: 10px;"></i></i>
						</a>
				  	</div>
				  </div>';
		}
		echo '</div>';
	}
?>