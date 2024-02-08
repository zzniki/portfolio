<template>

    <section id="aboutpage" class="aboutpage">

        <a class="console presentation"><span>i</span> am</a>
        <div class="description">
            <div class="d-first"><a class="console">a computer enthusiast</a></div>
            <div class="d-second">
                <a class="console">from spain</a>
                <div class="circle"></div>
            </div>
        </div>

        <div id="ab-title" class="title"><div class="circle"></div><a class="console">ABOUT</a></div>

    </section>

</template>

<script lang="babel" defer="true">

const ABOUT_SECTION_ID = "aboutpage";

addAnimatedElem(ABOUT_SECTION_ID, document.getElementById("ab-title"));
    
</script>

<style scoped="true">

.aboutpage {

    display: flex;
    flex-direction: column;

    position: relative;

}

.presentation {

    margin-top: 10vh;
    width: 100%;

    text-align: center;

    font-size: 64px;
}

.presentation > span {

    border-bottom: 4px solid var(--color-text);

}

.description {

    margin-top: 10vh;
    font-size: 32px;

}

.d-first::before {

    margin-left: 1.5em;

    content: ">";
    margin-right: .5em;
    font-family: var(--font-console);

}

.d-first > a {

    padding-inline: 2.5em;

    color: black;
    background-color: white;
    mix-blend-mode: difference;

}

.d-second {

    position: relative;

    display: flex;
    justify-content: center;
    width: 100%;

}

.d-second > a {

    padding-block: .5em;
    padding-inline: 4em;

    margin-top: -.75em;

    color: black;
    background-color: white;
    mix-blend-mode: difference;

}

.d-second > .circle {

    position: absolute;

    width: 100px;
    height: 100px;

    border-radius: 500px;

    background-color: white;
    mix-blend-mode: difference;

    transform: translate(225%, -75%);

}

.title {

    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: center;

    position: absolute;
    left: -.5rem;
    bottom: 1rem;

    font-size: 96px;

    transform-origin: 0 0;
    transform: translateX(-100%) translateY(100%) rotateZ(-90deg);

    transition: transform .5s ease-out;

}

.title[shown="true"] {

    transform: translateY(100%) rotateZ(-90deg);

}

.title > .circle {
    width: 82px;
    height: 82px;

    border-radius: 500px;
    background-color: white;

    margin-right: 1rem;

}

</style>