<?php
function delete(){
    if(isset($_GET['id'])):
        $deletedcontact=null;
        foreach($_SESSION['contacts'] as $key=>$contact){
            if($contact->getId()===intval($_GET['id'])):
                $deletedcontact=$contact;
                unset($_SESSION['contacts'][$key]);
                break;
            endif;
        }
        ContactManager::removeContact($deletedcontact);
    endif;
    require_once 'View/allContactView.php';
}
