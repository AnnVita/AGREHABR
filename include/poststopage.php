<?php
    require_once 'query.inc.php';
    dbInitialConnect();
    $pagesArray = getPagesByDate();
    echo json_encode($pagesArray);