<?php
include "libs/ConDB.php";


session_start();
$posi = $_GET['id'];


function ADD(&$A1, $pos, $A2){
	for($i=count($A1); $i>=$pos;$i--)
	{
		$A1[$i] = $A1[$i-1];
	}
	$A1[$pos] = $A2;

}

function AddPlace($var,$i,$txt)
{
	    $Ar = array();
		$Ar['id'] = $_SESSION['Array_Location'][$var][$i]['id'];
		$Ar['isFour'] = 1;
		$Ar['phone'] = $_SESSION['Array_Location'][$var][$i]['phone'];
		$Ar['nome'] = str_replace("'","&rsquo;",$_SESSION['Array_Location'][$var][$i]['nome']);
		$Ar['lat'] = $_SESSION['Array_Location'][$var][$i]['lat'];
		$Ar['lon'] = $_SESSION['Array_Location'][$var][$i]['lon'];
		$Ar['img'] =  $_SESSION['Array_Location'][$var][$i]['img'];
		$Ar['txt'] =  $_SESSION['Array_Location'][$var][$i]['txt'];
		if($i == 0) $Ar['sel'] =  "1";
		else $Ar['sel'] =  "0";
		$Ar['label'] = $_SESSION['Array_Location'][$var][$i]['label'];
		$Ar['Dist'] = distance($_SESSION['lat'] , $_SESSION['lon'], $_SESSION['Array_Location'][$var][$i]['lat'], $_SESSION['Array_Location'][$var][$i]['lon'], "K");
	//	$Ar['Txt'] = ""
		return $Ar;
}

function my_sort(&$Array_place)
{
	$arr = $Array_place[0];
	$key = 0;
	for($i = 0; $i<count($Array_place); $i++)
	{
		$key = $i;
		for($k = $i; $k<count($Array_place); $k++)
		{
			if($Array_place[$k]['Dist'] < $Array_place[$key]['Dist']) $key = $k;
		}
		$arr = $Array_place[$i];
		$Array_place[$i] = $Array_place[$key];
		$Array_place[$key] = $arr;
	}
	return $Array_place;
}

function distance($lat1, $lon1, $lat2, $lon2, $unit) {

	$theta = $lon1 - $lon2;
	$dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
	$dist = acos($dist);
	$dist = rad2deg($dist);
	$miles = $dist * 60 * 1.1515;
	$unit = strtoupper($unit);

	if ($unit == "K") {
		return ($miles * 1.609344);
	} else if ($unit == "N") {
		return ($miles * 0.8684);
	} else {
		return $miles;
	}
}

$result = mysqli_query($con,"SELECT * FROM Monument LIMIT 0 , 500");
$i = 0;
$k = 0;
$Array_place = array();
while($row = mysqli_fetch_array($result))
{
	if($posi[$i] == 1){
		$Array_place[$k]['id'] = $row['ID'];
		$Array_place[$k]['isFour'] = 0;
		$Array_place[$k]['label'] = chr($i+66);
		
		$Array_place[$k]['phone'] = "";
		$Array_place[$k]['nome'] = $row['Nome'];
		$Array_place[$k]['lat'] = $row['Lat'];
		$Array_place[$k]['lon'] = $row['Lon'];
		$Array_place[$k]['img'] = $row['Url_Img'];
		$Array_place[$k]['txt'] = "";
		$Array_place[$k]['sel'] = "1";
		$Array_place[$k]['Dist'] = distance($_SESSION['lat'] , $_SESSION['lon'], $row['Lat'], $row['Lon'], "K");
		$k++;
	}
	$i++;
}
//my_sort($Array_place);
if($_SESSION['Fb_nome'] == "")
{
	$_SESSION['Array_place'] = $Array_place;
	
	//TO-DO
}
else
{
	include "map/foursquere.php";
	if($_SESSION['Array_Location']['Pranzo'][0]['nome'] != ""){
		for($i=0;$i<count($_SESSION['Array_Location']['Pranzo']);$i++)
			ADD($Array_place, 1+$i, AddPlace("Pranzo",$i));
	}
	if($_SESSION['Array_Location']['Pomeriggio'][0]['nome'] != "") 
	{
		for($i=0;$i<count($_SESSION['Array_Location']['Pomeriggio']);$i++)
			ADD($Array_place, count($_SESSION['Array_Location']['Pranzo'])+2+$i, AddPlace("Pomeriggio",$i));
	
	}
	
	if($_SESSION['Array_Location']['Sera'][0]['nome'] != "") 
	{
		
		for($i=0;$i<count($_SESSION['Array_Location']['Sera']);$i++)
		
			ADD($Array_place, count($Array_place), AddPlace("Sera",$i));
	}
	
	/*
	if($_SESSION['Array_Location']['Pranzo']['nome'] != "")
	if($_SESSION['Array_Location']['Pomeriggio']['nome'] != "")
	if($_SESSION['Array_Location']['Pomeriggio']['nome'] != "")
	
	*/
	
	$_SESSION['Array_place'] = $Array_place;
	
	//TO-DO
}
/*
echo "<pre>";
print_r($Array_place);
echo "</pre>";*/

header("Location: map/Mappa.php");
?>