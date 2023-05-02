<?php
require_once 'Model/Entities/Contact.php';
session_start();

// Set some session data

// Generate a JSON response that includes the session data
if(empty($_GET)):
    header('Content-Type: application/json');
    echo json_encode($_SESSION["contacts"]);
else:
    $id=$_GET['id'];
    $onecontact;
    foreach($_SESSION["contacts"] as $contact){
        if($id===$contact):
            $onecontact=$contact;
            break;
        endif;
    }
    echo json_encode($onecontact);
endif;
?>