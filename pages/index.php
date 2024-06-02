<head>
    <meta name="google" content="notranslate" />
    <meta http-equiv="Content-Language" content="en_US" />
    <title>Niki the cat</title>
</head>

<template>

    <Home.Main/>

</template>

<script lang="babel" defer="true">

var sections = document.querySelectorAll("section");
var lastSection = undefined;
var currentSection = undefined;

var animatedElems = [];

function checkSections() {

    for (var i = 0; i < sections.length; i++) {

        var section = sections[i];
        if (!isElementInViewport(section)) continue;
        currentSection = section;

        if (currentSection != lastSection) {

            for (var j = 0; j < animatedElems.length; j++) {
                var animatedElem = animatedElems[j];

                if (animatedElem.sectionId == section.id) animatedElem.elem.setAttribute("shown", "true");
                else animatedElem.elem.setAttribute("shown", "false");

            }

            var sectionChangeEvent = new CustomEvent("sectionChange", {
                detail: {
                    elem: section,
                    id: section.id
                }
            });
            document.dispatchEvent(sectionChangeEvent);
        }

        lastSection = currentSection;

    }

}

function addAnimatedElem(sectionId, elem) {
    animatedElems.push({
        sectionId: sectionId,
        elem: elem
    })
}

document.addEventListener("stoppedLoader", checkSections);
document.body.addEventListener("scroll", checkSections);

function isElementInViewport (el) {

    // Special bonus for those using jQuery
    if (typeof jQuery === "function" && el instanceof jQuery) {
        el = el[0];
    }

    var rect = el.getBoundingClientRect();

    return (
        rect.top >= 0 &&
        rect.left >= 0 &&
        rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) && /* or $(window).height() */
        rect.right <= (window.innerWidth || document.documentElement.clientWidth) /* or $(window).width() */
    );
}

</script>

<style>

html {
    overflow: hidden;
}

body {

    overflow-y: scroll;
    overflow-x: hidden;

    height: 100dvh;

    scroll-snap-type: y mandatory;
    -webkit-overflow-scrolling: touch; /* Required for iOS and Safari */

    scroll-snap-points-y: repeat(100vh);
    -ms-scroll-snap-points-y: repeat(100vh);

    position: absolute;

}

section {
    scroll-snap-align: center;
    width: 100svw !important;
    height: 100vh !important;
    max-height: 100vh !important;
}

</style>

<config>
{
    "head": [
        {
            "elemType": "meta",
            "name": "google",
            "content": "notranslate"
        },
        {
            "elemType": "title",
            "inner": "Niki the cat"
        }
        ]
}
</config>