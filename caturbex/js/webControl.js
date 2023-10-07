const IMG_URL = "https://invarquit.cultura.gencat.cat/api/Card/$1/images/1";

var currentPlace = null;

function cGmapsRed() {
    window.open("http://www.google.com/maps/place/" + currentPlace.lat + "," + currentPlace.lng, "_blank")
}

function cArchRed() {
    window.open("https://invarquit.cultura.gencat.cat/card/" + currentPlace.id, "_blank");
}

function gmapsRed(lat, lng) {

    window.open("http://www.google.com/maps/place/" + lat + "," + lng, "_blank")

}

function archiveRed(id) {

    window.open("https://invarquit.cultura.gencat.cat/card/" + id, "_blank");

}

function hideWelcome() {
    
    var overlay = document.getElementById("overlay");

    overlay.style.opacity = 0;
    overlay.style.visibility = "hidden";

    var welcomeDiv = document.getElementById("div-welcome");
    
    welcomeDiv.style.opacity = 0;
    welcomeDiv.style.visibility = "hidden";

}

function viewPlace(id) {

    dbData.forEach((place) => {

        if (place.id == id) currentPlace = place;

    });

    var overlay = document.getElementById("overlay");

    overlay.style.opacity = 1;
    overlay.style.visibility = "visible";

    var welcomeDiv = document.getElementById("div-welcome");
    welcomeDiv.style.display = "none";

    var searchDiv = document.getElementById("div-search");
    searchDiv.style.display = "none";

    var placeDiv = document.getElementById("div-place");

    placeDiv.style.display = "flex";
    placeDiv.style.opacity = 1;
    placeDiv.style.visibility = "visible";

    var placeIdElem = document.getElementById("place-id");
    placeIdElem.innerHTML = currentPlace.name;

    var imgDiv = document.getElementById("div-img");

    imgDiv.innerHTML = '<i class="fa-solid fa-gear fa-spin"></i>';

    xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = () => {
        if (xhttp.readyState == 4 && xhttp.status == 200) {

            var rawData = xhttp.responseText;
            imgData = JSON.parse(rawData);

            if (imgData.length >= 1) {
                imgDiv.innerHTML = `<img class="img-place" onclick="openImage('` + imgData[0].path + `');" src="` + imgData[0].base64 + `">`;
            } else {
                imgDiv.innerHTML = '<i class="fa-solid fa-triangle-exclamation"></i>';
            }

        } else if (xhttp.readyState == 4 && xhttp.status != 200) {
            console.log(xhttp.status);

            imgDiv.innerHTML = '<i class="fa-solid fa-triangle-exclamation"></i>';
        }
    
    }

    xhttp.open("GET", IMG_URL.replace("$1", id), true);
    xhttp.send()

}

function closePlace() {

    var overlay = document.getElementById("overlay");

    overlay.style.opacity = 0;
    overlay.style.visibility = "hidden";

    var placeDiv = document.getElementById("div-place");

    placeDiv.style.opacity = 0;
    placeDiv.style.visibility = "hidden";

}

function openImage(path) {

    window.open(path, "_blank");

}

function openSearch() {

    var overlay = document.getElementById("overlay");

    overlay.style.opacity = 1;
    overlay.style.visibility = "visible";

    var welcomeDiv = document.getElementById("div-welcome");
    welcomeDiv.style.display = "none";

    var placeDiv = document.getElementById("div-place");
    placeDiv.style.display = "none";

    var searchDiv = document.getElementById("div-search");

    searchDiv.style.display = "flex";
    searchDiv.style.opacity = 1;
    searchDiv.style.visibility = "visible";

    var queryElem = document.getElementById("searchquery");
    queryElem.focus();

}

function closeSearch() {

    var overlay = document.getElementById("overlay");

    overlay.style.opacity = 0;
    overlay.style.visibility = "hidden";

    var searchDiv = document.getElementById("div-search");

    searchDiv.style.opacity = 0;
    searchDiv.style.visibility = "hidden";

}

function runSearch() {

    var queryElem = document.getElementById("searchquery");

    document.body.focus();

    var query = queryElem.value;

    clearMarkers();
    addMarkers(query.toLowerCase());
    closeSearch();

}