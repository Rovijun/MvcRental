<?php
     //1. se mettre en lien avec le modèle.
     include("model/model.php");

     //2. analyse de l'url filtrage NTU
     //3. recuperer les données nécessaires auprès du model
 
     $agence = afficheAgence();
     $type = afficheType();
    
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0)
    {
      // Testons si le fichier n'est pas trop gros
        if ($_FILES['image']['size'] <= 1000000)
        {
          // Testons si l'extension est autorisée
                $infosfichier = pathinfo($_FILES['image']['name']);
                $extension_upload = $infosfichier['extension'];
                $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
                if (in_array($extension_upload, $extensions_autorisees))
                {
                  // On peut valider le fichier et le stocker définitivement
                  move_uploaded_file($_FILES['image']['tmp_name'], 'assets/img/' . basename($_FILES['image']['name']));
                }
        }
    }

    if (isset($_POST['marque'])){
      //Filtre les données entrées

      $filtreInput = filter_var($_POST['marque'], FILTER_SANITIZE_STRING);

      $images = basename($_FILES['image']['name']);

      $resType = $_POST['type'];
      $resAgence = $_POST['agence'];

      $idType = selectTypeId($resType);
      $idAgence = selectAgenceId($resAgence);

      foreach ($idAgence as $valeur1){
        foreach ($idType as $valeur2){
        $tab = array(
            ':marque'  => $filtreInput,
            ':idAgence' => $valeur1,
            ':idType' => $valeur2
        );
        ajoutVoiture($filtreInput, $valeur1, $valeur2, $images);
        }
      }
      include("views/successView.php");
    }
    else {
        header("Location: ajoutController.php");
    }
?>