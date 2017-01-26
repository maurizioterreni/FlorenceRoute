<?php
include "ConDB.php";
 
header("Content-type: text/xml");
echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>\n";
echo "<Monumenti>";
$result = mysqli_query($con,"SELECT * FROM Monument LIMIT 0 , 15");
while($row = mysqli_fetch_array($result))
{
	
	echo "<Monument>";
	echo "<ID>".$row['ID']."</ID>";
	//echo "<NAME>".$row['Nome']."</NAME>";
	//echo "<ID_FS>".$row['ID_Fs']."</ID_FS>";
	//echo "<LAT>".$row['Lat']."</LAT>";
	//echo "<LON>".$row['Lon']."</LON>";
	//echo "<TEXT>".$row['Text']."</TEXT>";
	//echo "<IMG>".$row['Url_Img']."</IMG>";
	//echo "<ORARIO>".$row['Apertura']."</ORARIO>";
	//echo "<PREZZO>".$row['Prezzo']."</PREZZO>";
	//echo "<WEB_SITE>".$row['Web_site']."</WEB_SITE>";
	//echo "<TEL>".$row['Tel']."</TEL>";
	echo "</Monument>";
}

echo "</Monumenti>";
?>
