<?php
session_start();
unset($_SESSION['user']);
unset($_SESSION['contacts']);
header("Location:homeController.php");
