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
    foreach($_SESSION["contacts"] as $contact){
        if(intval($id)===$contact->getId()):
            echo json_encode($contact);
            break;
        endif;
    }
endif;
?>