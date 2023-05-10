<?php
function addContact(){
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
        if(!empty($_FILES)){
            if($_FILES['picture']['error'] == 0){
                $file_name = $_FILES['picture']['name'];
                $extension = pathinfo($file_name, PATHINFO_EXTENSION);
                $file_name_without_extension = pathinfo($file_name, PATHINFO_FILENAME);
                $uniqname=uniqid($file_name_without_extension).".".$extension;
                define("PICTURE",sanitize($uniqname));
            }
            else
                define("PICTURE",null);
        }
        else
            define("PICTURE",null);
        define("NAMEREGEX","/^([a-zA-Z]+)*$/");
        define("PHONEREGEX",'/^\+33[1-9]\d{8}$/');
        define("MAILREGEX",'/^\S+@\S+\.\S+$/');
        $success=preg_match(NAMEREGEX,NAME)&&preg_match(NAMEREGEX,LASTNAME)&&preg_match(MAILREGEX,MAIL)
            &&(empty(PHONE)||preg_match(PHONEREGEX,PHONE));


        if($success):
            $contact=ContactManager::addContact(LASTNAME,NAME,MAIL,PHONE,BIRTHDATE,PICTURE);
            if(!is_null($contact)):
                if(!is_null(PICTURE)){
                    $currentLocation = $_FILES['picture']['tmp_name'];
                    $uploadLocation = "Images/".PICTURE;
                    error_log($uploadLocation);
                    move_uploaded_file($currentLocation, $uploadLocation);
                }
                header("Location:index.php");
            else:
                header("Location:index.php?target=error&errortype=newcontact");
            endif;
        else:
            header("Location:index.php?target=error&errortype=newcontact");
        endif;
    endif;
    require 'View/addContactView.php';
}

function oneContact(){
    require_once 'View/oneContactView.php';
}

function update(){
    var_dump($_POST);
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
        $oldpicture=$updatedcontact->getPicturePath();
        if(!empty($_FILES)){
            if($_FILES['picture']['error'] == 0){
                $file_name = $_FILES['picture']['name'];
                $extension = pathinfo($file_name, PATHINFO_EXTENSION);
                $file_name_without_extension = pathinfo($file_name, PATHINFO_FILENAME);
                $uniqname=uniqid($file_name_without_extension).".".$extension;

                define("PICTURE",sanitize($uniqname));
            }
            else
                define("PICTURE",$oldpicture);
        }
        else
            define("PICTURE",$oldpicture);

        $success=preg_match(NAMEREGEX,NAME)&&preg_match(NAMEREGEX,LASTNAME)&&preg_match(MAILREGEX,MAIL)
            &&(empty(PHONE)||preg_match(PHONEREGEX,PHONE));

        if($success):
            ContactManager::updateContact(LASTNAME,NAME,MAIL,PHONE,BIRTHDATE,PICTURE,$_GET['id']);
            if(!is_null($updatedcontact)):
                unlink("Images/".$oldpicture);
                $currentLocation = $_FILES['picture']['tmp_name'];
                $uploadLocation = "Images/".PICTURE;
                move_uploaded_file($currentLocation, $uploadLocation);
                $updatedcontact->setLastName(LASTNAME);
                $updatedcontact->setFirstName(NAME);
                $updatedcontact->setEmail(MAIL);
                $updatedcontact->setBirthDate(BIRTHDATE);
                $updatedcontact->setPhone(PHONE);
                $updatedcontact->setPicturePath(PICTURE);
                header("Location:index.php");
            else:
                header("Location:index.php?target=error&errortype=newcontact");
            endif;
        else:
            header("Location:index.php?target=error&errortype=newcontact");
        endif;
    endif;
    require_once 'View/alterContactView.php';
}

function allContact(){
    require_once 'View/allContactView.php';
}

function delete(){
    if(isset($_GET['id'])):
        $deletedcontact=null;
        foreach($_SESSION['contacts'] as $key=>$contact){
            if($contact->getId()===intval($_GET['id'])):
                $deletedcontact=$contact;
                error_log("key= ".$key);
                $contacts=$_SESSION['contacts'];
                array_splice($contacts,$key,1);
                $_SESSION['contacts']=$contacts;
                unlink("Images/".$deletedcontact->getPicturePath());
                break;
            endif;
        }
        ContactManager::removeContact($deletedcontact);
        header('Location:index.php?target=allcontact');
    endif;
    require_once 'View/allContactView.php';
}







