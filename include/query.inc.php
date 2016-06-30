<?php
    require_once 'database.inc.php';
    function postToDB($post)
    {
        $query = dbQuery("INSERT IGNORE INTO posts (post_time, flow, title, page_id, hubs, views, favorite, full_text, tags) 
                          VALUES(" . $post["post_time"] . ", '" . $post["flow"] . "', '" . $post["title"] . "', " . $post["page_id"] . ", '" . $post["hubs"] . "', " . $post["views"] . ", " . $post["favorite"] . ", '" . $post["full_text"] . "', '" . $post["tags"] . "')");
    }
    function delPostsFromDB($lastTime)
    {
        $query = dbQuery("DELETE LOW_PRIORITY
                          FROM posts
                          WHERE post_time < " . $lastTime. "
                          ORDER BY post_time");
    }
    function getLastPageFromDB()
    {
        dbInitialConnect();
        $onePage = dbQueryGetResult("SELECT * FROM posts ORDER BY post_time DESC LIMIT 1");
        $onePage = (!empty($onePage)) ? $onePage[0] : array();
        return $onePage;
    }
    function getPagesByDate()
    {
        dbInitialConnect();
        $pagesArray = dbQueryGetResult("SELECT * FROM posts ORDER BY post_time DESC");
        $pagesArray = (!empty($pagesArray)) ? $pagesArray : array();
        return $pagesArray;
    }