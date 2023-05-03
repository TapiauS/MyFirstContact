<?php 
function error(String $errortype):void{
    switch($errortype):
        case "connect":
            require_once "View/logFailedView.php";
            break;
        case "newcontact":
            require_once "View/newContactFailed.php";
            break;
        default:
            break;
    endswitch;    
}