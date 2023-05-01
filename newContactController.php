<?php
if(!isset($_SESSION))
    session_start();
require 'Model/Entities/UtilityFunctions.php';
require 'Model/Manager/ContactManager.php';
if(isset($_POST)&&!empty($_POST)):
    define("DATEREGEX","/^(?:\d{4}-\d{2}-\d{2})?$/");
    define("NAME",sanitize($_POST["firstname"]));
    define("LASTNAME",sanitize($_POST["lastname"]));
    $format = 'Y-m-d';
    if(preg_match("DATEREGEX",sanitize($_POST['birthdate'])))
        define("BIRTHDATE",Date::createFromFormat($format,sanitize($_POST['birthdate'])));
    else
        header("Location:View/newContactFailed.php");    
    define("MAIL",sanitize($_POST['mail']));
    define("PHONE",sanitize($_POST['phonenumber']));

    define("NAMEREGEX","/^([a-zA-Z\s]*)$/");
    define("PHONEREGEX",'/^\+33[1-9]\d{8}$/');
    define("MAILREGEX",'/^\S+@\S+\.\S+$/');
    $success=preg_match(NAMEREGEX,NAME)&&preg_match(NAMEREGEX,LASTNAME)&&preg_match(MAILREGEX,MAIL)
        &&preg_match(PHONEREGEX,PHONE);
    if($success):
        $contact=ContactManager::addContact(LASTNAME,NAME,MAIL,PHONE,BIRTHDATE,null);
        if(!is_null($contact)):
            header("Location:View/home.php");
        else
            header("Location:View/newContactFailed.php");
        endif;
    else
        header("Location:View/newContactFailed.php");
    endif;
endif;
require 'View/addContactView.php';



