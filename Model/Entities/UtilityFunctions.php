<?php

function sanitize(?String $text):String{
    if(!is_null($text))
        return(htmlspecialchars(trim($text)));
    else
        return "";
}


