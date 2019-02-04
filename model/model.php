<?php

    function connectDB(){
        //connexion bdd
        $user = "student";
        $pass = "M0t_de_passe";
        
        $bdd = new PDO('mysql:host=localhost;dbname=rental', $user, $pass);
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

        return $bdd;
    }

    function get_all_voiture(){
        
        $bdd = connectDB();
        
        //préparation de la requête sql en texte
        $sql = 'SELECT VOITURE.idVOITURE, VOITURE.Marque, TYPE_VOITURE.Nom AS Types, AGENCE.Nom AS Agences,
            VOITURE.Image FROM VOITURE INNER JOIN TYPE_VOITURE
            ON VOITURE.idTYPE_VOIT = TYPE_VOITURE.idTYPE_VOIT
            INNER JOIN AGENCE ON VOITURE.idAGENCE = AGENCE.idAGENCE
            ORDER BY VOITURE.idVOITURE';
        //transformer en vrai requete preparer
        $req = $bdd->prepare($sql);
        //binvalue
        //execution
        $req->execute();
        //fetchAll
        $results = $req->fetchAll(PDO::FETCH_ASSOC);  
        //fermer la connexion
        $bdd = null;
        //renvoyer les données
        return $results;
    }

    function get_voiture_by_id($id){
        $bdd = connectDB();
        $sql = 'SELECT VOITURE.idVOITURE, VOITURE.Marque, AGENCE.Nom AS Agence,
            TYPE_VOITURE.Nom AS Types
            FROM VOITURE INNER JOIN AGENCE
            ON AGENCE.idAGENCE = VOITURE.idAGENCE
            INNER JOIN TYPE_VOITURE
            ON TYPE_VOITURE.idTYPE_VOIT = VOITURE.idTYPE_VOIT
            WHERE idVOITURE = :id';
        $req = $bdd->prepare($sql);
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
        $results = $req->fetch(PDO::FETCH_ASSOC);
        $bdd = null;
        //print_r($results);
        return $results;
    }

    function afficheVoiture(){
        $bdd = connectDB();
        //recup Voiture pour Affiche
        $sql = 'SELECT VOITURE.Marque, TYPE_VOITURE.Nom
          FROM VOITURE INNER JOIN TYPE_VOITURE
          ON VOITURE.idTYPE_VOIT = TYPE_VOITURE.idTYPE_VOIT
          ORDER BY VOITURE.Marque';
        $req = $bdd->prepare($sql);
        $req->execute();
        $results = $req->fetchAll(PDO::FETCH_ASSOC);
        $bdd = null;
        return $results;
      }
    
    function afficheAgence(){
        $bdd = connectDB();
        //recup Agence Column Nom
        $sql = 'SELECT Nom FROM AGENCE';
        $req = $bdd->prepare($sql);
        $req->execute();
        $results = $req->fetchAll(PDO::FETCH_ASSOC);
        $bdd = null;
        return $results;
    }

    function afficheType(){
        $bdd = connectDB();
        //recup Type Column Nom
        $sql = 'SELECT Nom FROM TYPE_VOITURE';
        $req = $bdd->prepare($sql);
        $req->execute();
        $results = $req->fetchAll(PDO::FETCH_ASSOC);
        $bdd = null;
        return $results;
    }

    function selectAgenceId($input1){
        $bdd = connectDB();
        //recup idAgence
        $sql = 'SELECT idAGENCE FROM AGENCE WHERE Nom = :agence';
        $req = $bdd->prepare($sql);
        $req->bindParam(':agence', $input1, PDO::PARAM_STR);
        $req->execute();
        $results = $req->fetchAll(PDO::FETCH_COLUMN);
        $bdd = null;
        return $results;
    }

    function selectTypeId($input2){
        $bdd = connectDB();
        //recup idTYpe
        $sql = 'SELECT idTYPE_VOIT FROM TYPE_VOITURE WHERE Nom = :types';
        $req = $bdd->prepare($sql);
        $req->bindParam(':types', $input2, PDO::PARAM_STR);
        $req->execute();
        $results = $req->fetchAll(PDO::FETCH_COLUMN);
        $bdd = null;
        return $results;
    }

    function ajoutVoiture($input, $input1, $input2, $input3){
        $bdd = connectDB();
        //Ajout Voit
        $sql = "INSERT INTO `VOITURE` (Marque, idAGENCE, idTYPE_VOIT, Image)
          VALUES (:marque, (SELECT idAGENCE FROM AGENCE WHERE idAGENCE = :idAgence),
          (SELECT idTYPE_VOIT FROM TYPE_VOITURE WHERE idTYPE_VOIT = :idType), :images)";
        $req = $bdd->prepare($sql);
        $req->bindParam(':marque', $input, PDO::PARAM_STR);
        $req->bindParam(':idAgence', $input1, PDO::PARAM_INT);
        $req->bindParam(':idType', $input2, PDO::PARAM_INT);
        $req->bindParam(':images', $input3, PDO::PARAM_STR);
        $req->execute();
        $results = $req->fetchAll(PDO::FETCH_ASSOC);
        $bdd = null;
        return $results;
    }

    function delete_post($id) {
        //se connecter à la bdd
        $pdo = connectDB();
        //preparer une requete insert au format texte
        $sql = "DELETE FROM VOITURE WHERE idVOITURE=:id ";
        $stm = $pdo->prepare($sql);
        $stm->bindValue(':id', $id);
        $stm->execute();
    }

    function updateVoiture($input, $input1, $input2, $input3, $input4){
        $bdd = connectDB();
        //Update Voit
        $sql = 'UPDATE VOITURE SET VOITURE.Marque = :marque,
          VOITURE.idAGENCE = (SELECT idAGENCE FROM AGENCE WHERE AGENCE.Nom = :agence),
          VOITURE.idTYPE_VOIT = (SELECT idTYPE_VOIT FROM TYPE_VOITURE WHERE TYPE_VOITURE.Nom = :types),
          VOITURE.Image = :images WHERE VOITURE.idVOITURE = :id';
        $req = $bdd->prepare($sql);
        $req->bindParam(':marque', $input, PDO::PARAM_STR);
        $req->bindParam(':agence', $input1, PDO::PARAM_STR);
        $req->bindParam(':types', $input2, PDO::PARAM_STR);
        $req->bindParam(':images', $input3, PDO::PARAM_STR);
        $req->bindValue(':id', $input4, PDO::PARAM_INT);
        $req->execute();
        $results = $req->fetch();
        $bdd = null;
        return $results;
      }
?>