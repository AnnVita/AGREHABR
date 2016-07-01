<?php
    header('Content-type: text/html; charset=utf-8');
    require_once 'query.inc.php';
    dbInitialConnect();
    $page = getPagesById($_GET["page_id"]);
    $page = postForFullView($page);
    echo json_encode($page);