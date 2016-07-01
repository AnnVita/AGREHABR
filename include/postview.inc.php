<?php
    require_once 'date.inc.php';
    function postsForPage($postsArray)
    {
        foreach($postsArray as &$post)
        {
            $post["description"] = strstr($post["full_text"] , "<a name=\"habracut\"></a>", true);
            $post["post_time"] = dateForPost($post["post_time"]);
        }
        return $postsArray;
    }
    function postForFullView($post)
    {
        $post["full_text"] = strstr($post["full_text"] , "<a name=\"habracut\"></a>", false);
        return $post;
    }