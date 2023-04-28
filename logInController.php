<?php
session_start();
require 'Model/Entities/UtilityFunctions.php';
require 'Model/Manager/UserManager.php';
if(isset($_POST)&&!empty($_POST)):
    define("PSEUDO",sanitize($_POST["pseudo"]));
    define("PASSWORD",sanitize($_POST["password"]));
    define("PSEUDOREGEX","/^[a-zA-Z'-]+$/");
    $user=UserManager::connectUser(PSEUDO,PASSWORD);
    if(!is_null($user)){
        $_SESSION["user"]=$user;
        header("Location:View/home.php");
    }
    else
    {
        header("Location:View/logFailedView.php");
        exit();
    }
endif;

require 'View/loginView.php';