const DB_URL = "database.json";

var dbData = [];

var googleHybrid = L.tileLayer("http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}", {
    maxZoom: 20,
    subdomains:['mt0','mt1','mt2','mt3'],
    attribution: '© CatUrbex'
});

var googleSat = L.tileLayer("http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}", {
    maxZoom: 20,
    subdomains:['mt0','mt1','mt2','mt3'],
    attribution: '© CatUrbex'
});

var googleStreets = L.tileLayer("http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}", {
    maxZoom: 20,
    subdomains:['mt0','mt1','mt2','mt3'],
    attribution: '© CatUrbex'
});

const baseMaps = {

    "Híbrido": googleHybrid,
    "Satélite": googleSat,
    "Calles": googleStreets

}

var map = L.map("map", {

    layers: [googleHybrid]

}).setView([42.12732255, 1.7549529123787428], 9);

var layerControl = L.control.layers(baseMaps).addTo(map);

var greenIcon = new L.Icon({
    iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png',
    shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
    iconSize: [25, 41],
    iconAnchor: [12, 41],
    popupAnchor: [1, -34],
    shadowSize: [41, 41]
});

var redIcon = new L.Icon({
    iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
    shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
    iconSize: [25, 41],
    iconAnchor: [12, 41],
    popupAnchor: [1, -34],
    shadowSize: [41, 41]
});

var markers = L.markerClusterGroup();

console.log("Loading databse...")

var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = () => {
    if (xhttp.readyState == 4 && xhttp.status == 200) {

        var rawData = xhttp.responseText;
        dbData = JSON.parse(rawData);

        stopLoader();
        addMarkers(null);


    } else if (xhttp.readyState == 4 && xhttp.status != 200) {
        console.log(xhttp.status);
        stopLoader();
    }

}

xhttp.open("GET", DB_URL, true);
xhttp.send();

function addMarkers(filter) {

    dbData.forEach(place => {

        if (filter != null) {

            if (!place.name.toLowerCase().includes(filter.toLowerCase())) return;

        }
            
        if (place.accuracy != 0) {
            
            if (place.accuracy == 1) {
                var marker = L.marker([place.latitude, place.longitude]);
            } else if (place.accuracy == 2) {
                var marker = L.marker([place.latitude, place.longitude], {

                    icon: greenIcon

                });
            } else if (place.accuracy == 3) {
                var marker = L.marker([place.latitude, place.longitude], {

                    icon: redIcon

                });
            }

            var accuracy = null;
            
            if (place.accuracy == 1) accuracy = "Exacta";
            if (place.accuracy == 2) accuracy = "Ciudad";
            if (place.accuracy == 3) accuracy = "Comarca";

            marker.bindPopup(`<div class='popup'>
            <b>Nombre: </b>` + place.name + `<br>
            <b>Estado: </b>` + place.status + `<br>
            <b>Comarca: </b>` + place.province + `<br>
            <b>Ciudad: </b>` + place.city + `<br>
            <b>Dirección: </b>` + place.address + `<br>
            <b>Lat: </b>` + place.latitude + `<br>
            <b>Lng: </b>` + place.longitude + `<br>
            <b>Precisión: </b>` + accuracy + `<br>

            <div class="popup-squarebuts">
                <div class="popup-bsquare" onclick="gmapsRed(` + place.latitude + `,` + place.longitude + `);"><i class="fa-solid fa-map-location-dot"></i></div>
                <div class="popup-bsquare" onclick="archiveRed(` + place.id + `);"><i class="fa-solid fa-box-archive"></i></div>
            </div>

            <div class="popup-button"><div onclick="viewPlace(` + place.id + `);"><a>VER</a></div></div>
            </div>`);

            markers.addLayer(marker);

        }

    });

    map.addLayer(markers);

}

function clearMarkers() {

    map.removeLayer(markers);
    markers = L.markerClusterGroup();

}