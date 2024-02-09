<template>

    <div id="bg-cursorfollow" class="cursorfollow hidden"><div></div></div>
    <div class="noise"></div>

</template>

<script lang="babel" defer="true">

const speed = .1;

var followElem = document.getElementById("bg-cursorfollow");
var scopedClassName = hypha.getScopedClass(followElem, "focused");

var focused = false;

var halfWidth = parseInt(followElem.getBoundingClientRect().width / 2);
var targetX = 10000;
var targetY = 10000;

var cX = targetX;
var cY = targetY;

var firstMove = true;

function mouseAnim() {

    var distX = targetX - cX;
    var distY = targetY - cY;

    var totalDist = Math.sqrt(Math.pow(distX, 2) + Math.pow(distY, 2));

    cX += distX * speed;
    cY += distY * speed;

    followElem.style.left = parseInt(cX) + "px";
    followElem.style.top = parseInt(cY) + "px";

    if (focused) followElem.firstElementChild.style.transform = "scale(3)";
    else followElem.firstElementChild.style.transform = "scale(" + Math.max(totalDist / 100, 1) + ")";

    requestAnimationFrame(mouseAnim);

}

mouseAnim();

document.addEventListener("mousemove", (event) => {
    

    targetX = event.pageX - halfWidth;
    targetY = event.pageY - halfWidth;

    if (firstMove) {
        firstMove = false;
        cX = targetX;
        cY = targetY;
        followElem.classList.remove(hypha.getScopedClass(followElem, "hidden"));
    }

    if (getComputedStyle(event.target).cursor == "pointer") {
        if (!focused) {
            focused = true;
        }
    } else {
        if (focused) {
            focused = false;
        }
    }

});

</script>

<style scoped="true">

.noise {

    position: fixed;
    top: 0;
    left: 0;
    
    width: 120vw;
    height: 120vh;

    background: url("/assets/images/noise.png");
    opacity: .5;

    pointer-events: none;
    /*z-index: -100;*/
    transform: translateZ(0);

    animation: noise .09s infinite;

    z-index: 120;

}

@keyframes noise {

    0%, 100% { background-position: 0 0; }
    10% { background-position: -5% -10%; }
    20% { background-position: -15% 5%; }
    30% { background-position: 7% -25%; }
    40% { background-position: 20% 25%; }
    50% { background-position: -25% 10%; }
    60% { background-position: 15% 5%; }
    70% { background-position: 0 15%; }
    80% { background-position: 25% 35%; }
    90% { background-position: -10% 10%; }

}

.cursorfollow {

    position: fixed;
    display: flex;

    left: -1000px;
    top: -10000px;

    justify-content: center;
    align-items: center;

    width: 500px;
    height: 500px;

    z-index: 1000;    

    pointer-events: none;
    mix-blend-mode: difference;

    background: radial-gradient(50% 50% at 50% 50%, rgba(255, 255, 255, 0.1) 0%, rgba(0, 0, 0, 0.00) 80%);

}

.cursorfollow.hidden > div {
    transform: scale(0) !important;
}

.cursorfollow > div {

    width: 25px;
    height: 25px;

    transition: width .15s ease-out, height .15s ease-out, transform .16s ease-out;

    background-color: white;
    border-radius: 10000px;
    
}

.cursorfollow.focused > div {

    width: 100px;
    height: 100px;

}

</style>