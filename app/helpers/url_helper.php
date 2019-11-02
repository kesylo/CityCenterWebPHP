<?php

// simple page redirect

function redirect ($page) {
    header('location: ' .URLROOT. '/' .$page);
}

function fullDate($date){
    $strDate = mb_convert_encoding('%A %d %B %Y','ISO-8859-9','UTF-8');
    return ucfirst(iconv("ISO-8859-9","UTF-8",strftime($strDate ,strtotime($date))));
}

/*function UStoFRDate($stringDate){
    $stringDate = explode("/", $stringDate);
    $newsDate=$stringDate[0].'-'.$stringDate[1].'-'.$stringDate[2];
    return $newsDate;
}*/

