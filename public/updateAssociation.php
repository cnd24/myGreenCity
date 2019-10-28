<?php

require_once '../src/connec.php';

$pdo = new \PDO(DSN, USER, PASS);
$id = $_GET['id'] ?? $_POST['id'] ?? '';

$statement = $pdo->prepare("SELECT * FROM association WHERE id=:id");
$statement->bindValue(':id', $id, PDO::PARAM_INT);
$statement->execute();

$association = $statement->fetch(PDO::FETCH_ASSOC);



if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $data = array_map('trim', $_POST); //clean POST

    $errors = [];
    if(empty($data['name'])){
        $errors['name'][] = "Le nom de l'association doit être renseigné";
    }
//    if($data['name'] > 150){
//        $errors['name'][] = "Le nom de l'association ne doit pas dépasser 150 caractères";
//    }
    if(empty($data['description'])){
        $errors['description'][] = "Une description de l'association doit être renseignée";
    }

    if(empty($errors)){
        $query = "UPDATE association 
                  SET name=:name, adress=:adress, hours=:hours, tel=:tel, image=:image, description=:description
                  WHERE id=:id";
        $statement = $pdo->prepare($query);
        $statement->bindValue(':name', $data['name'], PDO::PARAM_STR);
        $statement->bindValue(':adress', $data['adress'], PDO::PARAM_STR);
        $statement->bindValue(':hours', $data['hours'], PDO::PARAM_STR);
        $statement->bindValue(':tel', $data['tel'], PDO::PARAM_STR);
        $statement->bindValue(':image', $data['image'], PDO::PARAM_STR);
        $statement->bindValue(':description', $data['description'], PDO::PARAM_STR);
        $statement->bindValue(':id', $data['id'], PDO::PARAM_INT);

        $statement->execute();
        header('Location: associations.php?id=' . $data['id'] . '&success=ok');
        exit();
    }

}

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title> Modifier les informations d'une association </title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Satisfy&display=swap" rel="stylesheet">
</head>

<body>

<?php include("header.php"); ?>


<form action="" method="POST" class="background" id="form">

    <h2>Modifier les informations d'une association</h2>

    <ul>
        <input type="hidden" name="id" value="<?= $association['id'] ?>">

        <li>
            <label for="name">Nom de l'association *</label>
            <input type="text" id="name" name="name" value="<?= $association['name'] ?>" required>
        </li>
        <span class="errorIndication">
        <?php
        if(!empty($errors['name'])){
            foreach ($errors['name'] as $error) {
                echo $error;
            }
        }
        ?>
        </span>


        <li>
            <label for="adress">Adresse</label>
            <input type="text" id="adress" name="adress" value="<?= $association['adress'] ?>">
        </li>


        <li>
            <label for="hours">Horaires</label>
            <input type="text" id="hours" name="hours" value="<?= $association['hours'] ?>">
        </li>


        <li>
            <label for="tel">Téléphone</label>
            <input type="tel" id="tel" name="tel" value="<?= $association['tel'] ?>">
        </li>

        <li>
            <label for="image">Nom de l'image</label>
            <input type="text" id="image" name="image" value="<?= $association['image'] ?>">
        </li>


        <li>
            <label for="description">Description *</label>
            <textarea id="description" name="description" required><?= $association['description'] ?></textarea>
        </li>
        <span class="errorIndication">
        <?php
        if(!empty($errors['description'])){
            foreach ($errors['description'] as $error) {
                echo $error;
            }
        }
        ?>
        </span>

        <li class="button">
            <button>Valider les modifications</button>
        </li>

    </ul>

</form>

<?php include("footer.php"); ?>

</body>
</html>