<?php

require 'Model/Entities/UtilityFunctions.php';
require 'Model/Manager/UserManager.php';
if(isset($_POST)&&!empty($_POST)):
    define("PSEUDO",sanitize($_POST["pseudo"]));
    define("PASSWORD",sanitize($_POST["password"]));
    define("PSEUDOREGEX","/^[a-zA-Z'-]+$/");
    $user=UserManager::connectUser(PSEUDO,PASSWORD);
    if(!is_null($user)){
        $_SESSION["user"]=$user;
    }
    else
    {
        header("Location: View/logFailedView.php");
        exit();
    }
endif;



