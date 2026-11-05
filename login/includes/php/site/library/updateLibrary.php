<?php
    require("../../config.php");
	
	$idData = $_POST['id'];
	$trackData = $_POST['track'];
	$artistData = $_POST['artist'];
	$genreData = $_POST['genre'];
	$dateData = $_POST['date'];
	$tagsData = $_POST['tags'];
	$favouriteData = $_POST['favourite'];
	$SCLinkData = $_POST['SCLink'];
	
	$stmt = $conn -> prepare("UPDATE public_library SET track= :track, artist= :artist, genre= :genre, date= :date, tags= :tags, favourite= :favourite, SCLink= :SCLink WHERE id= :id");
	$stmt -> bindParam(":id", $idData);
	$stmt -> bindParam(":track", $trackData);
	$stmt -> bindParam(":artist", $artistData);
	$stmt -> bindParam(":genre", $genreData);
	$stmt -> bindParam(":date", $dateData);
	$stmt -> bindParam(":tags", $tagsData);
	$stmt -> bindParam(":favourite", $favouriteData);
	$stmt -> bindParam(":SCLink", $SCLinkData);
	$stmt -> execute();
?>