<?php
	session_start();
	include "Create_Route.php";
	//$posi = $_GET['id'];
	if(isset($_SESSION['Monument'])){
		$posi = $_SESSION['Monument'];
	}
?>
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title>Florence Route</title>
  
  <script type='text/javascript' src='http://code.jquery.com/jquery-1.8.3.js'></script>
  <!--
  <link rel="stylesheet" type="text/css" href="/css/normalize.css">
  
  
  <link rel="stylesheet" type="text/css" href="/css/result-light.css">
  
    -->
      <script type='text/javascript' src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
    
  
    
      <script type='text/javascript' src="http://jquery-ui-map.googlecode.com/svn/trunk/ui/jquery.ui.map.js"></script>
    
  
    
      <script type='text/javascript' src="http://jquery-ui-map.googlecode.com/svn/trunk/ui/jquery.ui.map.services.js"></script>
    
  
    
      <script type='text/javascript' src="http://jquery-ui-map.googlecode.com/svn/trunk/ui/jquery.ui.map.extensions.js"></script>
    
    
    
    <link rel="stylesheet" href="../style_monumenti.css">
    <script	src="../monument_gallery.js"></script>

  <link rel="stylesheet"
	href="stylelist.css">
  <style type='text/css'>
    #content {
    padding: 0;
    position : absolute !important; 
    top : 80px !important;  
    right : 0; 
    bottom : 0px !important;  
    left : 0 !important;     
}
.legenda{
	position: absolute;
	background-color: #636363;
	background-image: url('img/legend.jpg');
	height: 50px;
	width: 70px;
	bottom: 0px;
	left: 0px;
}
  </style>
  

<style type="text/css">
   .labels {
     color: red;
     background-color: white;
     font-family: "Lucida Grande", "Arial", sans-serif;
     font-size: 10px;
     font-weight: bold;
     text-align: center;
     width: 40px;     
     border: 2px solid black;
     white-space: nowrap;
   }
 </style>
<script type='text/javascript'>//<![CDATA[ 

var osmMapTypeOptions = {
		getTileUrl: function(coord, zoom) {
		    return "http://tile.openstreetmap.org/" +
		    zoom + "/" + coord.x + "/" + coord.y + ".png";
		},
		    tileSize: new google.maps.Size(256, 256),
		    isPng: true,
		    maxZoom: 19,
		    minZoom: 5,
		    name: "OSM"
		};
var directionsService = new google.maps.DirectionsService();
var directionsDisplay;
		var osmMapType = new google.maps.ImageMapType(osmMapTypeOptions); 
		var map;




		function calcRoute(coords) {


		<?php 
			
	//	Calculate_Route();
		
		?>
		var locations = [['Galleria degli Uffizi', 43.769985930354, 11.255310773849, 1],['Like', 43.770149064696, 11.258669927467, 2],['Cattedrale di Santa Maria del Fiore', 43.773139094429, 11.255643367767, 3],['Like', 43.772234610436, 11.255793571472, 4],['Piazzale Michelangelo', 43.762765, 11.264988, 5],['Like', 43.772234610436, 11.255793571472, 6]];	
		 
	        	var waypts = [];
	 // var checkboxArray = document.getElementById('waypoints');
	 if(locations.length > 1){
	   for (var i = 0; i < (locations.length-1); i++) {  
		        waypts.push({
			          location: new google.maps.LatLng(locations[i][1], locations[i][2]),

			          stopover:true});
	  
	   }
	   var end = new google.maps.LatLng(locations[locations.length-1][1], locations[locations.length-1][2]);
	 }
	 else var end = new google.maps.LatLng(locations[0][1], locations[0][2]);
	   var start = coords;
	   
	  
	  var request = {
		      origin: start,
		      destination: end,
		      waypoints: waypts,
		      optimizeWaypoints: false,
		      travelMode: google.maps.TravelMode.WALKING
		  };
		  directionsService.route(request, function(response, status) {
		    if (status == google.maps.DirectionsStatus.OK) {
		      directionsDisplay.setDirections(response);
		      var route = response.routes[0];
		      for (var i = 0; i < route.legs.length; i++) {
		    	  var routeSegment = i + 1;
		          console.log(route.legs[i].start_address + "-" + route.legs[i].end_address + "-" + route.legs[i].distance.text+"\n");
		          
		      }	
		    }
		  });
	  }
