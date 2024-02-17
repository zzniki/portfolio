<template>

<div style="height: 4rem; width: 100%;"></div>

<article aria-label="Content">
<?php

include_once __DIR__ . "/../../public/includes/Parsedown.php";

$articlesPath = __DIR__ . "/../../public/articles";
$articleName = $request["params"]["article"];
$articlePath = $articlesPath . "/" . $articleName . ".md";

if (!file_exists($articlePath)) {
    echo "Not found";
    exit();
}

$contents = file_get_contents($articlePath);

$parsedown = new Parsedown();
echo $parsedown->text($contents);

?>

</article>

</template>

<style>

article {

    max-width: 950px;
    margin: 0 auto;

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

</style>