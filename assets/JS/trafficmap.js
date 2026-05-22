
// ================= MAP =================

var map = L.map('trafficMap').setView([6.5244, 3.3792], 13);

// ================= STREET MAP =================

var streetLayer = L.tileLayer(
'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
{
    attribution:'© OpenStreetMap'
}
).addTo(map);

// ================= SATELLITE VIEW =================

var satelliteLayer = L.tileLayer(
'https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}',
{
    attribution:'Tiles © Esri'
}
);

// ================= REAL-TIME TRAFFIC =================

// API key bolock
const apiKey = "2o0TDIeWMU9xtjnCbjrPVVDeydMx3Nwl";

// Traffic flow layer
var trafficFlow = L.tileLayer(

`https://api.tomtom.com/traffic/map/4/tile/flow/relative/{z}/{x}/{y}.png?key=${apiKey}`,

{
    attribution:'TomTom Traffic',
    opacity:0.7
}

).addTo(map);

// ================= LAYER CONTROL =================

L.control.layers({

    "Street View": streetLayer,
    "Satellite View": satelliteLayer

},
{
    "Live Traffic": trafficFlow
}).addTo(map);

// ================= USER LOCATION =================

navigator.geolocation.getCurrentPosition(

    function(position){

        let lat = position.coords.latitude;
        let lng = position.coords.longitude;

        map.setView([lat,lng], 14);

        L.marker([lat,lng])
        .addTo(map)
        .bindPopup("You are here")
        .openPopup();

    },

    function(error){

        alert("Location access denied.");

    },

    {
        enableHighAccuracy:true,
        timeout:15000,
        maximumAge:0
    }

);

// ================= AUTO REFRESH =================

// refresh traffic every 2 minutes
setInterval(function(){

    trafficFlow.setUrl(

`https://api.tomtom.com/traffic/map/4/tile/flow/relative/{z}/{x}/{y}.png?key=${apiKey}&t=${new Date().getTime()}`

    );

    console.log("Traffic updated");

}, 120000);

// ===== CLICK MAP TO CHOOSE DESTINATION =====
map.on("click", function(e){
    setDestination(e.latlng.lat, e.latlng.lng);
});

// ===== SEARCH ADDRESS BUTTON =====
document.getElementById("searchRouteBtn").onclick = async () =>{
    let address = document.getElementById("destinationInput").value;
    if(!address) return alert("Enter destination");

    let geoUrl =
    `https://api.tomtom.com/search/2/geocode/${address}.json?key=${API_KEY}`;

    let res = await fetch(geoUrl);
    let data = await res.json();

    let dest = data.results[0].position;
    setDestination(dest.lat, dest.lon);
};

// ===== SET DESTINATION + GET ROUTE =====
function setDestination(lat,lng){

    if(destinationMarker) map.removeLayer(destinationMarker);

    destinationMarker = L.marker([lat,lng]).addTo(map)
        .bindPopup("Destination").openPopup();

    getRoute(lat,lng);
}

// ===== GET FASTEST ROUTE =====
async function getRoute(destLat, destLng){

    if(routeLayer) map.removeLayer(routeLayer);

    let routeUrl =
    `https://api.tomtom.com/routing/1/calculateRoute/
    ${userLat},${userLng}:${destLat},${destLng}/json
    ?key=${API_KEY}&traffic=true`;

    let res = await fetch(routeUrl);
    let data = await res.json();

    let points = data.routes[0].legs[0].points.map(p=>[p.latitude,p.longitude]);

    routeLayer = L.polyline(points,{color:"blue",weight:6}).addTo(map);

    map.fitBounds(routeLayer.getBounds());

    // ===== ETA INFO =====
    let summary = data.routes[0].summary;
    let timeMin = Math.round(summary.travelTimeInSeconds/60);
    let distKm = (summary.lengthInMeters/1000).toFixed(1);

    document.getElementById("routeInfo").innerHTML =
        `ETA: ${timeMin} mins | Distance: ${distKm} km`;
}
