<?php
    header('Content-type: text/html; charset=utf-8');
    require_once 'query.inc.php';
    require_once 'postview.inc.php';
    dbInitialConnect();
    $pagesArray = getPagesFromBD($_GET["theme"], $_GET["time"], $_GET["sortby"]);
    $pagesArray = array_slice($pagesArray, $_GET["last"], $_GET["count"]);
    $pagesArray = postsForPage($pagesArray);
    echo json_encode($pagesArray);
    //var_dump($pagesArray);