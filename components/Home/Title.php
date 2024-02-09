<template>

    <div class="titlewrap">
        <div id="title" class="title">
            <!--<img src="/assets/images/cat-laying.png">-->
            <div><a>n</a><a>n</a></div>
            <div><a>i</a><a>i</a></div>
            <div><a>k</a><a>k</a></div>
            <div><a>i</a><a>i</a></div>
        </div>
        <div id="title-animdiv" class="title-animdiv">
            <a>k</a>
        </div>
    </div>

</template>

<script lang="babel" defer="true">

document.addEventListener("stoppedLoader", (event) => {

    let animDiv = document.getElementById("title-animdiv");
    animDiv.classList.add(hypha.getScopedClass(animDiv, "loaded"));

    let title = document.getElementById("title");
    title.classList.add(hypha.getScopedClass(title, "loaded"));

});

</script>

<style scoped="true">

.gradient {

    position: absolute;

    top: -80px;
    left: calc(70% - 500px);

    pointer-events: none;

    width: 1000px;
    height: 1000px;
    background: radial-gradient(50% 50% at 50% 50%, rgba(255, 255, 255, 0.3) 0%, rgba(0, 0, 0, 0.00) 80%);
    filter: opacity(70%);
}

.titlewrap {

    display: flex;
    flex-direction: row;

    align-items: center;
    justify-content: flex-end;

    width: 100%;
    height: 100%;

}

.title {

    display: flex;
    flex-direction: row;
    align-items: flex-end;
    justify-content: center;

    height: fit-content;
    width: 100%;

    user-select: none;

    gap: 10%;

    opacity: 0;

}

.title.loaded {
    opacity: 1;
    clip-path: polygon(0% -1000%, 0% -1000%, 0% 1000%, 0% 1000%);

    animation: titleAppear 1s ease-in-out forwards;
    animation-delay: .5s;
}

.title > div {
    position: relative;
    height: 100px;
    width: 200px;
}

.title > div > a {

    position: absolute;
    top: -225%;
    right: 0;

    width: 100%;

    font-weight: 800;
    font-size: 350px;
    color: var(--color-text);
    text-align: center;

    -webkit-clip-path: inset(0 0 48%);
    clip-path: inset(0 0 48%);

    background: url("/assets/images/title.gif");
    background-position: 0px 70px;
    -webkit-text-fill-color: transparent;
    -webkit-background-clip: text;

    filter: brightness(200%) saturate(0) invert(1);

}

.title > div > a:nth-child(2n) {

    -webkit-clip-path: inset(60% 0 0);
    clip-path: inset(60% 0 0);

}

.title-animdiv {

    position: absolute;

    margin-top: -8%;
    left: 0px;
    width: 0%;
    
    background-color: white;
    mix-blend-mode: difference;
}

.title-animdiv > a {
    font-size: 350px;
    font-weight: 800;
    opacity: 0;
}

.title-animdiv.loaded {
    width: 100%;
    left: 100%;

    animation: titleAnim 1s ease-in-out;
    animation-delay: .5s;
}

@keyframes titleAppear {
    from {
        clip-path: polygon(0% -1000%, 0% -1000%, 0% 1000%, 0% 1000%);
    }

    50%, to {
        clip-path: polygon(0% -1000%, 100% -1000%, 100% 1000%, 0% 1000%);
    }
}

@keyframes titleAppearMobile {
    from {
        clip-path: polygon(-1000% 0%, -1000% 0%, 1000% 0%, 1000% 0%);
    }

    50%, to {
        clip-path: polygon(-1000% 100%, -1000% 0%, 1000% 0%, 1000% 100%);
    }
}

@keyframes titleAnim {

    from {
        left: 0px;
        width: 0%;
    }

    50% {
        left: 0px;
        width: 100%;
    }

    to {
        left: 100%;
        width: 100%;
    }

}

@keyframes titleAnimMobile {

    from {
        top: 0px;
        height: 0%;
    }

    50% {
        top: 0px;
        height: 100%;
    }

    to {
        top: 100%;
        height: 100%;
    }

}

@media only screen and (max-width: 768px) {

    .titlewrap {

        height: 100svh;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 0px;

    }

    .title {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: space-around;
        height: 80%;
        margin-right: 5%;
    }

    .title.loaded {
        animation: titleAppearMobile 1s ease-in-out forwards;
        animation-delay: .5s;
    }

    .title > div > a {
        font-size: 125px;
        top: -50%;
    }

    .title-animdiv {

        margin-top: 0px;

        top: 0px;
        height: 0%;

        width: 100%;
        left: 0px;

    }

    .title-animdiv.loaded {

        width: 100%;
        left: 0px;

        height: 100%;
        top: 100%;

        animation: titleAnimMobile 1s ease-in-out;
        animation-delay: .5s;

    }

}

</style>