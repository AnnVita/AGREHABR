<?php
    require_once 'database.inc.php';
    require_once 'query.inc.php';
    require_once 'getpost.inc.php';
    define("TIME_RANGE", "7");
    define("POSTS_URL", "http://habrahabr.ru/post/");
    define("ALL_POSTS_URL", "http://habrahabr.ru/all/");
    function newPostsToDB()
    {
        dbInitialConnect();
        $lastInsertedPostDB = getLastPageFromDB();
        $postId = getLastIdFromPage(ALL_POSTS_URL);
        if($postId > 0)
        {
            $postFromPage = getOnePost(POSTS_URL, $postId);
            while(($postFromPage["post_time"] > strtotime("-" . TIME_RANGE . " day")) || empty($postFromPage))
            {
                if(!empty($postFromPage) && (($lastInsertedPostDB['page_id'] != $postFromPage['page_id']) || empty($lastInsertedPostDB)))
                {
                    postToDB($postFromPage);
                }
                else if(($lastInsertedPostDB['page_id'] = $postFromPage['page_id']) && !empty($lastInsertedPostDB)) break;
                $postId--;
                $postFromPage = getOnePost(POSTS_URL, $postId);
            }
        }
    }
    dbInitialConnect();
    delPostsFromDB(strtotime("-" . TIME_RANGE . " day"));
    newPostsToDB();
    //cron stream_context_create