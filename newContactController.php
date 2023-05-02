<?php
require_once 'Model/Entities/User.php';
if(!isset($_SESSION))
    session_start();
require 'Model/Entities/UtilityFunctions.php';
require 'Model/Manager/ContactManager.php';
if(isset($_POST)&&!empty($_POST)):
    define("DATEREGEX",'/^\d{4}-\d{2}-\d{2}$/');
    define("NAME",sanitize($_POST["firstname"]));
    define("LASTNAME",sanitize($_POST["lastname"]));
    var_dump(sanitize($_POST['birthdate']));
    if(empty(sanitize($_POST['birthdate']))||preg_match("DATEREGEX",sanitize($_POST['birthdate']))){
        if(!empty(sanitize($_POST['birthdate']))){
            define("BIRTHDATE",DateTime::createFromFormat('Y-m-d',sanitize($_POST['birthdate'])));
        }
        else{   
            define("BIRTHDATE",null);
        }
    }
    else{
        echo "option 1";
        header("Location:newContactFailedController.php");   
    }
        header("Location:newContactFailedController.php");    
    define("MAIL",sanitize($_POST['mail']));
    define("PHONE",sanitize($_POST['phonenumber']));

    define("NAMEREGEX","/^([a-zA-Z]+)*$/");
    define("PHONEREGEX",'/^\+33[1-9]\d{8}$/');
    define("MAILREGEX",'/^\S+@\S+\.\S+$/');
    $success=preg_match(NAMEREGEX,NAME)&&preg_match(NAMEREGEX,LASTNAME)&&preg_match(MAILREGEX,MAIL)
        &&(empty(PHONE)||preg_match(PHONEREGEX,PHONE));
    if($success):
        $contact=ContactManager::addContact(LASTNAME,NAME,MAIL,PHONE,BIRTHDATE,null);
        if(!is_null($contact)):
            header("Location:homeController.php");
        else:
            echo "option2";
            header("Location:newContactFailedController.php");
        endif;
    else:
        echo "option3";
        header("Location:newContactFailedController.php");
    endif;
endif;
require 'View/addContactView.php';



