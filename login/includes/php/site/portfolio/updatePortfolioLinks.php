<?php
	$idData = $_POST['id'];
	$siteData = $_POST['site'];
	$SCLinkData = $_POST['SCLink'];
	$youtubeData = $_POST['youtube'];
	$twitterData = $_POST['twitter'];
	$soundcloudData = $_POST['soundcloud'];
	$facebookData = $_POST['facebook'];
	
	require("../../config.php");
	$stmt = $conn -> prepare("UPDATE portfolio SET site= :site, SCLink= :SCLink, youtube= :youtube, twitter= :twitter, soundcloud= :soundcloud, facebook= :facebook WHERE id= :id");
	$stmt -> bindParam(":site", $siteData);
	$stmt -> bindParam(":SCLink", $SCLinkData);
	$stmt -> bindParam(":youtube", $youtubeData);
	$stmt -> bindParam(":twitter", $twitterData);
	$stmt -> bindParam(":soundcloud", $soundcloudData);
	$stmt -> bindParam(":facebook", $facebookData);
	$stmt -> bindParam(":id", $idData);
	$stmt -> execute();
?>