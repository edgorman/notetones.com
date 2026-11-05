<?php
	if(!isset($_SESSION)) session_start(); 
	require(dirname(__FILE__)."/../../../../../includes/php/config.php");
	
    try {
    	$conn = new PDO("mysql:host=localhost;dbname=notekuee_staff_message", $connUser, $connPass);
    	$conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e){
    	echo "Error: " . $e -> getMessage();
    }
	
	if (mysqli_connect_errno()) {
	    printf("Connect failed: %s\n", mysqli_connect_error());
	    exit();
	}
	
	$stmt = $conn -> prepare("CREATE TABLE IF NOT EXISTS ".$_SESSION['id']."_nts 
	(id INT(9) NOT NULL auto_increment PRIMARY KEY,
	 from_user VARCHAR(1000), message VARCHAR(20000),
	  seen VARCHAR(1000) DEFAULT 0,
	   datetime DATETIME NOT NULL);");
	$stmt -> execute();
?>