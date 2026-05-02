
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
