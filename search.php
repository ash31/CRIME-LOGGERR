<?php 	$db = mysqli_connect('localhost', 'root', '', 'cl'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multi Marker Map </title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/ilmudetil.css">
    <script src='assets/js/jquery-1.10.1.min.js'></script>       
    <script src="assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCR5PFyvraK8Cqbu-vQu7UAR-NkcABHNuw"></script>
    <link rel="stylesheet" href="boot/css/bootstrap.min.css">
    
    <script>

    	var marker;
      function initialize() {
        var infoWindow = new google.maps.InfoWindow;
        
        var mapOptions = {
          mapTypeId: google.maps.MapTypeId.ROADMAP
        }

        var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
        var bounds = new google.maps.LatLngBounds();

        // Retrieve data from database
        <?php
            $query = mysqli_query($db,"select * from maps");
            while ($data = mysqli_fetch_array($query))
            {

            	 $nama = $data['cdesc'];
                $lat = $data['lat'];
                $lon = $data['lng'];
                
                echo ("addMarker($lat, $lon, '<b>$nama</b>');\n");                        
            }
          ?>


          function addMarker(lat, lng, info) {
            var lokasi = new google.maps.LatLng(lat, lng);
            bounds.extend(lokasi);
            var marker = new google.maps.Marker({
                map: map,
                position: lokasi
            });

            map.fitBounds(bounds);
            bindInfoWindow(marker, map, infoWindow, info);
         }
        
        // Displays information on markers that are clicked
        function bindInfoWindow(marker, map, infoWindow, html) {
          google.maps.event.addListener(marker, 'click', function() {
            infoWindow.setContent(html);
            infoWindow.open(map, marker);
             });
        }
 
        }
      google.maps.event.addDomListener(window, 'load', initialize);
    
    </script>

    </head>
<body onload="initialize()">

    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
        <ul class="navbar-nav mr-auto">
            <a class="navbar-brand" href="#">
    <img src="img/b3.jpg" alt="Logo" style="width:60px;">
            </a>

            <form class="form-inline" action="search.php">

    <input class="form-control mr-sm-2" input id="locationTextField" type="text" placeholder="Search for crime">
    <button class="btn btn-success" type="submit">Search</button>
  </form>
          
        </ul>
    </div>
    <div class="mx-auto order-0">
        <a class="navbar-brand mx-auto" href="#">CRIME LOGGER</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
   
</nav>
 
<div class="container" style="margin-top:10px"> 

    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading"><b>CRIME LOCATIONS</b></div>

                  <div class="panel-body">
                        <div id="map-canvas" style="width: 1000px; height: 1000px;"></div>
                    </div>
            </div>
        </div>  
    </div>
</div>  
</body>
</html>