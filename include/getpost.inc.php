<?php
    require_once 'simple_html_dom.php';
    require_once 'date.inc.php';
    header('Content-type: text/html; charset=utf-8');
    function getPostInfo($i)
    {
        $data = file_get_html('http://habrahabr.ru/all/');
        $post = $data -> find(".post", $i);
        if($post -> innertext != "")
        {
            $time = $post -> find(".post__header span.post__time_published", 0);
            $time = remakeDate($time -> innertext);
            $flow = $post -> find(".post__header h2 a.post__flow", 0);
            $flow = $flow -> innertext;
            $title = $post -> find(".post__header h2 a.post__title_link", 0);
            $href =  $title -> href;
            $title = $title -> innertext;
            foreach($post -> find(".post__header .hubs a.hub") as $hub)
            {
                $hubs[] =  $hub -> innertext;
            }
            $shortDescription = $post -> find(".post__body div.content", 0);
            $shortDescription = $shortDescription -> innertext;
            $views = $post -> find(".post__footer div.views-count_post", 0);
            $views = $views -> innertext;
            $favorite = $post -> find(".post__footer span.favorite-wjt__counter", 0);
            $favorite = $favorite -> innertext;
        }
        $data->clear();
        unset($data);
        $postArray = array(
                               "time" => $time,
                               "flow" => $flow,
                               "title" => $title,
                               "href" => $href,
                               "hubs" => $hubs,
                               "description" => $shortDescription,
                               "views" => $views,
                               "favorite" => $favorite,
                          );
        return $postArray;
    }
    