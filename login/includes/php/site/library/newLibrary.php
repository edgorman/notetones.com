<?php
    require("../../config.php");
	
	$trackData = $_POST['track'];
	$artistData = $_POST['artist'];
	$genreData = $_POST['genre'];
	$dateData = $_POST['date'];
	$tagsData = $_POST['tags'];
	$favouriteData = $_POST['favourite'];
	$SCLinkData = $_POST['SCLink'];
	
	$stmt = $conn -> prepare("INSERT INTO public_library (track, artist, genre, date, tags, favourite, SCLink) VALUE(:track, :artist, :genre, :date, :tags, :favourite, :SCLink)");
	$stmt -> bindParam(":track", $trackData);
	$stmt -> bindParam(":artist", $artistData);
	$stmt -> bindParam(":genre", $genreData);
	$stmt -> bindParam(":date", $dateData);
	$stmt -> bindParam(":tags", $tagsData);
	$stmt -> bindParam(":favourite", $favouriteData);
	$stmt -> bindParam(":SCLink", $SCLinkData);
	$stmt -> execute();
?>