<?php
    require_once 'database.inc.php';
    require_once 'query.inc.php';
    require_once 'getpost.inc.php';
    define("TIME_RANGE", "7");
    define("POSTS_URL", "http://habrahabr.ru/post/");
    define("ALL_POSTS_URL", "http://habrahabr.ru/all/");
    function newPostsToDB()
    {
        $newPostsArray = array();
        $lastInsertedPostDB = getLastPageFromDB();
        $postId = getLastIdFromPage(ALL_POSTS_URL)-100;
        if($postId > 0)
        {
            $postFromPage = getOnePost(POSTS_URL, $postId);
            while(($postFromPage["post_time"] > strtotime("-" . TIME_RANGE . " day")) || empty($postFromPage))
            {
                if(!empty($postFromPage) /*&& (($lastInsertedPostDB['page_id'] != $postFromPage['page_id']) || empty($lastInsertedPostDB))*/)
                {
                    var_dump($postFromPage);
                    postToDB($postFromPage);
                }
                //else if(($lastInsertedPostDB['page_id'] = $postFromPage['page_id']) && !empty($lastInsertedPostDB)) break;
                $postId--;
                $postFromPage = getOnePost(POSTS_URL, $postId);
            }
        }
    }
    dbInitialConnect();
    //delPostsFromDB(strtotime("-" . TIME_RANGE . " day"));
    newPostsToDB();