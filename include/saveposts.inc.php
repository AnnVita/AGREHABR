<?php
    require_once 'getpost.inc.php';
    require_once 'database.inc.php';
    header('Content-type: text/html; charset=utf-8');
    dbInitialConnect();
    $onePost = getPostInfo(1);
    function postToDatabase($post)
    {
        $hubsList = implode("," , $onePost["hubs"]);
        $query = dbQuery("INSERT INTO posts (post_time, flow, title, href, hubs, description, views, favorite) VALUES(" . $onePost["time"] . ", '" . $onePost["flow"] . "', '" . $onePost["title"] . "', '" . $onePost["href"] . "', '" . $hubsList . "', '" . $onePost["description"] . "', '" . $onePost["views"] . "', '" . $onePost["favorite"] . "')");
    }
    function fillDatabase()
    {
        //if not emty
          //get last id
        //while post date > now date - 30 && title and date of last id <> getted post && i <= 10
          
    }
    function cleanDatabase()
    {
        //guery to database for deleting old posts
    }