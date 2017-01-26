<?php

function getVenue($id)
{

	$clientID = 'GZSUQJKWQAQRBEWHJHVFPJEOL554SMSKXOGJNRRSAO1EBFXY';
	$clientSecret = 'HOF3ZSBZRK03YFVQYHKBNIHZGAEHAOA0KHHT5323VWODRRA5';

	$url = "https://api.foursquare.com/v2/venues/".$id."?client_id=".$clientID."&client_secret=".$clientSecret."&v=".date("Ymd");

	$json = file_get_contents($url);
	$result = json_decode($json, TRUE);
	
	
	/*$array = array();
	
	$array['nome'] = $result['response']['venue']['name'];
	$array['phone'] = $result['response']['venue']['contact']['formattedPhone'];
	$array['lat'] = $result['response']['venue']['location']['lat'];
	$array['lon'] = $result['response']['venue']['location']['lng'];
	$array['url'] = $result['response']['venue']['url'];
	$array['foto'] = $result['response']['venue']['photos']['groups'][0]['items'][0]['prefix']."300x300".$result['response']['venue']['photos']['groups'][0]['items'][0]['suffix'];
	
	return $array;
	*/
	return $result['response']['venue']['photos']['groups'][0]['items'][0]['prefix']."300x300".$result['response']['venue']['photos']['groups'][0]['items'][0]['suffix'];
	
/*
	echo "<pre>";
	print_r($result);
	echo "<pre>";
*/
}

//getVenue("4b2b84d0f964a52015b724e3");
?>