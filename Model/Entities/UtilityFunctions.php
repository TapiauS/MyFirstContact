<?php

function sanitize(?String $text):?String{
    if(!empty($text))
        return(htmlspecialchars(trim($text)));
    else
        return null;
}


