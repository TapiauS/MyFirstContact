<?php

function signIn(){
    if(isset($_POST)&&!empty($_POST)):
        define("PSEUDO",sanitize($_POST["pseudo"]));
        define("PASSWORD",sanitize($_POST["password"]));
        define("PSEUDOREGEX","/^[a-zA-Z'-]+$/");
        $user=UserManager::newUser(PSEUDO,PASSWORD);
        if(!is_null($user)):
            $_SESSION["user"]=$user;
            header("Location:index.php");
        else:
            header("Location:index.php?target=error&errortype=connect");
            exit();
        endif;
    endif;
    
    require 'View/signInView.php';
}
