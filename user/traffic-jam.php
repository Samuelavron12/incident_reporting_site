<?php require_once("../includes/user-check.php"); ?>
<?php 
include("../includes/user-header.php"); 
?>

<div class="content">
    <h1>Live Traffic Jam Monitor</h1>
    <p>Your current area traffic condition</p>

    <div id="trafficMap"> </div>
</div>
<div class="route-box">
            <h2>Smart Traffic Route Finder</h2>

            <input type="text" id="destinationInput" 
                placeholder="Enter destination address">

            <button id="searchRouteBtn">Find Fastest Route</button>

            <p class="hint">Tip: You can also click anywhere on the map to choose destination</p>

            <div id="routeInfo"></div>
        </div>


<!-- Leaflet -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script src="../assets/js/trafficmap.js"></script>

<?php include("../includes/footer.php"); ?>