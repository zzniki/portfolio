<template>

    <div class="text">
        <h1 class="salute">Hello!</h1>
        <h2 style="margin-top: .1rem; margin-bottom: .5rem;">My real name is <span class="name">Lluna</span><span class="phonetic">/ˈʎu.nə/</span></h2>
        <span>(niki is just a nickname)</span>
    </div>

    <div class="middletext">
        <p>I am an 18 year old geek from Spain (Barcelona)</p>
        <p>Who is obsessed with: </p>
        <ul>
            <li>Programming</li>
            <li>Making music</li>
        </ul>
    </div>

    <div class="icons">
        <a href="">
            <span>@zzniki</span>
            <i class="bi bi-discord"></i>
        </a>

        <a href="https://open.spotify.com/intl-es/artist/68nay5v0gAzXEo2XJbdXpf?si=eKRp5J9QROmW1Yi-v3SgLQ" target="_blank">
            <span>zzniki</span>
            <i class="bi bi-spotify"></i>
        </a>
        
        <a href="mailto:zznikiofficial@gmail.com">
            <span>zznikiofficial@gmail.com</span>
            <i class="bi bi-envelope-at-fill"></i>
        </a>
    </div>
</template>

<style scoped="true">

.text {
    margin-top: 3rem;
    margin-left: 1rem;
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
    margin-inline: auto;
    border: 2px solid var(--color-text);
    width: fit-content;
    padding: 1rem;
}

.icons {
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

</style>