<?php
    //Affichage erreur
    ini_set('display_errors', 1);
    ini_set('log_errors', 1);
    ini_set('error_log', dirname(__file__) . '/log_error_php.txt');
   
    //1. se mettre en lien avec le modèle.
    include("model/model.php");

    //2. analyse de l'url filtrage NTU
    //3. recuperer les données nécessaires auprès du model

    $agence = afficheAgence();
    $type = afficheType();
    
    //4. appeler la bonne vue
    include("views/addArticlesView.php");
?>