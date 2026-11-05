<?php
    require("../../config.php");
	
	$titleData = $_POST['title'];
	$descData = $_POST['description'];
	$deptData = $_POST['department'];
	
	$stmt = $conn -> prepare("INSERT INTO jobs (title, description, department) VALUE(:title, :description, :department)");
	$stmt -> bindParam(":title", $titleData);
	$stmt -> bindParam(":description", $descData);
	$stmt -> bindParam(":department", $deptData);
	$stmt -> execute();
	
	$stmt = $conn -> prepare("SELECT email FROM jobemails");
	$stmt -> execute();
	$stmt -> bindColumn('email', $emailData);
	
	while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) {
		mail($emailData, "Notetones Job Opening", "This is a message about a new job opening at Notetones Music Productions Services Ltd.
The following are details about this new vacancy, as well as contact details to get in touch.

Position Title: ".$titleData."
Position Department: ".$deptData."
Position Description: ".$descData."

To unsubscribe from this messaging service, please visit the notetones 'Jobs' page and reenter your email.

- Notetones

This is a pre-determined message, do not attempt to reply to this address for the new vacancy.");
	}
?>