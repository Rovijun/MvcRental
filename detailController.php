<?php
    //Affichage erreur
    ini_set('display_errors', 1);
    ini_set('log_errors', 1);
    ini_set('error_log', dirname(__file__) . '/log_error_php.txt');
    
    //1. prendre connaissance du model
    include("model/model.php");

    //2. analyse de l'url filtrage NTU
    //3. recuperer les données nécessaires auprès du model
    if((isset($_GET['id'])) && !empty($_GET['id'])){
        $id = filter_var($_GET['id'], FILTER_VALIDATE_INT);
        $voiture = get_voiture_by_id($id);
    } 
    else {
        header("Location: listeController.php");
    }

    //4. appeler la bonne vue
    include("views/detailArticlesView.php");
?>