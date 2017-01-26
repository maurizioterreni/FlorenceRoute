<?php

session_start();
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

$id =  $_POST['id'];
$k = 0;
$Array_place = $_SESSION['Array_place'];
while(($k<count($Array_place)) && ($Array_place[$k]['id'] != $id))
{
	$k++;
}

if($Array_place[$k]['sel'] == 0)
	$_SESSION['Array_place'][$k]['sel'] = 1;
else
	$_SESSION['Array_place'][$k]['sel'] = 0;




$Array = $_SESSION['Array_place'][$k];

				
					

				if($Array['sel'] == 1)
				{
					echo "<label style=\"cursor:pointer;\" class=\"".$Array['id']."\" data-theme=\"a\" data-corners=\"false\" >";
					
					echo "<div class=\"img_bk\" style=\"background-image: url('".$Array['img']."');\">";
					echo "<div class=\"marker_r\" style=\"background-image: url('http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=". $Array['label']."|F4A460|000000');\">";
				}
				else
				{
					echo "<label style=\"cursor:pointer;\" class=\"".$Array['id']."\" data-theme=\"a\" data-corners=\"false\" >";
					
					echo "<div class=\"img_bk\" style=\"-webkit-filter: grayscale(100%); -moz-filter: grayscale(100%);  -ms-filter: grayscale(100%);  -o-filter: grayscale(100%);  filter: grayscale(100%);  filter: url(grayscale.svg); /* Firefox 4+ */  filter: gray; /* IE 6-9 */; background-image: url('".$Array['img']."');\">";
					echo "<div class=\"marker_r\" style=\"background-image: url('http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=". $Array['label']."|A9A9A9|000000');\">";
				}

				echo "</div></div>";
				echo "<h1 class=\"title\">" . $Array['nome'] . "four</h1>";
				//echo "<div class=\"Text\">";
				echo "<p class=\"dist\">Distance from you: ";
				echo  substr(distance($_SESSION['lat'], $_SESSION['lon'], $Array['lat'], $Array['lon'], "K"),0,5)."Km(".substr(distance($_SESSION['lat'], $_SESSION['lon'], $Array['lat'], $Array['lon'], ""),0,5)."Mi)";
				//echo "<br> style=\"background-image: url(\"".$url."\");";
				//echo "</p>";

				echo "<br>".$Array['txt']."<br>";
				
				if($Array['sel'] == 1)
					echo "Selected";
				else
					echo "Click image for select";
				echo "</p>";
?>