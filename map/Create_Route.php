<?php
session_start ();

// $posi = $_GET['id'];
function Calculate_Route() {
	$Array_place = $_SESSION ['Array_place'];
	$i = 0;
	$place = 1;
	$java_script = "var locations = [";
	for($i = 0; $i < count ( $Array_place ); $i ++) {
		if ($Array_place [$i] ['sel'] == 1) {
			if ($i == 0)
				$java_script = $java_script . "['" . $Array_place [$i] ['nome'] . "', " . $Array_place [$i] ['lat'] . ", " . $Array_place [$i] ['lon'] . ", " . ($i + $place) . "]";
			else
				$java_script = $java_script . ",['" . $Array_place [$i] ['nome'] . "', " . $Array_place [$i] ['lat'] . ", " . $Array_place [$i] ['lon'] . ", " . ($i + $place) . "]";
		}
	}
	
	$java_script = $java_script . "];";
	echo $java_script;
	
	/*
	 * echo"<br><br>"; print_r($Array_place);
	 */
}
function Marker($id, $title, $img, $pos, $color, $letter,$isfour) {
	echo "var contentString" . $id . " = '<div id=\"content\">";
	echo "<div id=\"siteNotice\">";
	echo "</div>";
	echo "<div id=\"bodyContent\">";
	
	// echo "<p>".$img."</p>";
	echo "<p>" . $title . "</p>";
	if ($isfour == 0)
		echo "<center><img src=\"../" . $img . "thumb.jpg\" style=\"height:50px; width:50px;\"></center>";
	else
		echo "<center><img src=\" $img \" style=\"height:50px; width:50px;\"></center>";
	echo "</div></div>';";
	
	echo "var infowindow" . $id . " = new google.maps.InfoWindow({";
	echo "content: contentString" . $id . "";
	echo "});";
	echo "var marker" . $id . " = new google.maps.Marker({";
	echo "position: new google.maps.LatLng(" . $pos . "),";
	echo "	map: map,";
	echo "icon: 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=" . $letter . "|" . $color . "|000000' ";
	echo "});";
	echo "google.maps.event.addListener(marker" . $id . ", 'click', function() {";
	echo "	infowindow" . $id . ".open(map,marker" . $id . ");";
	echo "});";
}
function CreateMarker() {
	include "../libs/ConDB.php";
	$i = 0;
	$place = 0;
	$Array_place = $_SESSION ['Array_place'];
	Marker ( 99, "You", "", $_SESSION ['lat'] . "," . $_SESSION ['lon'], "228B22", "A" );
	for($i = 0; $i < count ( $Array_place ); $i ++) {
		//if ($Array_place [$i] ['sel'] == 1) {
			if ($Array_place [$i] ['isFour'] == 0)
				Marker ( $i, $Array_place [$i] ['nome'], $Array_place [$i] ['img'], $Array_place [$i] ['lat'] . ", " . $Array_place [$i] ['lon'], "FF0000", $Array_place[$i]['label'] , $Array_place [$i] ['isFour']);
			else 
			{
				if ($Array_place [$i] ['sel'] == 1) {
					Marker ( $i, $Array_place [$i] ['nome'], $Array_place [$i] ['img'], $Array_place [$i] ['lat'] . ", " . $Array_place [$i] ['lon'], "F4A460", $Array_place[$i]['label'] ,$Array_place [$i] ['isFour']);
				}
				else{
					Marker ( $i, $Array_place [$i] ['nome'], $Array_place [$i] ['img'], $Array_place [$i] ['lat'] . ", " . $Array_place [$i] ['lon'], "A9A9A9", $Array_place[$i]['label'] ,$Array_place [$i] ['isFour']);
				}
			}
				//}
	}
	
	/*
	 * echo"<br><br>"; print_r($Array_place);
	 */
}
// Calculate_Route();
// CreateMarker();

// Calculate_Route();
?>