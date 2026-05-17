// ===== TOMTOM API KEY =====
const API_KEY = "2o0TDIeWMU9xtjnCbjrPVVDeydMx3Nwl";

let map = L.map('trafficMap').setView([6.5244, 3.3792], 13);
let userLat, userLng;
let routeLayer;
let destinationMarker;

// Base map
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution:'© OpenStreetMap'
}).addTo(map);

// ===== REAL TRAFFIC LAYER =====
const trafficLayer = L.tileLayer(
`https://api.tomtom.com/traffic/map/4/tile/flow/relative/{z}/{x}/{y}.png?key=${API_KEY}`,
{ opacity:0.7 }
).addTo(map);

// Auto refresh traffic every 5 mins
setInterval(() => {
    trafficLayer.setUrl(
    `https://api.tomtom.com/traffic/map/4/tile/flow/relative/{z}/{x}/{y}.png?key=${API_KEY}&t=${Date.now()}`
    );
}, 300000);

// ===== GET USER LOCATION =====
navigator.geolocation.getCurrentPosition(pos=>{
    userLat = pos.coords.latitude;
    userLng = pos.coords.longitude;

    map.setView([userLat,userLng],15);
    L.marker([userLat,userLng]).addTo(map)
      .bindPopup("You are here").openPopup();
});

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

/* CREATE MAP 
let map = L.map('trafficMap').setView([6.5244, 3.3792], 13);

/* 🗺️ STREET MAP */
let street = L.tileLayer(
 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
 { attribution:'© OpenStreetMap contributors' }
);

/* 🛰️ SATELLITE MAP */
let satellite = L.tileLayer(
 'https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}',
 { attribution:'Tiles © Esri' }
);

/* 🌍 TERRAIN MAP */
let terrain = L.tileLayer(
 'https://{s}.tile.opentopomap.org/{z}/{x}/{y}.png',
 { attribution:'© OpenTopoMap contributors' }
);

/* Add default map */
street.addTo(map);

/* 🎛️ Map Layer Switcher */
let baseMaps = {
    "Street View": street,
    "Satellite View": satellite,
    "Terrain View": terrain
};

L.control.layers(baseMaps).addTo(map);