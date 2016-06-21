<?php
    function remakeDate($str)
    {
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
        $valArray = explode( ' ', $str);
        $nowDay = date('d');
        $result = NULL;
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