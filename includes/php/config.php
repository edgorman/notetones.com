<?php
	require(dirname(__FILE__)."/config-info.php");
	//$conn = mysqli_connect("localhost", $connUser, $connPass, "notekuee_staff_use");
	try {
    	$conn = new PDO("mysql:host=localhost;dbname=notekuee_staff_use", $connUser, $connPass);
    	$conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e){
    	echo "Error: " . $e -> getMessage();
    }
	
	if (mysqli_connect_errno()) {
	    printf("Connect failed: %s\n", mysqli_connect_error());
	    exit();
	}
?>