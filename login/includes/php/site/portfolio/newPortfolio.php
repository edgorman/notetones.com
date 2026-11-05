<?php
    require("../../config.php");
	
	$nameData = $_POST['name'];
	$descData = $_POST['desc'];
	$quoteData = $_POST['quote'];
	$siteData = $_POST['site'];
	$logoData = $_POST['logo'];
	$SCLinkData = $_POST['SCLink'];
	$trackNumData = $_POST['trackNum'];
	$tierData = $_POST['tier'];
	$typeData = $_POST['type'];
	
	if (mkdir(dirname(__FILE__)."/../../../../../portfolio/".$nameData, 0755)) {
    	$stmt = $conn -> prepare("INSERT INTO portfolio (name, description, quote, site, logo, SCLink, tracknum, tier, type) VALUE(:name, :description, :quote, :site, :logo, :SCLink, :tracknum, :tier, :type)");
		$stmt -> bindParam(":name", $nameData);
		$stmt -> bindParam(":description", $descData);
		$stmt -> bindParam(":quote", $quoteData);
		$stmt -> bindParam(":site", $siteData);
		$stmt -> bindParam(":logo", $logoData);
		$stmt -> bindParam(":SCLink", $SCLinkData);
		$stmt -> bindParam(":tracknum", $trackNumData);
		$stmt -> bindParam(":tier", $tierData);
		$stmt -> bindParam(":type", $typeData);
		$stmt -> execute();
				
		$fileDirectoryData = dirname(__FILE__)."/../../../../../portfolio/".$nameData."/index.php";
		$fileContentData = "<?php require_once('../../includes/php/portfolioCase.php'); ?>";
		
		file_put_contents($fileDirectoryData,$fileContentData);
	}
?>