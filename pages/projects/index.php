<head>
    <title>projects - niki</title>
</head>

<template>
    <div class="project-wrap">
        <a href="https://github.com/zzniki/portfolio" target="_blank" class="project">
            <img class="overlay" src="/assets/images/tv-overlay.gif" alt="">
            <img class="first" src="/assets/images/projects/nikicat.png" alt="">
            <img class="second" src="/assets/images/projects/nikicat.png" alt="">
        </a>
        <a href="https://github.com/zzniki/precerca" target="_blank" class="project">
            <img class="overlay" src="/assets/images/tv-overlay.gif" alt="">
            <img class="first" src="/assets/images/projects/hands.png" alt="">
            <img class="second" src="/assets/images/projects/hands.png" alt="">
        </a>
        <a href="https://wynnmarket.niki.cat" target="_blank" class="project">
            <img class="overlay" src="/assets/images/tv-overlay.gif" alt="">
            <img class="first" src="/assets/images/projects/wynnmarket.png" alt="">
            <img class="second" src="/assets/images/projects/wynnmarket.png" alt="">
        </a>
    </div>
</template>

<style scoped="true">

.project-wrap {
    
    width: 100%;
    height: 100dvh;
    
    display: flex;
    align-items: center;
    justify-content: space-evenly;
    flex-direction: row;
    
}

.project {
    position: relative;
    cursor: pointer;
    filter: grayscale(100%);
}

.project:hover {
    filter: none;
}

.project > img {
    max-height: 10rem;
}

.project > .overlay {
    position: absolute;
    width: 100%;
    height: 100%;
    mix-blend-mode: lighten;
}

.project > .second {
    --slice-0: inset(50% 0 50% 0%);
    --slice-1: inset(0 0 50% 0);
    --slice-2: inset(0 0 0 0);
    --slice-3: inset(50% 0 0 0);
    visibility: visible;
    position: absolute;
    display: block;
    transform: scale(1.25);
    -webkit-clip-path: var(--slice-0);
    clip-path: var(--slice-0);
    top: 0;
    animation: glitchback 0.1s reverse;
    animation-timing-function: step-end;
}

.project:hover > .first {
    visibility: hidden;
    transition: visibility .1s;
}

.project:hover > .second {
    --slice-2: inset(0% 0% 0 0);
    -webkit-clip-path: var(--slice-2);
    clip-path: var(--slice-2);
    animation: glitch 0.1s;
    animation-timing-function: step-end;
}

@keyframes glitch {
    0% {
    -webkit-clip-path: var(--slice-0);
    clip-path: var(--slice-0);
    }
    10% {
    -webkit-clip-path: var(--slice-1);
    clip-path: var(--slice-1);
    }
    to {
    -webkit-clip-path: var(--slice-2);
    clip-path: var(--slice-2);
    }
}
@keyframes glitchback {
    0% {
    -webkit-clip-path: var(--slice-0);
    clip-path: var(--slice-0);
    }
    10% {
    -webkit-clip-path: var(--slice-3);
    clip-path: var(--slice-3);
    }
    to {
    -webkit-clip-path: var(--slice-2);
    clip-path: var(--slice-2);
    }
}

@media only screen and (max-width: 768px) {

    .project-wrap {
        flex-direction: column;
    }

}

</style>