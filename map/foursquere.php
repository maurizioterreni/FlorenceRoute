<?php
session_start();
include "venue_by_id.php";

function Get_Location_By_Like(){

	if($_SESSION['Array_Location'] == ""){
		$label = 1;
		$lat = '43.773139094429';
		$lon = '11.255643367767';
		$clientID = 'GZSUQJKWQAQRBEWHJHVFPJEOL554SMSKXOGJNRRSAO1EBFXY';
		$clientSecret = 'HOF3ZSBZRK03YFVQYHKBNIHZGAEHAOA0KHHT5323VWODRRA5';
		$Array_Location = array(
				'Pranzo' => array(array('nome' => "",'sel'=> "",'txt' => "",'img' => "", 'lat' => "", 'lon' => "", 'phone' => "" , 'cat' => "", 'id' => "")),
				'Pomeriggio' => array(array('nome' => "",'sel'=> "",'txt' => "",'img' => "", 'lat' => "", 'lon' => "", 'phone' => "" , 'cat' => "", 'id' => "")),
				'Sera'	=> array(array('nome' => "",'sel'=> "",'txt' => "",'img' => "",'lat' => "", 'lon' => "", 'phone' => "" , 'cat' => "", 'id' => ""))
		);
		$url = "https://api.foursquare.com/v2/venues/explore?client_id=".$clientID."&client_secret=".$clientSecret."&v=".date("Ymd");
		

		
	/*	echo"<pre>";
		
		print_r($Ter_result);
		
		echo "</pre>";
		//print_r( $result['response']['groups'][0]['items'][0]['venue']);
*/
		//if((date("G") > "07" && date("G") < "14") && $_SESSION['Categorie']['Ristorante'] > 0)
		$_SESSION['PP'] = 0;
		$_SESSION['PO'] = 0;
		$_SESSION['PS'] = 0;
		if((date("G") > "07" && date("G") < "14") && $_SESSION['Categorie']['Ristorante'] > 0)
		//if((date("G") > "00" && date("G") < "24") && $_SESSION['Categorie']['Ristorante'] > 0)
		{
			$_SESSION['PP'] = 1;
			$url = "https://api.foursquare.com/v2/venues/explore?client_id=".$clientID."&client_secret=".$clientSecret."&v=".date("Ymd");
			$url = $url."&ll=".$lat.",".$lon."&query=Lunch&radius=1000";
			$json = file_get_contents($url);
			$result = json_decode($json, TRUE);
			for($i = 0; $i < 3; $i ++) {
				$Array_Location['Pranzo'][$i]['id'] = $result['response']['groups'][0]['items'][$i]['venue']['id'];
				$Array_Location['Pranzo'][$i]['sel'] = 0;
				$Array_Location['Pranzo'][$i]['label'] = $label;
				$Array_Location ['Pranzo'] [$i] ['nome'] = $result ['response'] ['groups'] [0] ['items'] [$i] ['venue'] ['name'];
				$Array_Location ['Pranzo'] [$i] ['phone'] = $result ['response'] ['groups'] [0] ['items'] [$i] ['venue'] ['contact'] ['formattedPhone'];
				$Array_Location ['Pranzo'] [$i] ['lon'] = $result ['response'] ['groups'] [0] ['items'] [$i] ['venue'] ['location'] ['lng'];
				$Array_Location ['Pranzo'] [$i] ['lat'] = $result ['response'] ['groups'] [0] ['items'] [$i] ['venue'] ['location'] ['lat'];
				$Array_Location ['Pranzo'] [$i] ['cat'] = $result ['response'] ['groups'] [0] ['items'] [$i] ['venue'] ['categories'] [0] ['name'];
				$Array_Location ['Pranzo'] [$i] ['txt'] = "Selected for lunch";
				$Array_Location ['Pranzo'] [$i] ['img'] = getVenue ( $Array_Location ['Pranzo'] [$i] ['id'] );
				$label++;
				
			}
		}
		
		if ((date("G") > "07" && date("G") < "18") && ($_SESSION['Categorie']['Shopping'] > 0 || $_SESSION['Categorie']['Ristorante'] > 0))
		//if ((date("G") > "00" && date("G") < "24") && ($_SESSION['Categorie']['Shopping'] > 0 || $_SESSION['Categorie']['Ristorante'] > 0))
		{
			$_SESSION['PO'] = 1;
			$Catt = array(
					'food' => $_SESSION['Categorie']['Ristorante'],
					'Shopping' => $_SESSION['Categorie']['Shopping'],
					'Giochi' => $_SESSION['Categorie']['Giochi'],
					'Tecnoligia' => $_SESSION['Categorie']['Tecnoligia'],
					'Film' => $_SESSION['Categorie']['Film'],
					'Musica' => $_SESSION['Categorie']['Musica'],
					'Sport' => $_SESSION['Categorie']['Sport']);
			arsort($Catt);
			$ArrayKey = array_keys($Catt);
			for($i=0;$i<3;$i++){
			
			
				//$CatT = array($_SESSION['Categorie']['Shopping'], $_SESSION['Categorie']['Giochi'], $_SESSION['Categorie']['Tecnoligia'], $_SESSION['Categorie']['Film'], $_SESSION['Categorie']['Musica'], $_SESSION['Categorie']['Sport']);
				//sort
				if($ArrayKey[$i] == "Film")
				{
					$url = "https://api.foursquare.com/v2/venues/explore?client_id=".$clientID."&client_secret=".$clientSecret."&v=".date("Ymd");
					$url = $url."&ll=".$lat.",".$lon."&query=Film&radius=1000";
					$json = file_get_contents($url);
					$Sec_result = json_decode($json, TRUE);
					$Array_Location['Pomeriggio'][$i]['txt'] = "Selected because you like Video";
				}
				else if($ArrayKey[$i] == "Shopping")
				{
					$url = "https://api.foursquare.com/v2/venues/explore?client_id=".$clientID."&client_secret=".$clientSecret."&v=".date("Ymd");
					$url = $url."&ll=".$lat.",".$lon."&query=Clothing Store&radius=1000";
					$json = file_get_contents($url);
					$Sec_result = json_decode($json, TRUE);
					$Array_Location['Pomeriggio'][$i]['txt'] = "Selected because you like Clothes";
				}
				else if($ArrayKey[$i] == "Sport")
				{
					$url = "https://api.foursquare.com/v2/venues/explore?client_id=".$clientID."&client_secret=".$clientSecret."&v=".date("Ymd");
					$url = $url."&ll=".$lat.",".$lon."&query=Sport&radius=1000";
					$json = file_get_contents($url);
					$Sec_result = json_decode($json, TRUE);
					$Array_Location['Pomeriggio'][$i]['txt'] = "Selected because you like Sport";
				}
				else if($ArrayKey[$i] == "Musica")
				{
					$url = "https://api.foursquare.com/v2/venues/explore?client_id=".$clientID."&client_secret=".$clientSecret."&v=".date("Ymd");
					$url = $url."&ll=".$lat.",".$lon."&query=Music&radius=1000";
					$json = file_get_contents($url);
					$Sec_result = json_decode($json, TRUE);
					$Array_Location['Pomeriggio'][$i]['txt'] = "Selected because you like Music";
				}
				else if($ArrayKey[$i] == "Giochi")
				{
					$url = "https://api.foursquare.com/v2/venues/explore?client_id=".$clientID."&client_secret=".$clientSecret."&v=".date("Ymd");
					$url = $url."&ll=".$lat.",".$lon."&query=Game&radius=1000";
					$json = file_get_contents($url);
					$Sec_result = json_decode($json, TRUE);
					$Array_Location['Pomeriggio'][$i]['txt'] = "Selected because you like Game";
				}
				else if($ArrayKey[$i] == "Tecnoligia")
				{
					$url = "https://api.foursquare.com/v2/venues/explore?client_id=".$clientID."&client_secret=".$clientSecret."&v=".date("Ymd");
					$url = $url."&ll=".$lat.",".$lon."&query=Computer&radius=1000";
					$json = file_get_contents($url);
					$Sec_result = json_decode($json, TRUE);
					$Array_Location['Pomeriggio'][$i]['txt'] = "Selected because you like Technology";
				}
				else if ($ArrayKey[$i] == "food"){
					$url = "https://api.foursquare.com/v2/venues/explore?client_id=".$clientID."&client_secret=".$clientSecret."&v=".date("Ymd");
					$url = $url."&ll=".$lat.",".$lon."&query=Ice Cream&radius=1000";
					$json = file_get_contents($url);
					$Sec_result = json_decode($json, TRUE);
					$Array_Location['Pomeriggio'][$i]['txt'] = "Selected because you like Food";
					
				}
			else {}

		

			$Array_Location['Pomeriggio'][$i]['id'] = $Sec_result['response']['groups'][0]['items'][0]['venue']['id'];
			$Array_Location['Pomeriggio'][$i]['sel'] = "0";
			$Array_Location['Pomeriggio'][$i]['label'] = $label;
			$Array_Location['Pomeriggio'][$i]['nome'] = $Sec_result['response']['groups'][0]['items'][0]['venue']['name'];
			$Array_Location['Pomeriggio'][$i]['phone'] = $Sec_result['response']['groups'][0]['items'][0]['venue']['contact']['formattedPhone'];
			$Array_Location['Pomeriggio'][$i]['lon'] = $Sec_result['response']['groups'][0]['items'][0]['venue']['location']['lng'];
			$Array_Location['Pomeriggio'][$i]['lat'] = $Sec_result['response']['groups'][0]['items'][0]['venue']['location']['lat'];
			$Array_Location['Pomeriggio'][$i]['cat'] = $Sec_result['response']['groups'][0]['items'][0]['venue']['categories'][0]['name'];
			$Array_Location['Pomeriggio'][$i]['img'] = getVenue($Array_Location['Pomeriggio'][$i]['id']);
			$label++;
			}
			//echo $nome . "  " . $lat . " " . $lon."<br>";
		}
		
		if((date("G") > "16" && date("G") < "25") && $_SESSION['Categorie']['Locali'] > 0)

		//if((date("G") > "00" && date("G") < "25") && $_SESSION['Categorie']['Locali'] > 0)
		{
			$_SESSION['PS'] = 1;
			$url = "https://api.foursquare.com/v2/venues/explore?client_id=".$clientID."&client_secret=".$clientSecret."&v=".date("Ymd");
			$url = $url."&ll=".$lat.",".$lon."&query=Pub&radius=1000";
			$json = file_get_contents($url);
			$Ter_result = json_decode($json, TRUE);
			
			for($i=0;$i<3;$i++)
			{
				$Array_Location['Sera'][$i]['id'] = $Ter_result['response']['groups'][0]['items'][$i]['venue']['id'];
				$Array_Location['Sera'][$i]['sel'] = "0";
				$Array_Location['Sera'][$i]['label'] = $label;
				
				$Array_Location['Sera'][$i]['nome'] = $Ter_result['response']['groups'][0]['items'][$i]['venue']['name'];
				$Array_Location['Sera'][$i]['phone']  = $Ter_result['response']['groups'][0]['items'][$i]['venue']['contact']['formattedPhone'];
				$Array_Location['Sera'][$i]['lon']  = $Ter_result['response']['groups'][0]['items'][$i]['venue']['location']['lng'];
				$Array_Location['Sera'][$i]['lat']  = $Ter_result['response']['groups'][0]['items'][$i]['venue']['location']['lat'];
				$Array_Location['Sera'][$i]['cat']  = $Ter_result['response']['groups'][0]['items'][$i]['venue']['categories'][0]['name'];
				$Array_Location['Sera'][$i]['img'] = getVenue($Array_Location['Sera'][$i]['id']);
				$Array_Location['Sera'][$i]['txt'] = "Selected because you like Night Life";
					$label++;
			}
			//echo $nome . "  " . $lat . " " . $lon."<br>";
		}
		

		

	$_SESSION['Array_Location'] = $Array_Location;
	}
/*
echo "<pre>";
print_r($_SESSION['Array_Location']);
echo "</pre>";
*/
}
//Get_Location_By_Like();
?>