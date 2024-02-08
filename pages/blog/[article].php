<template>

<div style="height: 4rem; width: 100%;"></div>

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

</template>