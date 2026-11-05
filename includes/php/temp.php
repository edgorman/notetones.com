<?php
   	$facebookData = json_decode(file_get_contents("http://graph.facebook.com/notetones"));
	echo $facebookData->likes;
	
	$url_sc = "http://api.soundcloud.com/users/{gormane}.json?client_id={53f61d894f9b726de69146c9a91c1cb8}";
	$sc_array = file_get_contents( $url_sc );
	$sccount = json_decode($sc_array, true);
	
	echo $sccount['followers_count'];
?>