<?php

include 'libs/ConDB.php';


$result = mysqli_query($con,"SELECT * FROM POI_art");
$i = 0;
while($row = mysqli_fetch_array($result))
{
	$orario = $row['hours_open'] . ":00-" . $row['hours_close'].":00";
	$nome = $row['name'];
	$lat = $row['lat'];
	$lon = $row['lon'];
	$txt = $row['description'];
	
	echo "<br>" . $row['name'];
	$query[$i] = "INSERT INTO Monument (ID, Nome, ID_Fs, Lat, Lon, Text, Url_Img, Apertura, Prezzo, Web_site, Tel)
		VALUES ('', '$nome','','$lat','$lon','$txt','','$orario','','','')";
	$i++;
}

echo "<pre>";
print_r($query);
echo "</pre>";

for($k = 0; $k<count($query);$k++){
	$result = mysqli_query($con,$query[$k]);
	if(!$result) echo "<br>".$k." "."Error";
}

?>