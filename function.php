<?php

require_once("base.php");

const HIGHLIGHT = "<mark>$1</mark>";

if (empty($_POST['search']))
    die("Search field is required!");
$search_user = $_POST['search'];
if ($_FILES['file']['error'] != UPLOAD_ERROR_OK)
    die("File upload failed! Probably file is not selected...");
$content = file_get_contents($_FILES['file']['tmp_name']);

$preresult = explode("\"", $search_user);
if (!(count($preresult) % 2))
    die("Query syntax error! Double quotes have not been closed!");

$search_queries = [];
for ($i = 0; $i < count($preresult); $i += 1)
{
    $q = trim($preresult[$i]);
    if ($i % 2)
    {
        if ($q !== "")
            $search_queries[] = $q;
        continue;
    }

    $sq = explode(" ", $q);
    foreach ($sq as $qq)
        if ($qq !== "") 
            $search_queries[] = $qq;
}

foreach ($search_queries as $query)
{
    $safe_query = preg_quote($query);

    $endings = "(?:";
    $endings .= implode("|", $rus);
    $endings .= "|".implode("|", $eng);
    $endings .= ")?";
    preg_match_all("/^(.+?)({$endings})$/is", $safe_query, $matches);
    $word_base = $matches[1][0];

    $content = preg_replace("/(\b{$word_base}{$endings}\b)/is", HIGHLIGHT, $content);
}

echo $content;

