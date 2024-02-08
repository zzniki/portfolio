var loaderElem = document.getElementById("pageloader");

function startLoader() {

    loaderElem.innerHTML = '<div class="cat"><div class="cat__body"></div><div class="cat__body"></div><div class="cat__tail"></div><div class="cat__head"></div></div>';

}
function stopLoader() {

    loaderElem.style.opacity = 0;
    loaderElem.style.visibility = "hidden";

}

function fadeOut(target) {

    loaderElem.style.visibility = "visible";
    loaderElem.style.opacity = 1;
    window.location.href = target;

}

function fadeUpdate() {

    requestAnimationFrame(fadeUpdate);

}

startLoader();
fadeUpdate();