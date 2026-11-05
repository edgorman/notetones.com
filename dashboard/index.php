<?php
	session_start();
	require_once("includes/php/config.php");
	
	$stmt = $conn -> prepare("DELETE FROM loginattempts WHERE expire < (now())");
	$stmt -> execute();
		
	if(isset($_SESSION['loggedIn'])){
		if ($_SESSION['loggedIn'] == 1) {
			$stmt = $conn -> prepare("SELECT level FROM login WHERE id=:idData");
			$stmt -> bindParam(':idData', $_SESSION['id']);
			$stmt -> execute();
			$stmt -> bindColumn('level', $levelData);
			
			while($row = $stmt->fetch(PDO::FETCH_BOUND)) {
				if($levelData == 10 || $levelData == 11){
					$stmtHalf = $conn -> prepare("SELECT lockState FROM login WHERE id=:idData");
					$stmtHalf -> bindParam(':idData', $_SESSION['id']);
					$stmtHalf -> execute();
					$stmtHalf -> bindColumn('lockState', $lockStateData);
					while ($row = $stmtHalf -> fetch(PDO::FETCH_BOUND)) {}
					
					while($stmtHalf -> fetch()){
						if($lockStateData == 0){
							require(dirname(__FILE__)."/includes/php/dash/config.php");
							$actionData = "Logged into Dash.";
							$actionByData = "Client";
							$timestampData = date("Y-m-d h:i:s");
							$clientSeeData = "0";
							
							$stmtTQ = $conn -> prepare("INSERT INTO prod_log (login_id, action, action_by, timestamp, client_see) VALUES(:loginIdData, :actionData, :actionByData, :timestampData, :clientSeeData)");
							$stmtTQ -> bindParam(":loginIdData", $_SESSION['id']);
							$stmtTQ -> bindParam(":actionData", $actionData);
							$stmtTQ -> bindParam(":actionByData", $actionByData);
							$stmtTQ -> bindParam(":timestampData", $timestampData);
							$stmtTQ -> bindParam(":clientSeeData", $clientSeeData);
							$stmtTQ -> execute();
							header("Location: home.php");
						}
						else{
							echo "<p style='text-align: center; color:red; margin-top:50px; margin-bottom: 50px;'>
							Unfortunately you cannot login at this time. The site is undergoing maintenance. Please return after a bit!</p>";
							
							$_SESSION['loggedIn'] = 0;
						}
					}
				}
			}
		}
	}
	else {
		$_SESSION['loggedIn'] = 0;
		$_SESSION['id'] = 0;
	}
	
	if (isset($_POST['submit'])) {
		$usernameData = $_POST['username'];
		$passwordData = sha1(md5($_POST['password']));
		
		$stmt = $conn -> prepare("SELECT id, level FROM login WHERE username=:usernameData AND password=:passworData");
		$stmt -> bindParam(':usernameData', $usernameData);
		$stmt -> bindParam(':passworData', $passwordData);
		$stmt -> execute();
		$stmt -> bindColumn('id', $idData);
		$stmt -> bindColumn('level', $levelData);
		$count = $stmt -> rowCount();
		while ($row = $stmt -> fetch(PDO::FETCH_BOUND)) {}
		
		if($count == 1){
			$_SESSION['id'] = $idData;
			$_SESSION['loggedIn'] = 1;
			
			if($levelData == 10 || $levelData == 11){
				$stmtHalf = $conn -> prepare("SELECT lockState FROM login WHERE id=:idData");
				$stmtHalf -> bindParam(':idData', $idData);
				$stmtHalf -> execute();
				$stmtHalf -> bindColumn('lockState', $lockStateData);
				
				while ($row = $stmtHalf -> fetch(PDO::FETCH_BOUND)) {
					if($lockStateData == 0){
						require(dirname(__FILE__)."/includes/php/dash/config.php");
							$actionData = "Logged into Dash.";
							$actionByData = "Client";
							$timestampData = date("Y-m-d h:i:s");
							$clientSeeData = "0";
							
							$stmtTQ = $conn -> prepare("INSERT INTO prod_log (login_id, action, action_by, timestamp, client_see) VALUES(:loginIdData, :actionData, :actionByData, :timestampData, :clientSeeData)");
							$stmtTQ -> bindParam(":loginIdData", $_SESSION['id']);
							$stmtTQ -> bindParam(":actionData", $actionData);
							$stmtTQ -> bindParam(":actionByData", $actionByData);
							$stmtTQ -> bindParam(":timestampData", $timestampData);
							$stmtTQ -> bindParam(":clientSeeData", $clientSeeData);
							$stmtTQ -> execute();
						header("Location: home.php");
					}
					else{
						echo "<p style='text-align: center; color:red; margin-top:50px; margin-bottom: 50px;'>
						Unfortunately you cannot login at this time. The site is undergoing maintenance. Please return after a bit!</p>";
						
						$_SESSION['loggedIn'] = 0;
					}
				}
			}
			else {
				require_once("includes/php/loginAttempts.php");
				
				echo "<p style='text-align: center; color:red; margin-top:50px; margin-bottom: 50px;'>Please check you are on the correct page</p>";
			}
		}
		else {
			require_once("includes/php/loginAttempts.php");
			
			echo "<p style='text-align: center; color:red; margin-top:50px; margin-bottom: 50px;'>Wrong Username or Password</p>";
		}
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-9" />
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<script src="../bootstrap/js/jquery-2.1.0.min.js"></script>
		<script src="../bootstrap/js/bootstrap.min.js"></script>
		<link type="text/css" rel="stylesheet" href="../bootstrap/css/bootstrap.min.css"/>
		<link type="text/css" rel="stylesheet" href="../includes/css/font-awesome.min.css"/>

		<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css">
		<link href="http://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet" type="text/css">
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet" type="text/css">

		<link rel="shortcut icon" href="../includes/images/Icon.ico">
		<script src="../includes/js/script.js"></script>
		<link type="text/css" rel="stylesheet" href="../includes/css/stylesheet.css"/>

		<title>Notetones | Dashboard</title>
	</head>
	<body>
		<div class="" style="margin: 50px auto; width: 290px;">
			<div class="wrapper">
				<form name="loginForm" class="form-signin" method="post" action="">
					<h2 class="form-signin-heading">Dashboard login</h2>
					<?php
						require_once("includes/php/config.php");
						
						$stmt = $conn -> prepare("SELECT id FROM loginattempts WHERE ip= :serverAddress AND attempts = 4");
						$serverAddress = $_SERVER["REMOTE_ADDR"];
						$stmt -> bindParam(":serverAddress", $serverAddress);
						$stmt -> execute();
						$count = $stmt -> rowCount();
												
						if($count == 0){
					?>
					<input type="text" class="form-control l-username" name="username" placeholder="Username" autofocus="" />
					<input type="password" class="form-control l-password" name="password" placeholder="Password"/>
					<br>
					<input class="btn btn-lg btn-primary btn-block" name="submit" type="submit" value="Login"/>
					<br>
					<a href="forgot.php">Forgot Your Password?</a>
					<br>
					<a href="../">Back To Notetones</a>
					<?php
						} else {
							echo "<p style='text-align: center; color:red;'>You have to wait five minutes until you can login again.</p>";
						}	
					?>
				</form>
			</div>
		</div>
	</body>
</html>