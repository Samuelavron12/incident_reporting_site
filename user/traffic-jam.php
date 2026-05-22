<?php require_once("../includes/user-check.php"); ?>
<?php 
include("../includes/user-header.php"); 
?>
<?php
require_once("../includes/user-check.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Traffic Jam Monitor</title>

<link rel="stylesheet"
href="https://unpkg.com/leaflet/dist/leaflet.css"/>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<link rel="stylesheet"
href="../assets/CSS/traffic-jam.css">

</head>

<body>

<!-- HEADER -->

<div class="traffic-header">

    <h1>Real-Time Traffic Monitor</h1>

    <p>
        Live traffic congestion monitoring and heatmap visualization
    </p>

</div>

<!-- MAP -->

<div id="trafficMap"></div>

<!-- LEGEND -->

<div class="traffic-legend">

    <h3>Traffic Severity</h3>

    <div class="legend-item">
        <span class="green"></span>
        Free Traffic
    </div>

    <div class="legend-item">
        <span class="yellow"></span>
        Moderate Traffic
    </div>

    <div class="legend-item">
        <span class="red"></span>
        Severe Traffic
    </div>

</div>

<script src="../assets/JS/traffic-live.js"></script>
<div class="route-box">
            <h2>Smart Traffic Route Finder</h2>

            <input type="text" id="destinationInput" 
                placeholder="Enter destination address">

            <button id="searchRouteBtn">Find Fastest Route</button>

            <p class="hint">Tip: You can also click anywhere on the map to choose destination</p>

            <div id="routeInfo"></div>
        </div>


<!-- Leaflet -->

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script src="../assets/js/trafficmap.js"></script>

<?php include("../includes/footer.php"); ?>