<?php
session_start();
$lon = $_GET['lon'];
$lat = $_GET['lat'];

?>
<!DOCTYPE HTML>
<html>
<head>
<title>OpenLayers Simplest Example</title>

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
        #Map { 
            height: 300px;
       
        }    
    </style>

</head>
<body>
<div id="Map"></div>
<script src="http://openlayers.org/api/OpenLayers.js"></script>
<script>
    var lat            = <?=$_SESSION['lat'];?>;
    var lon            = <?=$_SESSION['lon'];?>;
    var Medlat         =  (lat + <?=$lat;?>)/2.0;
    var Medlon         =  (lon + <?=$lon;?>)/2.0;
    var zoom           = 15;
 
    var fromProjection = new OpenLayers.Projection("EPSG:4326");   // Transform from WGS 1984
    var toProjection   = new OpenLayers.Projection("EPSG:900913"); // to Spherical Mercator Projection
    var position       = new OpenLayers.LonLat(lon, lat).transform( fromProjection, toProjection);
    var position2      = new OpenLayers.LonLat(<?=$lon;?>, <?=$lat;?>).transform( fromProjection, toProjection);
    var posmed         = new OpenLayers.LonLat(Medlon, Medlat).transform( fromProjection, toProjection);
 
    map = new OpenLayers.Map("Map");
    var mapnik         = new OpenLayers.Layer.OSM();
    map.addLayer(mapnik);
 
    var markers = new OpenLayers.Layer.Markers( "You" );
    map.addLayer(markers);
    markers.addMarker(new OpenLayers.Marker(position));


    var markers2 = new OpenLayers.Layer.Markers( "Poi" );
    map.addLayer(markers2);
    markers2.addMarker(new OpenLayers.Marker(position2));
 
    map.setCenter(position2, zoom);
</script>
</body>
</html> 
