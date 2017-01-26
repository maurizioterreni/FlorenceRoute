<?php

session_start();
include "Create_Route.php";
?>


<!DOCTYPE html>
<html>
<head>
<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDY0kkJiTPVd2U7aTOAwhc9ySH6oHxOIYM&sensor=false">
</script>
<style>
html {
	height: 100%;
	overflow: hidden;
}

body {
	margin: 0;
	padding: 0;
	height: 100%;
}

#googleMap {
	height: 100%;
}

.legenda {
	position: absolute;
	background-color: #636363;
	background-image: url('img/legend.jpg');
	height: 50px;
	width: 70px;
	bottom: 0px;
	left: 0px;
}
</style>

<script>

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
		Calculate_Route();
		?>
		
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
		      optimizeWaypoints: true,
		      travelMode: google.maps.TravelMode.WALKING
		  };
		  directionsService.route(request, function(response, status) {
		    if (status == google.maps.DirectionsStatus.OK) {
		    	   directionsDisplay.setDirections(response);
		    	      var route = response.routes[0];
		    	      var summaryPanel = document.getElementById('directions_panel');
		    	     
		    	      // For each route, display summary information.
		    	      for (var i = 0; i < route.legs.length; i++) {
		    	        var routeSegment = i + 1;
		    	        console.log( route.legs[i].end_location);
		    	        //route.legs[i]
		    	      }
		    }
		  });
	  }

function initialize()
{

directionsDisplay = new google.maps.DirectionsRenderer({
	    suppressMarkers: true
	});//new google.maps.DirectionsRenderer();

var mapProp = {
  center:new google.maps.LatLng(<?=$_SESSION['lat'];?>,<?=$_SESSION['lon'];?>),
  zoom:15,
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
var map=new google.maps.Map(document.getElementById("googleMap")
  ,mapProp);
map.mapTypes.set('OSM', osmMapType);
map.setMapTypeId('OSM');

<?php 

CreateMarker();

?>

  directionsDisplay.setMap(map);
		calcRoute(new google.maps.LatLng(<?=$_SESSION['lat'];?>,<?=$_SESSION['lon'];?>));

}

google.maps.event.addDomListener(window, 'load', initialize);
</script>
</head>

<body>
<div id="googleMap"></div>
<div class="legenda"></div>
</body>
</html>