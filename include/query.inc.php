<?php
    require_once 'database.inc.php';
    function postToDB($post)
    {
        $query = dbQuery("INSERT IGNORE INTO posts (post_time, flow, title, page_id, hubs, views, favorite, full_text, tags) 
                          VALUES(" . $post["time"] . ", '" . $post["flow"] . "', '" . $post["title"] . "', " . $post["id"] . ", '" . $post["hubs"] . "', " . $post["views"] . ", " . $post["favorite"] . ", '" . $post["fullText"] . "', '" . $post["tags"] . "')");
    }
    function delPostsFromDB($lastTime)
    {
        $query = dbQuery("DELETE LOW_PRIORITY
                          FROM posts
                          USING table-references
                          WHERE where_definition");
    }
    function getPageIdFromDB($dbId)
    {
        return dbQueryGetResult("SELECT * FROM posts ORDER BY post_time LIMIT 1");
    }