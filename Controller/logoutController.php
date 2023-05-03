<?php
function logout(){
    unset($_SESSION['user']);
    unset($_SESSION['contacts']);
    header("Location:index.php");
}

