<template>

    <div class="text">
        <h1 class="salute">Hello!</h1>
        <h2 style="margin-top: .1rem; margin-bottom: .5rem;">My real name is <span class="name">Ferran</span><span class="phonetic">/fərán/</span></h2>
        <span>(niki is just a nickname)</span>
    </div>

    <div class="middletext">
        <p>I am an 18 year old geek from Spain (Barcelona)</p>
        <p>Obsessed with</p>
        <div class="mobilewrap">
            <ul class="listfirst">
                <li>Programming</li>
                <li>Graphic Design</li>
                <li>Web Development</li>
                
            </ul>
            <ul class="listsecond">
                <li>Guitar</li>
                <li>Music Production</li>
                <li>Videogames</li>
            </ul>
        </div>
    </div>

    <div class="icons">
        <a>
            <span>@zzniki</span>
            <i class="bi bi-discord"></i>
        </a>

        <a href="https://open.spotify.com/intl-es/artist/68nay5v0gAzXEo2XJbdXpf?si=eKRp5J9QROmW1Yi-v3SgLQ" target="_blank">
            <span>zzniki</span>
            <i class="bi bi-spotify"></i>
        </a>
        
        <a href="mailto:ferrandgr5@gmail.com">
            <span>ferrandgr5@gmail.com</span>
            <i class="bi bi-envelope-at-fill"></i>
        </a>
    </div>
</template>

<style scoped="false">

.text {
    margin-top: 5rem;
    margin-left: 3rem;
    margin-bottom: 2rem;
}

.salute {
    margin: 0px;
    font-size: 80px;
}

.name {
    background-color: white;
    color: var(--color-background);

    padding-block: .125em;
    padding-inline: .25em;
}

.phonetic {
    filter: opacity(50%);
    margin-left: .5rem;
}

.middletext {
    text-align: center;

    margin-inline: auto;
    
    width: fit-content;
    padding: 1rem;
}

.mobilewrap > ul {
    display: flex;
    justify-content: center;
    list-style: none;
    gap: 2rem;
    padding-left: 0px;
}

.mobilewrap > ul > li {
    padding-block: .25rem;
    padding-inline: .75rem;
    color: var(--color-white);
    font-family: var(--font-console);
    background: url("/assets/images/title.gif") 0px 70px;
    filter: invert(1);
}

.mobilewrap > ul > li:hover {
    background: white;
    color: var(--color-background);
}

.icons {
    position: fixed;
    bottom: 3rem;
    right: 3rem;
    
    display: flex;
    align-items: flex-end;
    justify-content: center;
    flex-direction: column;
    gap: 1rem;
}

.icons > a {
    display: flex;
    align-items: center;
    justify-content: center;
    
    cursor: pointer;
    text-decoration: none;
    gap: 1rem;
}

.icons > a > i {
    font-size: 38px;
}

.icons > a > span {
    font-family: var(--font-console);
}

.icons > a:hover > span {
    -webkit-text-stroke-width: 1px;
    -webkit-text-stroke-color: var(--color-text);
    color: transparent;
}

@media only screen and (max-width: 768px) {
    .text {
        margin-left: 1rem;
    }

    .icons {
        bottom: 1rem;
        right: 1rem;
    }

    .middletext {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;

        width: 100%;
        padding: 0px;
        margin-block: 20%;
    }
    .mobilewrap {
        display: flex;
        flex-direction: row;
        justify-content: center;
        width: 100%;
    }
    .mobilewrap > ul {
        justify-content: center;
        align-items: center;
        gap: 1rem;
        flex-direction: column;
    }
    .listfirst {
        align-items: flex-start !important;
    }
    .listsecond {
        align-items: flex-end !important;
    }
}

</style>