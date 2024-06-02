<template>

<!-- THIS PAGE WILL BE RE-IMPLEMENTED WHEN ALL THE PROJECTS HAVE SUITABLE DESCRIPTIONS --> 

<div style="height: 4rem; width: 100%;"></div>

<div class="articles">
    
<?php

$articlesPath = __DIR__ . "/../../public/projects";
$articleFiles = array_diff(scandir($articlesPath), array(".", ".."));
$articleFiles = array_reverse($articleFiles);

foreach ($articleFiles as &$filename) {

    $filepath = $articlesPath . "/" . $filename;
    $pathInfo = pathinfo($filepath);

    if ($pathInfo["extension"] != "json") continue;
    
    $contents = file_get_contents($filepath);
    $meta = json_decode($contents, true);

    $articleUrl = "/projects/" . $pathInfo["filename"];
    
    echo '<a class="article" onclick="return loaderRedirect(' . "'" . $articleUrl . "'" . ');" href="' . $articleUrl . '">';
    echo '<span class="article-cursor">></span>';

    echo '<span class="article-inner">';
    echo '<span class="article-title">' . $meta["title"] . "</span>";
    echo '<span class="article-preview">' . $meta["preview"] . "</span>";
    echo '</span>';

    echo '<span style="flex-grow: 1"></span>';
    echo '<span class="article-date">' . date("M d, Y", strtotime($meta["date"])) . '</span>';

    echo '</a>';

}

?>
</div>

</template>

<style>

    .articles {
        display: flex;
        flex-direction: column;

        align-items: center;
        width: 100%;

        gap: 1rem;
    }

    .article {
        display: flex;
        flex-direction: row;
        align-items: center;

        width: 75vw;

        text-decoration: none;
    }

    .article-cursor {
        font-family: var(--font-console);
        margin-right: 1rem;
        font-size: 26px;

        transition: transform ease-in-out .25s;
    }

    .article:hover > .article-cursor {
        transform: translateX(.5rem);
    }

    .article-inner {
        display: flex;
        flex-direction: column;
    }

    .article-title {

        width: fit-content;

        padding-inline: .5rem;
        padding-block: .25rem;

        background-color: var(--color-text);
        color: var(--color-background);

        font-family: var(--font-console);
        font-weight: bold;
    }

    .article-date {
        font-family: var(--font-console);
        filter: brightness(75%);
    }

</style>