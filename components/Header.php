<template>

    <div id="header" class="header">
        <svg data-src="/assets/images/logo.svg"></svg>
        <div style="flex-grow: 1"></div>
        <div id="header-elems" class="header-elems">
            <div data-page="home"><a onclick="return loaderRedirect('/');" href="/">home</a><div></div></div>
            <div data-page="projects"><a onclick="return loaderRedirect('/projects');" href="/projects">projects</a><div></div></div>
            <div data-page="blog"><a onclick="return loaderRedirect('/blog');" href="/blog">blog</a><div></div></div>
            <div data-page="about"><a onclick="return loaderRedirect('/about');" href="/about">about</a><div></div></div>
        </div>
        <div id="menubut" class="menubut"><div></div><div class="second"></div></div>
    </div>

    <div id="menu" class="menuwrap">
        <div id="innermenu" class="menu">
            <div data-page="home"><a onclick="return loaderRedirect('/');" href="/">home</a><div></div></div>
            <div data-page="projects"><a onclick="return loaderRedirect('/projects');" href="/projects">projects</a><div></div></div>
            <div data-page="blog"><a onclick="return loaderRedirect('/blog');" href="/blog">blog</a><div></div></div>
            <div data-page="about"><a onclick="return loaderRedirect('/about');" href="/about">about</a><div></div></div>
        </div>
    </div>

</template>

<script lang="babel" defer="true">

var menuButton = document.getElementById("menubut");

var menuDiv = document.getElementById("menu");
var headerDiv = document.getElementById("header");

var menuElemsDiv = document.getElementById("innermenu")
var headerElemsDiv = document.getElementById("header-elems");

var shown = false;

function getCurrentPageName() {
    if (window.location.pathname.includes("blog")) return "blog";
    if (window.location.pathname.includes("about")) return "about";
    if (window.location.pathname.includes("projects")) return "projects";
    switch (window.location.pathname) {
        case "/": return "home";
    }
}

function updateHeader() {

    var currentPage = getCurrentPageName();

    for (let i = 0; i < headerElemsDiv.children.length; i++) {
        let child = headerElemsDiv.children[i];
        var pageAttrib = child.getAttribute("data-page");

        if (child.getAttribute("data-page") == currentPage) {
            if (!child.classList.contains("active")) child.classList.add("active");
        } else if (pageAttrib != null) {
            if (child.classList.contains("active")) child.classList.remove("active");
        }
    }

    for (let i = 0; i < menuElemsDiv.children.length; i++) {
        let child = menuElemsDiv.children[i];
        var pageAttrib = child.getAttribute("data-page");
        
        if (child.getAttribute("data-page") == currentPage) {
            if (!child.classList.contains("active")) child.classList.add("active");
        } else if (pageAttrib != null) {
            if (child.classList.contains("active")) child.classList.remove("active");
        }
    }

}

menuButton.addEventListener("click", (event) => {

    if (!shown) {
        shown = true;
        menuButton.classList.add("active");
        menuDiv.classList.add("active");
        menuDiv.firstElementChild.classList.add("active");
    } else {
        shown = false;
        menuButton.classList.remove("active");
        menuDiv.classList.remove("active");
        menuDiv.firstElementChild.classList.remove("active");
    }

});

menuDiv.addEventListener("click", (event) => {

    if (shown && !menuDiv.firstElementChild.matches(":hover")) {
        shown = false;
        menuButton.classList.remove("active");
        menuDiv.classList.remove("active");
        menuDiv.firstElementChild.classList.remove("active");
    }

});

document.addEventListener("stoppedLoader", (event) => {
    updateHeader();
});

</script>

<style>

.header {

    position: fixed;
    top: 0;
    left: 0;

    display: flex;
    flex-direction: row;
    align-items: center;

    gap: 1rem;

    height: 2rem;
    width: calc(100svw - 2rem);
    padding-top: 1rem;
    padding-inline: 1rem;

    font-size: 20px;

    user-select: none;

    z-index: 300;

}

.header > svg {
    width: 50px;
    height: 50px;
}

.header-elems {
    display: flex;
    flex-direction: row;

    gap: 1rem;

}

.header-elems > div {

    cursor: pointer;

    display: flex;
    flex-direction: column;
    align-items: center;

}

.header-elems > div > div {

    width: 0px;
    height: 2px;
    background-color: transparent;

    transition: width .25s ease-in-out;

}

.header-elems > div > a {
    text-decoration: none;
}

.header-elems > div.active > div {

    width: 100%;
    background-color: white;

}

.header-elems > div:hover > a {

    -webkit-text-stroke-width: 1px;
    -webkit-text-stroke-color: var(--color-text);
    color: transparent;

}

.menu {

    display: none;

}

@media only screen and (max-width: 768px) {

    .header {

        justify-content: space-between;
        z-index: 600;

    }

    .header > div:not(.menubut) {

        display: none;

    }

    .header > .menubut {

        display: flex;
        flex-direction: column;
        align-items: flex-end;
        justify-content: center;

        width: 50px;
        height: 50px;

    }

    .header > .menubut > div {

        width: 50px;
        height: 4px;
        background-color: white;

        transition: transform .25s ease-out, width .25s ease-out;

    }

    .header > .menubut > .second {
        margin-top: 10px;
        width: 25px;
    }

    .header > .menubut.active > div {

        width: 30px;
        transform: rotateZ(45deg) translate(5%, 240%);

    }

    .header > .menubut.active > .second {
        width: 30px;
        transform: rotateZ(-45deg) translateY(-300%);
    }

    .menuwrap {

        z-index: 549;

        position: fixed;
        top: 0;
        left: 0;

        width: 100svw;
        height: 100vh;

        /*background-color: rgba(0, 0, 0, .5);*/

        visibility: hidden;
        opacity: 0;

        transition: all .25s ease-in-out;

    }

    .menuwrap.active {
        opacity: 1;
        visibility: visible;

        transition: all .1s ease-in-out;

    }
    
    .menu {

        z-index: 550;

        display: flex;
        flex-direction: column;
        align-items: flex-start;
        justify-content: center;
        gap: 1em;

        position: fixed;
        top: 0;
        left: 30svw;

        font-size: 36px;

        width: 70svw;
        height: 100vh;

        background-color: var(--color-background);
        
        transform: translateX(75svw);

        transition: transform .25s ease-in-out;

    }

    .menu.active {

        transform: none;
        box-shadow: 0px 0px 30px rgba(255, 255, 255, .1);

    }

    .menu > div {
        cursor: pointer;

        display: flex;
        flex-direction: row;
        align-items: center;

        margin-left: 1em;
    }

    .menu > div > div {

        position: absolute;

        right: 0px;

        width: 0px;
        height: 50px;
        background-color: var(--color-text);

        mix-blend-mode: difference;

        transition: width .5s ease-in-out, right .75s ease-in-out;

    }

    .menu.active > div.active > div {

        width: 100%;
        right: 20%;

    }

}

</style>