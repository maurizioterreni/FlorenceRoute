<?php 
session_start();
include "libs/ConDB.php";
$id=$_GET['id'];
$four = $_GET['f'];

function Find_Venue($id_f,$Array_place_f){
	$var = 0;
	for($i=0;$i<count($Array_place_f);$i++)
	{
		if($Array_place_f[$i]['id'] == $id_f)
		{
			$var = $i;
			break;
		}
	}
	//echo $var;
	return $var;
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

?>
<!DOCTYPE html>
<html>

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Florence Routes</title>
<link rel="stylesheet"
	href="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.css">
	<link rel="stylesheet" href="style_monumenti.css">
	
<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
<script	src="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.js"></script>



 <script type='text/javascript' src='http://code.jquery.com/jquery-1.8.3.js'></script>

 
  <script src="monument_gallery.js"></script>
   
</head>

<body>

	<div data-role="page">

		<div data-role="header">
			<h1>Monument</h1>
			</div>
		<!-- /header -->

		<div role="main" class="ui-contenat">
			<?php 
				if($four==0)
				{
					$result = mysqli_query($con,"SELECT * FROM Monument WHERE ID = '".$id."'");
					$row = mysqli_fetch_array($result);
			?>
			<div class="monument">

				<h3>
					<?=$row['Nome'];?>
				</h3>
				
				<div class="photo">
				<img class="immagine0" src="<?=$row['Url_Img'];?>thumb_1.jpg">
				<img class="immagine1" style="display:none;" src="<?=$row['Url_Img'];?>thumb_2.jpg">
				<img class="immagine2" style="display:none;" src="<?=$row['Url_Img'];?>thumb_3.jpg">
				</div>
				<div class="n_photo">
				<span class="n_photo0" style="text-decoration: underline; cursor:pointer; margin-right: 10px;">1</span>
				<span class="n_photo1" style="cursor:pointer; margin-right: 10px;">2</span>
				<span class="n_photo2" style="cursor:pointer; margin-right: 10px;">3</span>
				</div>
				<ul>
					<li>Phone: <?=$row['Tel'];?>
					</li>
					<li>Price: <?=$row['Prezzo'];?>
					</li>
					<li>Opening: <?=$row['Apertura'];?>
					</li>
					<li>Web-Site: <a href="<?=$row['Web_site'];?>" target="_blank">Open
							Official Web Site</a>
					</li>
					<li>Distance from you: <?=substr(distance($_SESSION['lat'], $_SESSION['lon'], $row['Lat'], $row['Lon'], "K"),0,5)?>Km
						(<?=substr(distance($_SESSION['lat'], $_SESSION['lon'], $row['Lat'], $row['Lon'], ""),0,5)?>Mi)
					</li>
					<li>
					<br>
					Description:

						
					</li>
					
				</ul>
<div class="text">
							<?=$row['Text'];?>
						</div>
						
					 <iframe id="external" src="map.php?lat=<?=$row['Lat'];?>&lon=<?=$row['Lon'];?>" width="90%" height="300px" style="background:#FFF; overflow:hidden;"></iframe>
	 <?php }
	 else 
	 {
	 	//include "venue_by_id.php";
	 	
	 	$Array_place = $_SESSION['Array_place'] ;
	 	$array = $Array_place[Find_Venue($id,$Array_place)];
	 	
	 	?>
	 	
	 	<div class="monument">

				<h3>
					<?=$array['nome'];?>
				</h3>
					<div class="photo">
				<img class="immagine0" src="<?=$array['img'];?>">
				</div>
				
				<ul>
					<li>Phone: <?=$array['phone'];?>
					</li>
					<li>Web-Site: <a href="<?=$array['url'];?>" target="_blank">Open
							Official Web Site</a>
					</li>
					<li>Distance from you: <?=substr(distance($_SESSION['lat'], $_SESSION['lon'], $array['lat'], $array['lon'], "K"),0,5)?>Km
						(<?=substr(distance($_SESSION['lat'], $_SESSION['lon'], $array['lat'], $array['lon'], ""),0,5)?>Mi)
					</li>
					<li>
					<br>
					Description: Selected by your likes on Facebook

						
					</li>
					
				</ul>
<div class="text">
							
						</div>
			
						
					 <iframe id="external" src="map.php?lat=<?=$array['lat'];?>&lon=<?=$array['lon'];?>" width="90%" height="300px" style="background:#FFF; overflow:hidden;"></iframe>
	 	
	 	
	 	<?php 
	 }
	 
	 ?>
</div>


<!--
			 <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script><div style="overflow:hidden;height:200px;width:200px;"><div id="gmap_canvas" style="height:200px;width:200px;"></div><style>#gmap_canvas img{max-width:none!important;background:none!important}</style><a class="google-map-code" href="http://www.mapsembed.com/voelkner-gutschein/" id="get-map-data">http://www.mapsembed.com/voelkner-gutschein/</a></div><script type="text/javascript"> function init_map(){var myOptions = {zoom:14,center:new google.maps.LatLng(<?=$row['Lat'];?>,<?=$row['Lon'];?>),mapTypeId: google.maps.MapTypeId.ROADMAP};map = new google.maps.Map(document.getElementById("gmap_canvas"), myOptions);marker = new google.maps.Marker({map: map,position: new google.maps.LatLng(<?=$row['Lat'];?>,<?=$row['Lon'];?>)});infowindow = new google.maps.InfoWindow({content:"<?=$row['Nome'];?>" });google.maps.event.addListener(marker, "click", function(){infowindow.open(map,marker);});infowindow.open(map,marker);}google.maps.event.addDomListener(window, 'load', init_map);</script>
        -->
        </div>
				


		</div>
		<!-- /content -->

		

	</div>
	<!-- /page -->
	
	
	
	
	
</body>
</html>
