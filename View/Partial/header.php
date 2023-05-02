<?php
require_once 'Model/Entities/Contact.php';
if(!isset($_SESSION))
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My First Contact</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <?php 
                    if(array_key_exists('user',$_SESSION)):?>
                        <li class="nav-item">
                            <button id="disconnect">Se deconnecter</button>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/coursPHP/GestionnaireContact/newContactController.php">Nouveau Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/coursPHP/GestionnaireContact/allContactController.php">Tous les contacts</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/coursPHP/GestionnaireContact/logInController.php">Se Connecter</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/coursPHP/GestionnaireContact/signInController.php">Creer un compte</a>
                        </li>
                    <?php   
                    endif;
                    ?>
                </ul>
                </div>
            </div>
        </nav>
    </header>
