<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blog - Liste des voitures</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Marques</th>
                <th>Types</th>
                <th>Agences</th>
                <th>Détail</th>
                <th>Suppression</th>
                <th>Modifier</th>
            </tr>
            </tr>
        </thead>
        <tbody>
            <?php foreach($voitures as $voiture) { ?>
            <tr>
                <td><?=$voiture['idVOITURE']?></td>
                <td><?=$voiture['Marque']?></td>
                <td><?=$voiture['Types']?></td>
                <td><?=$voiture['Agences']?></td>
                <td><a href="detailController.php?id=<?=$voiture['idVOITURE']?>">Voir le détail</a></td>
                <td><a href="deleteController.php?id=<?=$voiture['idVOITURE']?>">Supprimer</a></td>
                <td><a href="updateController.php?id=<?=$voiture['idVOITURE']?>">Modifier</a></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <a href="ajoutController.php">Ajouter</a>
</body>
</html>