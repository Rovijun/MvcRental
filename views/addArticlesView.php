<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ajout voiture</title>
</head>
<body>
    <form enctype="multipart/form-data" action="processFormController.php" method="post">

        <input class="form-control" type="text" name="marque" placeholder="Marque"><br>

        <select class="form-control" required name="type">
        <option disabled selected value="">Types</option>
        <?php foreach($type as $types) { ?>
        <option value="<?=$types['Nom']?>">
            <?=$types['Nom']?>
        </option>
        <?php } ?>
        </select>

        <select class="form-control" required name="agence">
        <option disabled selected value="">Agences</option>
        <?php foreach($agence as $agences) { ?>
        <option value="<?=$agences['Nom']?>">
            <?=$agences['Nom']?>
        </option>
        <?php } ?>
            
        <input type="file" class="form-control-file border" name="image"/>
        <input class="btn btn-danger" type="submit" value="Ajouter"/>

    </form>
</body>
</html>