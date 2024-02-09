<template>

<div id="loader" class="loader">
    <svg data-src="/assets/images/logo.svg"></svg>
</div>

</template>

<script defer="true">

    const minLoadTime = 0; // millis

    var loaderStartTime = new Date();
    var loader = document.getElementById("loader");

    function stopLoader() {
        loader.classList.remove("loading");
        loader.classList.add("loaded");

        var stopLoaderEvent = new CustomEvent("stoppedLoader");
        document.dispatchEvent(stopLoaderEvent);

    }

    function startLoader() {
        loader.classList.remove("loaded");
        loader.classList.add("loading");
    }

    function loaderRedirect(url) {
        startLoader();

        setTimeout(() => {
            window.location.href = url;
        }, 250);

        return false;
    }

    document.addEventListener("hyphaEndLoad", (event) => {
        var diff = new Date() - loaderStartTime;

        if (diff > minLoadTime) stopLoader();
        else setTimeout(stopLoader, minLoadTime - diff);
    });
</script>

<style>

.loader {

    display: flex;
    justify-content: center;
    align-items: center;

    position: fixed;

    top: 0;
    left: 0;

    z-index: 100000;

    width: 100svw;
    height: 100svh;

    background-color: black;

    visibility: visible;

    transition: opacity 1s ease-in-out, visibility 1s ease-in-out, transform .25s ease-in-out;

}

.loader > svg {

    width: 100px;
    height: 100px;

    opacity: 1;

    --bezier: cubic-bezier(0.34, 1.56, 0.64, 1);

    transition: opacity .6s var(--bezier), transform .6s var(--bezier), width .6s var(--bezier), height .6s var(--bezier);

    animation: loader 2s var(--bezier) 2s infinite;

}

@keyframes startLoading {

    from { transform: translateY(25svh); opacity: 0; }
    to { transform: none; opacity: 1; }

}

@keyframes loader {

    from { transform: translateY(0); }
    10% { transform: translateY(-10px); }
    20% { transform: translateY(0px); }
    to { transform: translateY(0); }

}

.loader.loaded > svg {

    opacity: 1;

    animation: loaderLoaded 1s;
}

.loader.loaded {

    transform: scale(1, 0);

}

@keyframes loaderLoaded {

    from { transform: none; }
    to {
        opacity: 0;
        transform: scale(0.2) rotateZ(360deg);
    }

}


</style>