<?php
    if (isset($_POST['deleteFile'])) {
    	$imageDirectory = dirname(__FILE__).'/../../../../'.$_POST['directory'].$_POST['file'];
		unlink($imageDirectory);
	}	
?>