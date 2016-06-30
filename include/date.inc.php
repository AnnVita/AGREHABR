<?php
    $monthsArray = array(
                            "января"  => "January",
                            "февраля" => "February",
                            "марта" => "March",
                            "апреля" => "April",
                            "мая" => "May",
                            "июня" => "June",
                            "июля" => "July",
                            "августа" => "August",
                            "сентября" => "September",
                            "октября" => "October",
                            "ноября" => "November",
                            "декабря" => "December",
                        );
    function remakeDate($str)
    {
        global $monthsArray;
        $valArray = explode( ' ', $str);
        $nowDay = date('d');
        $result = '';
        if(count($valArray) == 3)
        {
            if($valArray[0] == "сегодня")
            {
                $result = strtotime("$valArray[2]");
            }
            else if($valArray[0] == "вчера")
            {
                $result = strtotime("-1 day $valArray[2]");
            }
        }
        else if(count($valArray) == 4)
        {
            $month = $monthsArray[$valArray[1]];
            $result = strtotime("$valArray[3] $valArray[0] $month");
        }
        if(count($valArray) == 5)
        {
            $month = $monthsArray[$valArray[1]];
            $result = strtotime("$valArray[4] $valArray[0] $month $valArray[2]");
        }
        return $result;
    }
    function dateForPost($unixDate)
    {
        global $monthsArray;
        $month = date('F', $unixDate);
        $month = array_search($month, $monthsArray);
        $day = date('d', $unixDate);
        $time = date('H:i', $unixDate);
        return "$day $month $time";
    }