<?php
    require_once 'simple_html_dom.php';
    require_once 'date.inc.php';
    header('Content-type: text/html; charset=utf-8');
    function getLastIdFromPage($pageName)
    {
        $html = file_get_html($pageName);
        if(!$html)
        {
            $postId = -1;
        }
        else
        {
            foreach($html -> find(".post") as $post)
            {
                $idArray[] = (int) preg_replace('/[^0-9]/', '', $post -> id);
            }
            $postId = max($idArray);
            $html -> clear();
            unset($html);
        }
        return $postId;
    }
    function strOfFoundedInObj($domObject)
    {
        foreach($domObject as $item)
        {
            $itemsArray[] = ($item -> innertext);
        }
        $itemsStr = implode("," , $itemsArray);
        return $itemsStr;
    }
    function getOnePost($pageName, $postId)
    {
        $post = file_get_html($pageName . $postId);
        if((!$post) || !($post -> find(".post")))
        {
            $item = array();
        } 
        else
        {
            $item['post_time'] = remakeDate($post -> find(".post__header span.post__time_published", 0) -> innertext);
            $item['flow'] = $post -> find(".post__header h1 a.post__flow", 0) -> innertext;
            $item['title'] = $post -> find(".post__header h1 span", 1) -> innertext;
            $item['page_id'] =  $postId;
            $item['hubs'] = strOfFoundedInObj($post -> find(".post__header .hubs a.hub"));
            $item['views'] = (int) ($post -> find("div.views-count_post", 0) -> plaintext);
            $item['favorite'] = (int) ($post -> find("span.favorite-wjt__counter", 0) -> innertext);
            $item['full_text'] = $post -> find("div.content", 0) -> innertext;
            $item['tags'] = strOfFoundedInObj($post -> find("ul.tags li a"));;
            $post -> clear();
            unset($post);
        } 
        return $item;
    }