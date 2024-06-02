<head>

<?php

include_once __DIR__ . "/../../public/includes/Parsedown.php";

$articlesPath = __DIR__ . "/../../public/articles";
$articleName = $request["params"]["article"];

$articlePath = $articlesPath . "/" . $articleName . ".md";
$articleMetaPath = $articlesPath . "/" . $articleName . ".json";

if (file_exists($articlePath)) {
    $contents = file_get_contents($articlePath);
    $meta = json_decode(file_get_contents($articleMetaPath), true);
    
    echo "<title>" . $meta["title"] . " - niki</title>";
} else {
    $meta = false;
    $contents = false;
}

?>

</head>

<template>

<div style="height: 4rem; width: 100%;"></div>

<article aria-label="Content">
<?php

if ($contents == false) {
    echo "Not found";
    echo "</article>";
    exit();
}

$timestamp = strtotime($meta["date"]);
$dateString = date("M d, Y", $timestamp);

$parsedown = new Parsedown();

echo '<articletitle>' . $meta["title"] . '</articletitle><br>';
echo '<span style="font-family: var(--font-console);">' . $dateString . "</span>";
echo '<hr>';
echo $parsedown->text($contents);

?>

</article>

<button id="reading-mode" class="reading-mode">Reading Mode</button>

</template>

<script defer="true" lang="babel">

const readModeBut = document.getElementById("reading-mode");
var readingMode = false;

readModeBut.addEventListener("click", (event) => {
    if (!readingMode) {
        document.getElementById("noise").style.display = "none";
        document.getElementById("bg-cursorfollow").style.display = "none";
        readModeBut.classList.add("active");
        readModeBut.innerHTML = "Pretty Mode";

        readingMode = !readingMode;
    } else {
        document.getElementById("noise").style.display = "block";
        document.getElementById("bg-cursorfollow").style.display = "flex";
        readModeBut.classList.remove("active");
        readModeBut.innerHTML = "Reading Mode";

        readingMode = !readingMode;
    }
});

</script>

<style>

.reading-mode {
    position: fixed;
    bottom: 3rem;
    right: 3rem;

    padding-inline: 1rem;
    padding-block: .5rem;

    color: black;
    background-color: white;

    outline: none;
    border: none;

    font-family: var(--font-console);
    font-size: 14px;
    cursor: pointer;
}

.reading-mode.active {
    color: var(--color-text);
    background-color: transparent;
}

article {

    max-width: 950px;
    margin: 0 auto;

    margin-block: 3rem;

}

articletitle {
    font-family: var(--font-console);
    font-weight: bold;
    font-size: 38px;
}

hr {
    margin-left: 0px;
    width: 20%;
    height: .125rem;
    background-color: white;
}

h1 {
    font-family: var(--font-console);
    font-weight: bold;

    padding-right: .5rem;
    color: black;
    background-color: white;
    width: fit-content;
}

h1:before {
    content: "# ";

    color: rgba(255, 255, 255, .5);

    margin-left: -30px;
    margin-right: 1rem;

    font-family: var(--font-default);
    font-weight: bold;
}

h2 {
    font-family: var(--font-console);
    font-weight: bold;

    width: fit-content;
}

h2:before {
    content: "## ";

    color: rgba(255, 255, 255, .5);

    margin-left: -45px;
    margin-right: .5rem;

    font-family: var(--font-default);
    font-weight: bold;
}

code {
    font-family: var(--font-console);
}

pre {
    border-left: 3px solid rgba(255, 255, 255, .5);

    margin-left: -20px;
    padding-left: 18px;
}

@media only screen and (max-width: 768px) {
    .reading-mode { display: none; }
    article { max-width: 75%; }
}

</style>