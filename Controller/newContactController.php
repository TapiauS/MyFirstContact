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
                define("PICTURE",sanitize($_FILES['picture']['name']));
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
                if(!empty($_FILES)){
                    if($_FILES['picture']['error'] == 0){
                        $currentLocation = $_FILES['picture']['tmp_name'];
                        $file_name = $_FILES['picture']['name'];
                        $extension = pathinfo($file_name, PATHINFO_EXTENSION); 
                        $file_name_without_extension = pathinfo($file_name, PATHINFO_FILENAME); 
                        $new_file_name = $file_name_without_extension .$contact->getId().".".$extension;
                        $uploadLocation = "Images/$new_file_name";
                        move_uploaded_file($currentLocation, $uploadLocation);
                    }
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