function success(position)
{
	directionsDisplay = new google.maps.DirectionsRenderer({
	    suppressMarkers: false
	});//new google.maps.DirectionsRenderer();
	var minZoomLevel = 16;
	var coords = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
	var mapOpts = {
		    zoom: minZoomLevel,
		    center: coords,
		    panControl: false,
		    scaleControl: true,
		    streetViewControl: false,
		    disableDefaultUI: true,
		    mapTypeControlOptions: {
		        mapTypeIds: ['OSM',google.maps.MapTypeId.ROADMAP],
		        style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
		    },
		    zoomControl: true,
		    zoomControlOptions: {
		        style: google.maps.ZoomControlStyle.SMALL
		    },                  
		};

		map = new google.maps.Map(document.getElementById("map_canvas"), mapOpts);
		map.mapTypes.set('OSM', osmMapType);
		map.setMapTypeId('OSM');
	    directionsDisplay.setMap(map);
		calcRoute(coords);

	
		
	
}



$(function(){
$(document).on('pageinit', '#index',function(e,data){    
   // This is the minimum zoom level that we'll allow
   
   if (navigator.geolocation) {
	   navigator.geolocation.getCurrentPosition(success);
	 } else {
	   error('Geo Location is not supported');
	 }
  

  /* // Bounds for North America
   var strictBounds = new google.maps.LatLngBounds(
     new google.maps.LatLng(28.70, -127.50), 
     new google.maps.LatLng(48.85, -55.90)
   );

   // Listen for the dragend event
   google.maps.event.addListener(map, 'dragend', function() {
     if (strictBounds.contains(map.getCenter())) return;

     // We're out of bounds - Move the map back within the bounds

     var c = map.getCenter(),
         x = c.lng(),
         y = c.lat(),
         maxX = strictBounds.getNorthEast().lng(),
         maxY = strictBounds.getNorthEast().lat(),
         minX = strictBounds.getSouthWest().lng(),
         minY = strictBounds.getSouthWest().lat();

     if (x < minX) x = minX;
     if (x > maxX) x = maxX;
     if (y < minY) y = minY;
     if (y > maxY) y = maxY;

     map.setCenter(new google.maps.LatLng(y, x));
   });

   // Limit the zoom level
   google.maps.event.addListener(map, 'zoom_changed', function() {
     if (map.getZoom() < minZoomLevel) map.setZoom(minZoomLevel);
   });  */
    
});
});//]]>  

</script>


</head>
<body>
  <!DOCTYPE html>
<html>
<head>
    <title>Florence Routes</title>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1"/>
   <link rel="stylesheet"
	href="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.css">
<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
<script	src="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.js"></script>   
</head>
<body>

  <div data-role="page" id="index">
        <div data-theme="a" data-role="header">
        <?php 
        
        if($_SESSION['Fb_nome']== "")
        {
        	echo "<a  style=\"width:17px; height: 17px;";
        	echo "background-image: url('http://magazine.pianetalecce.it/wp-content/uploads/2014/03/fb_icon_325x325-150x150.png');";
        	echo "background-size: 100% 100%;";
        	echo "background-repeat: no-repeat;";
        	
        	echo "\" rel=\"external\" data-inline=\"true\"  href=\"../index.php\"></a>";
        	
        }
        else 
        {
        	echo "<a  style=\"width:17px; height: 17px;";
        	echo "background-image: url('https://graph.facebook.com/".$_SESSION['ID']."/picture?width=50&height=50');";
        	echo "background-size: 100%;";
        	echo "background-repeat: no-repeat;";
        	echo "\" rel=\"external\" data-inline=\"true\" href=\"../facebook-php-sdk/src/logout.php\"></a>";
        	
        }
        ?>
        	<a href="../index.php" data-icon="back" rel="external">Home!</a>
            <h3>
            	Florence Routes
             
            </h3>
        </div>
 <div data-role="navbar">
      <ul>
        <li><a href="#" class="ui-btn-active ui-state-persist">Map</a></li>
        <li><a href="list_location.php" >List</a></li>
      </ul>
    </div>
        <div data-role="content" id="content">
            <div id="map_canvas" style="height:100%"></div>
            <div class="legenda"></div>
        </div>

        <div data-role="footer" data-position="fixed">
	</div><!-- /footer -->
    </div>

</body>
</html>    
  
</body>


</html>


