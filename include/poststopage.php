<?php
    require_once 'query.inc.php';
    require_once 'postview.inc.php';
    dbInitialConnect();
    $pagesArray = getPagesByDate();
    $pagesArray = array_slice($pagesArray, $_GET["last"], $_GET["count"]);
    $pagesArray = postsForPage($pagesArray);
    echo json_encode($pagesArray);
    //var_dump($pagesArray);