<?php
$controller='Controller';
$manager='Model/Manager';
$entities='Model/Entities';
error_log("test");
foreach(glob("$controller/*.php") as $import):
    require_once $import;
endforeach;
foreach(glob("$manager/*.php") as $import):
    require_once $import;
endforeach;
foreach(glob("$entities/*.php") as $import):
    require_once $import;
endforeach;

session_start();

if(!empty($_GET)){
    if(isset($_GET['target'])):
        switch($_GET['target']):
            case 'error':
                error($_GET['errortype']);
                break;
            case 'newcontact':
                addContact();
                break;
            case 'allcontact':
                allContact();
                break;
            case 'onecontact':
                oneContact();
                break;    
            case 'connect':
                connect();
                break;
            case 'logout':
                logout();
                break;
            case 'signin':
                signin();
                break;
            case 'deletecontact':
                delete();
                break;
            case 'updatecontact':
                update();
                break;
            default:
                echo 'que fait tu ici';
        endswitch;   
    endif;       
}
else{
    home();
}