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
    function setWhereTheme($theme)
    {
        
        $theme = $selectionArray[$theme];
        return (!empty($theme)) ? "WHERE flow = '" . $theme ."'" : "";
    }
    function setWhereTime($time)
    {
        
        return (!empty($theme)) ? $time : "";
    }
    function getPagesFromBD($theme, $time, $sortby)
    {
        $setThemeArray =  array(
                                "development" => "AND flow = 'Разработка'",
                                "design" => "AND flow = 'Дизайн'",
                                "management" => "AND flow = 'Управление'",
                                "marketing" => "AND flow = 'Маркетинг'",
                                "different" => "AND flow = 'Разное'",
                                "all" => ""
                            );
        $setTimeArray = array(
                                  "week" => "WHERE post_time > " . strtotime("-7 day") . "",
                                  "lastDay" => "WHERE post_time < " . strtotime("-1 day") . " AND post_time > " . strtotime("-2 day") . "",
                                  "day" => "WHERE post_time > " . strtotime("-1 day") . ""
                             );
        $setOrderArray = array(
                                  "bydate" => "ORDER BY post_time DESC",
                                  "bypopularity" => "ORDER BY views DESC"
                              );
        dbInitialConnect();
        $time = $setTimeArray[$time];
        $orderBy = $setOrderArray[$sortby];
        $theme = $setThemeArray[$theme];
        $query = "SELECT * FROM posts " . $time . " " . $theme . " " . $orderBy ;
        $pagesArray = dbQueryGetResult($query);
        $pagesArray = (!empty($pagesArray)) ? $pagesArray : array();
        return $pagesArray;
    }