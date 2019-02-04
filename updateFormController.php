<?php
/*
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', dirname(__file__) . '/log_error_php.txt');*/

//1. se met en lien avec le model
include("model/model.php");

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
  $id = $_POST['id'];

    $tabs = array(
        ':marque'  => $filtreInput,
        ':agence' => $resAgence,
        ':type' => $resType,
        ':image' => $images,
        ':id' => $id
    );

  updateVoiture($filtreInput, $resAgence, $resType, $images, $id);

  include("views/successView.php");

}


?>