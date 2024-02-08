<template>

    <div class="titlewrap">
        <div class="title">
            <!--<img src="/assets/images/cat-laying.png">-->
            <div><a>n</a><a>n</a></div>
            <div><a>i</a><a>i</a></div>
            <div><a>k</a><a>k</a></div>
            <div><a>i</a><a>i</a></div>
        </div>
    </div>

</template>

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

@media only screen and (max-width: 768px) {

    .titlewrap > div:not(.title) {
        display: none;
    }

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

    .title > div > a {
        font-size: 125px;
        top: -50%;
    }

}

</style>