/*
var map = L.map('map').setView([6.5244, 3.3792], 13); // Lagos default

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',{
    attribution:'© OpenStreetMap'
}).addTo(map);

var marker;

// Get user GPS location
navigator.geolocation.getCurrentPosition(function(position){
    var lat = position.coords.latitude;
    var lng = position.coords.longitude;

    map.setView([lat,lng],15);
    marker = L.marker([lat,lng]).addTo(map);

    document.getElementById("latitude").value = lat;
    document.getElementById("longitude").value = lng;
});

// Click to change location
map.on('click', function(e){
    if(marker){
        map.removeLayer(marker);
    }
    marker = L.marker(e.latlng).addTo(map);

    document.getElementById("latitude").value = e.latlng.lat;
    document.getElementById("longitude").value = e.latlng.lng;
});
*/

/* DEFAULT LOCATION (Lagos) */
var map = L.map('map').setView([6.5244, 3.3792], 13);

/* STREET MAP */
var streetMap = L.tileLayer(
 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
 { attribution: '© OpenStreetMap contributors' }
);

/* SATELLITE MAP */
var satelliteMap = L.tileLayer(
 'https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}',
 { attribution: 'Tiles © Esri' }
);

streetMap.addTo(map);

/* TOGGLE CONTROL */
L.control.layers({
 "Street Map": streetMap,
 "Satellite View": satelliteMap
}).addTo(map);

/* USER CLICK MARKER */
var marker;
map.on('click', function(e){
    if(marker){ map.removeLayer(marker); }
    marker = L.marker(e.latlng).addTo(map)
        .bindPopup("Incident Location Selected").openPopup();

    document.getElementById("latitude").value = e.latlng.lat;
    document.getElementById("longitude").value = e.latlng.lng;
});

/* ICONS */
var hospitalIcon = L.icon({
    iconUrl: "https://cdn-icons-png.flaticon.com/512/2967/2967350.png",
    iconSize: [32,32]
});

var policeIcon = L.icon({
    iconUrl: "https://cdn-icons-png.flaticon.com/512/2991/2991108.png",
    iconSize: [32,32]
});

var fireIcon = L.icon({
    iconUrl: "https://cdn-icons-png.flaticon.com/512/785/785116.png",
    iconSize: [32,32]
});

function loadEmergencyPlaces(lat, lng) {

    var query = `
    [out:json];
    (
      node["amenity"="hospital"](around:5000,${lat},${lng});
      node["amenity"="police"](around:5000,${lat},${lng});
      node["amenity"="fire_station"](around:5000,${lat},${lng});
    );
    out;
    `;

    fetch("https://overpass-api.de/api/interpreter?data=" + encodeURIComponent(query))
    .then(res => res.json())
    .then(data => {

        data.elements.forEach(place => {

            var iconType = hospitalIcon;
            var label = "Emergency";

            if(place.tags.amenity == "hospital"){
                iconType = hospitalIcon;
                label = "Hospital";
            }
            if(place.tags.amenity == "police"){
                iconType = policeIcon;
                label = "Police Station";
            }
            if(place.tags.amenity == "fire_station"){
                iconType = fireIcon;
                label = "Fire Station";
            }

            L.marker([place.lat, place.lon], {icon: iconType})
                .addTo(map)
                .bindPopup("<b>"+label+"</b><br>"+(place.tags.name || "Nearby"));
        });

    });
}

/* LOAD EMERGENCY PLACES USING MAP CENTER */
/* GET USER REAL LOCATION */
if (navigator.geolocation) {

    navigator.geolocation.getCurrentPosition(function(position){

        var userLat = position.coords.latitude;
        var userLng = position.coords.longitude;

        /* Move map to user */
        map.setView([userLat, userLng], 14);

        /* Add marker for user */
        L.marker([userLat, userLng])
            .addTo(map)
            .bindPopup("📍 You are here")
            .openPopup();

        /* Load emergency places around REAL location */
        loadEmergencyPlaces(userLat, userLng);

    }, function(){

        /* If user blocks GPS */
        alert("Location access denied. Using default location.");
        loadEmergencyPlaces(6.5244, 3.3792);

    });

} else {

    alert("Geolocation not supported by your browser.");
    loadEmergencyPlaces(6.5244, 3.3792);

}