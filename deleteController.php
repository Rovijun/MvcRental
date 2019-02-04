<?php
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', dirname(__file__) . '/log_error_php.txt');
    
    //1. se met en lien avec le model
    include("model/model.php");

    //2.vérifie l'url
    if(!empty($_GET['id'])) {
        $id = filter_var($_GET['id'], FILTER_VALIDATE_INT);
        delete_post($id);
        include("views/successView.php");
    } else {
        header('Location: listeController.php');
    }