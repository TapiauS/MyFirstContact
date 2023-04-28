<?php
session_start();
if(isset($_POST)):
    unset($_SESSION['user']);
    unset($_SESSION['contacts']);
endif;

require 'View/logoutView.php';