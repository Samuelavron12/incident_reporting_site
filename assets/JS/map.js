/***********************************
 CREATE MAP (default Nigeria center)
************************************/
var map = L.map('map').setView([9.0820, 8.6753], 6);

/***********************************
 MAP LAYERS
************************************/
var streetMap = L.tileLayer(
 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
 { attribution: '© OpenStreetMap contributors' }
).addTo(map);

var satelliteMap = L.tileLayer(
 'https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}',
 { attribution: 'Tiles © Esri' }
);

L.control.layers({
 "Street Map": streetMap,
 "Satellite View": satelliteMap
}).addTo(map);


/***********************************
 CLICK TO SELECT INCIDENT LOCATION
************************************/
var incidentMarker;

map.on('click', function(e){
    if(incidentMarker){ map.removeLayer(incidentMarker); }

    incidentMarker = L.marker(e.latlng)
        .addTo(map)
        .bindPopup("Incident Location Selected")
        .openPopup();

    document.getElementById("latitude").value = e.latlng.lat;
    document.getElementById("longitude").value = e.latlng.lng;
});


/***********************************
 EMERGENCY ICONS
************************************/
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


/***********************************
 LOAD NEARBY EMERGENCY SERVICES
************************************/
function loadEmergencyPlaces(lat, lng) {

    console.log("Loading emergency services near:", lat, lng);

    var query = `
    [out:json][timeout:25];
    (
      node["amenity"="hospital"](around:5000,${lat},${lng});
      node["amenity"="police"](around:5000,${lat},${lng});
      node["amenity"="fire_station"](around:5000,${lat},${lng});
    );
    out body;
    `;

    fetch("https://overpass-api.de/api/interpreter?data=" + encodeURIComponent(query))
    .then(res => res.json())
    .then(data => {

        if(data.elements.length === 0){
            console.log("No emergency places found nearby");
            return;
        }

        data.elements.forEach(place => {

            var iconType = hospitalIcon;
            var label = "Emergency Service";

            if(place.tags.amenity === "hospital"){
                iconType = hospitalIcon;
                label = "Hospital";
            }
            if(place.tags.amenity === "police"){
                iconType = policeIcon;
                label = "Police Station";
            }
            if(place.tags.amenity === "fire_station"){
                iconType = fireIcon;
                label = "Fire Station";
            }

            L.marker([place.lat, place.lon], {icon: iconType})
                .addTo(map)
                .bindPopup("<b>"+label+"</b><br>"+(place.tags.name || "Nearby"));
        });

    })
    .catch(err => console.log("Overpass error:", err));
}


/***********************************
 GET REAL USER GPS LOCATION
************************************/
if (navigator.geolocation) {

    navigator.geolocation.getCurrentPosition(
        function(position) {

            var lat = position.coords.latitude;
            var lng = position.coords.longitude;
            var accuracy = position.coords.accuracy;

            console.log("GPS accuracy:", accuracy, "meters");

            var userLocation = [lat, lng];

            map.setView(userLocation, 16);

            L.marker(userLocation)
              .addTo(map)
              .bindPopup("📍 You are here")
              .openPopup();

            document.getElementById("latitude").value = lat;
            document.getElementById("longitude").value = lng;

            // ⭐ VERY IMPORTANT: LOAD EMERGENCY SERVICES HERE
            loadEmergencyPlaces(lat, lng);

        },
        function(error) {
            alert("Please enable location services.");
            console.log(error);
        },
        {
            enableHighAccuracy: true,
            timeout: 20000,
            maximumAge: 0
        }
    );

} else {
    alert("Geolocation not supported.");
}