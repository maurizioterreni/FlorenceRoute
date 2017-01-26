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

function stampa(){
	include "Create_Route.php";

		$Array_place = $_SESSION['Array_place'] ;
		$LastItem = array('Lat' => "", 'Lon' => "");
		$i=0;
		$pp = 0;
		$po = 0;
		$ps = 0;
		$jc = 0;
		for($i=0; $i<count($Array_place); $i++)
		{
			
			$url = "../" . $Array_place[$i]['img'] . "thumb.jpg";

			//echo "<li  data-theme=\"a\"><label data-theme=\"a\" data-corners=\"false\" >";
			
			/*
						<div class="img_bk" style="background-image: url("../img/smdf/thumb.jpg");"
		*/
			if($Array_place[$i]['isFour'] == 0)
			{
				echo "<li data-theme=\"a\"><a class=\"readonly-state-c\"><label  data-theme=\"a\" data-corners=\"false\" >";
				echo "<div>";
				echo "<div class=\"img_bk\" style=\"background-image: url('".$url."');\">";
					

				echo "<div class=\"marker_r\" style=\"background-image: url('http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=". $Array_place[$i]['label']."|FF0000|000000');\">";
				

				echo "</div></div>";
				
				echo "<h1  class=\"title\">" . $Array_place[$i]['nome'] . "</h1>";
				//echo "<div class=\"Text\">";
				echo "<p class=\"dist\">Distance from you: ";
				echo  substr(distance($_SESSION['lat'], $_SESSION['lon'], $Array_place[$i]['lat'], $Array_place[$i]['lon'], "K"),0,5)."Km (".substr(distance($_SESSION['lat'], $_SESSION['lon'], $Array_place[$i]['lat'], $Array_place[$i]['lon'], ""),0,5)."Mi)";
				$LastItem['Lat'] = $Array_place[$i]['lat'];
				$LastItem['Lon'] = $Array_place[$i]['lon'];
				
				echo "</p>";
					
				if($Array_place[$i]['isFour'] == 1)
					echo "<p class=\"dist\">". $Array_place[$i]['txt']."</p>";
				echo "</div>";
				echo "</a>";
				echo "<a href=\"../monument_page.php?id=".$Array_place[$i]['id']."&f=".$Array_place[$i]['isFour']."\" data-rel=\"dialog\" data-transition=\"pop\" style=\"background-color: #D6D6D6 !important;\"></a></label>  </li> ";
				$jc = 0;
			}
			else{
				if($jc == 0) 
				{
					$jc = 1;
					
					if($_SESSION['PP'] == 1 && $pp == 0)//Divisorio Pranzo
					{
						$pp++;
						echo "<span style=\"margin:2px; font-size: 18px; font-weight: bold;	text-align: center;\"><center>Suggested for lunch</center></span>";
					}
					else if($_SESSION['PO'] == 1 && $po == 0)//Divisorio Pomeriggio
					{
						$po++;
						
						echo "<span style=\"margin:2px; font-size: 18px; font-weight: bold;	text-align: center;\"><center>Suggested for free time</center></span>";
					}
					else if($_SESSION['PS'] == 1 && $ps == 0)//Divisorio Sera
					{
						$ps++;
						echo "<span style=\"margin:2px; font-size: 18px; font-weight: bold;	text-align: center;\"><center>Some ideas for the evening</center></span>";
					}
					else{
						
												
					}
					//$pp++;
					
					
				}
				
				
				
				
				
				
					

				if($Array_place[$i]['sel'] == 1)
				{
					echo "<li class=\"ui-li-has-alt\" data-theme=\"a\"><a class=\"cliccke ui-btn ui-btn-a ui-btn-active\"  data-itemid=\"".$Array_place[$i]['id']."\" ><label style=\"cursor:pointer;\" class=\"".$Array_place[$i]['id']."\" data-theme=\"a\" data-corners=\"false\" >";
					
					echo "<div class=\"img_bk\" style=\"background-image: url('".$Array_place[$i]['img']."');\">";
					echo "<div class=\"marker_r\" style=\"background-image: url('http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=". $Array_place[$i]['label']."|F4A460|000000');\">";
				}
				else
				{
					echo "<li  data-theme=\"a\"><a class=\"cliccke\"  data-itemid=\"".$Array_place[$i]['id']."\" ><label style=\"cursor:pointer;\" class=\"".$Array_place[$i]['id']."\" data-theme=\"a\" data-corners=\"false\" >";
					
					echo "<div class=\"img_bk\" style=\"-webkit-filter: grayscale(100%); -moz-filter: grayscale(100%);  -ms-filter: grayscale(100%);  -o-filter: grayscale(100%);  filter: grayscale(100%);  filter: url(grayscale.svg); /* Firefox 4+ */  filter: gray; /* IE 6-9 */; background-image: url('".$Array_place[$i]['img']."');\">";
					echo "<div class=\"marker_r\" style=\"background-image: url('http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=". $Array_place[$i]['label']."|A9A9A9|000000');\">";
				}

				echo "</div></div>";
				echo "<h1  class=\"title\">" . $Array_place[$i]['nome'] . "four</h1>";
				//echo "<div class=\"Text\">";
				echo "<p class=\"dist\">Distance from last POI: ";
				echo  substr(distance($LastItem['Lat'], $LastItem['Lon'], $Array_place[$i]['lat'], $Array_place[$i]['lon'], "K"),0,5)."Km (".substr(distance($LastItem['Lat'], $LastItem['Lon'], $Array_place[$i]['lat'], $Array_place[$i]['lon'], ""),0,5)."Mi)";
				//echo "<br> style=\"background-image: url(\"".$url."\");";
				//echo "</p>";

				echo "<br>".$Array_place[$i]['txt']."<br>";
				
				if($Array_place[$i]['sel'] == 1)
					echo "Selected";
				else
					echo "Click image for select";
				echo "</p>";
				
				echo "</a>";
				echo "<a href=\"../monument_page.php?id=".$Array_place[$i]['id']."&f=".$Array_place[$i]['isFour']."\" data-rel=\"dialog\" class=\"ui-btn ui-btn-icon-notext ui-icon-carat-r ui-btn-a\" data-transition=\"pop\"></a></label>  </li> ";

			}
			
				
		}
		




}
//stampa();
?>
