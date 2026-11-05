<?php
    if(!isset($_SESSION)) session_start();
	$_SESSION['chat-load'] = $_POST['table'];
?>