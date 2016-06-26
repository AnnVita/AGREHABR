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
            $postId = $html -> find(".post", 0) -> id;
            $postId = (int) preg_replace('/[^0-9]/', '', $postId);
        }
        $html -> clear();
        unset($html);
        return $postId;
    }
    function strOfFoundedInObj($domObject, $innerInfoType = innertext)
    {
        foreach($domObject as $item)
        {
            $itemsArray[] = ($item -> $innerInfoType);
        }
        $itemsStr = implode("," , $itemsArray);
        return $itemsStr;
    }
    function getOnePost($pageName, $postId)
    {
        $post = file_get_html($pageName . $postId);
        if(!$post)
        {
            $item = array();
        } 
        else
        {
            $item['time'] = remakeDate($post -> find(".post__header span.post__time_published", 0) -> innertext);
            $item['flow'] = $post -> find(".post__header h1 a.post__flow", 0) -> innertext;
            $item['title'] = $post -> find(".post__header h1 span", 0) -> plaintext;
            $item['id'] =  $postId;
            $item['hubs'] = strOfFoundedInObj($post -> find(".post__header .hubs a.hub"));
            $item['fullText'] = $post -> find(".post div.content", 0) -> innertext;
            $item['views'] = $post -> find("div.views-count_post", 0) -> innertext;
            $item['favorite'] = $post -> find("span.favorite-wjt__counter", 0) -> innertext;
            $item['tags'] = strOfFoundedInObj($post -> find("ul.tags li a"));;
        } 
        $post -> clear();
        unset($post);
        return $item;
    }