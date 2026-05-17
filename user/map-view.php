<?php require_once("../includes/user-check.php"); ?>
<?php include("../includes/user-header.php"); ?>

<?php
$lat = $_GET['lat'];
$lng = $_GET['lng'];
?>

<h2>Incident Location</h2>
<div id="map" style="height:400px;"></div>
<script>
var lat = <?php echo $lat; ?>;
var lng = <?php echo $lng; ?>;

var map = L.map('map').setView([lat,lng],15);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',{
    attribution:'© OpenStreetMap'
}).addTo(map);

L.marker([lat,lng]).addTo(map);
</script>

<?php include("../includes/footer.php"); ?>