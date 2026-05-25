<?php require_once("../includes/user-check.php"); ?>
<?php include("../includes/user-header.php"); ?>

<?php
$lat = $_GET['lat'];
$lng = $_GET['lng'];
?>

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Incident Location</title>

<!-- LEAFLET -->

<link rel="stylesheet"
href="https://unpkg.com/leaflet/dist/leaflet.css"/>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<style>

/* PAGE */

.map-page{
    padding-top:20px;
    padding-left:20px;
    padding-right:20px;
    padding-bottom:30px;
}

/* TITLE */

.map-title{
    font-size:30px;
    margin-bottom:20px;
    color:#0f172a;
}

/* MAP */

#map{
    width:100%;
    height:500px;
    border-radius:15px;
    overflow:hidden;
    box-shadow:0 5px 20px rgba(0,0,0,0.1);
}

/* MOBILE */

@media(max-width:768px){

    .map-page{
        padding-top:100px;
    }

    .map-title{
        font-size:24px;
    }

    #map{
        height:420px;
    }

}

</style>

</head>

<body>

<div class="map-page">

    <h2 class="map-title">
        Incident Location
    </h2>

    <div id="map"></div>

</div>

<script>

window.onload = function(){

    var lat = <?php echo $lat; ?>;
    var lng = <?php echo $lng; ?>;

    // CREATE MAP
    var map = L.map('map').setView([lat, lng], 15);

    // STREET MAP
    L.tileLayer(
    'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
    {
        attribution:'© OpenStreetMap'
    }).addTo(map);

    // MARKER
    L.marker([lat, lng])
    .addTo(map)
    .bindPopup("Incident Location")
    .openPopup();

    // IMPORTANT FIX FOR MOBILE
    setTimeout(function(){
        map.invalidateSize();
    }, 500);

}

</script>

</body>
</html>

<?php include("../includes/footer.php"); ?>