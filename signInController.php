<?php
session_start();
require 'Model/Entities/UtilityFunctions.php';
require 'Model/Manager/UserManager.php';
if(isset($_POST)&&!empty($_POST)):
    define("PSEUDO",sanitize($_POST["pseudo"]));
    define("PASSWORD",sanitize($_POST["password"]));
    define("PSEUDOREGEX","/^[a-zA-Z'-]+$/");
    $user=UserManager::newUser(PSEUDO,PASSWORD);
    if(!is_null($user)):
        $_SESSION["user"]=$user;
        header("Location:homeController.php");
    else:
        header("Location:logfailedController.php");
        exit();
    endif;
endif;

require 'View/signInView.php';