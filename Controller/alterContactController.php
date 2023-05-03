<?php

function update(){
    require_once 'View/alterContactView.php';
    if(!empty($_POST)):
        define("NAME",sanitize($_POST["firstname"]));
        define("LASTNAME",sanitize($_POST["lastname"]));
        error_log(sanitize($_POST['birthdate']));
        if(!empty(sanitize($_POST['birthdate']))){
            $date=DateTime::createFromFormat('Y-m-d',sanitize($_POST['birthdate']));
            if($date)
                define("BIRTHDATE",$date);
            else
                define("BIRTHDATE",null);
        }
        else{   
            define("BIRTHDATE",null);
        }
            header("Location:index.php?target=error&errortype=newcontact");    
        define("MAIL",sanitize($_POST['mail']));
        define("PHONE",sanitize($_POST['phonenumber']));

        define("NAMEREGEX","/^([a-zA-Z]+)*$/");
        define("PHONEREGEX",'/^\+33[1-9]\d{8}$/');
        define("MAILREGEX",'/^\S+@\S+\.\S+$/');
        $updatedcontact=null;
        foreach($_SESSION['contacts'] as $contact){
            if($contact->getId()===intval($_GET['id'])):
                $updatedcontact=$contact;
                break;
            endif;
        }
        
        if(!empty($_FILES)){
            if($_FILES['picture']['error'] == 0){
                define("PICTURE",sanitize($_FILES['picture']['name']));
            }
            else
                define("PICTURE",null);
        }
        else
            define("PICTURE",null);

        $success=preg_match(NAMEREGEX,NAME)&&preg_match(NAMEREGEX,LASTNAME)&&preg_match(MAILREGEX,MAIL)
            &&(empty(PHONE)||preg_match(PHONEREGEX,PHONE));

        if($success):

            ContactManager::updateContact(LASTNAME,NAME,MAIL,PHONE,BIRTHDATE,PICTURE,$_GET['id']);
            if(!is_null($contact)):
                header("Location:index.php");
            else:
                header("Location:index.php?target=error&errortype=newcontact");
            endif;
        else:
            header("Location:index.php?target=error&errortype=newcontact");
        endif;
    endif;
}
