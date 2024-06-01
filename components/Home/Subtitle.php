<template>

    <div id="subtitle" class="subtitle">
        <a class="console first">a</a>
        <a id="subtitle-text" class="console">w</a>
    </div>

</template>

<script lang="babel" defer="true">

const typeSpeed = 100; // millis
const typeChangeTime = 5000; // millis
const typeTexts = ["web developer", "programmer", "musician", "cat"];

var typeElem = document.getElementById("subtitle-text");

var typeAnimInterval = 0;
var typeLoopInterval = 0;

var typeCurrentText = ""
var typePool = [];
var textIndex = 0;

typeElem.style.height = typeElem.getBoundingClientRect().height + "px";
typeElem.innerHTML = "";

function startTypeAnim(text) {

    typePool = [];

    for (let i = typeCurrentText.length - 1; i >= 0; i--) {
        if (typeCurrentText[i] != " ")
            typePool.push("del");
        else
            typePool.push("delspace");
    }

    typeCurrentText = text;

    for (let i = 0; i < typeCurrentText.length; i++) {
        typePool.push(typeCurrentText[i].replaceAll(" ", "&nbsp;"));
    }

    if (typeAnimInterval != 0) clearInterval(typeAnimInterval);
    typeAnimInterval = setInterval(typeAnimLoop, typeSpeed);

}

function typeAnimLoop() {

    if (typePool.length <= 0) return;

    var cur = typePool.shift();

    if (typeElem.innerHTML == "&nbsp;") typeElem.innerHTML = "";

    if (cur == "del")
        typeElem.innerHTML = typeElem.innerHTML.slice(0, -1);
    else if (cur == "delspace")
        typeElem.innerHTML = typeElem.innerHTML.replaceAll(/&nbsp;/g,' ').trim().replaceAll(" ", "&nbsp;");
    else
        typeElem.innerHTML += cur;

}

function typeLoop() {

    // Get random text from typetexts
    textIndex++;
    if (textIndex > typeTexts.length - 1) textIndex = 0;
    startTypeAnim(typeTexts[textIndex]);

}

document.addEventListener("stoppedLoader", (event) => {

    setTimeout(() => {
        let subtitleElem = document.getElementById("subtitle");
        subtitleElem.classList.add(hypha.getScopedClass(subtitleElem, "loaded"));
        
        typeLoopInterval = setInterval(typeLoop, typeChangeTime);
        startTypeAnim(typeTexts[textIndex]);
    }, 1500);

});

</script>

<style scoped="true">

.subtitle {

    position: absolute;
    left: 2rem;
    bottom: 2rem;

    display: flex;
    flex-direction: row;

    font-size: 32px;
    user-select: none;

    opacity: 0;

}

.subtitle.loaded {
    opacity: 1;
}

.subtitle > .first::after {
    content: " ";
    white-space: pre;
}

.subtitle > #subtitle-text {

    border-right: 3px solid transparent;
    padding-right: 5px;

    animation: blink-caret .75s step-end infinite;

}

@keyframes blink-caret {
    from, to { border-color: transparent; }
    50% { border-color: white; }
}

@media only screen and (max-width: 768px) {

    .subtitle {
        left: 1rem;
        bottom: 1rem;
        font-size: 24px;
    }

}

</style>