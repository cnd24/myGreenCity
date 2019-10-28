<?php

require_once '../src/connec.php';

$pdo = new \PDO(DSN, USER, PASS);


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
        $query = "INSERT INTO association (name, adress, hours, tel, image, description) 
                  VALUES (:name, :adress, :hours, :tel, :image, :description)";
        $statement = $pdo->prepare($query);
        $statement->bindValue(':name', $data['name'], PDO::PARAM_STR);
        $statement->bindValue(':adress', $data['adress'], PDO::PARAM_STR);
        $statement->bindValue(':hours', $data['hours'], PDO::PARAM_STR);
        $statement->bindValue(':tel', $data['tel'], PDO::PARAM_STR);
        $statement->bindValue(':image', $data['image'], PDO::PARAM_STR);
        $statement->bindValue(':description', $data['description'], PDO::PARAM_STR);

        $statement->execute();

        header("Location: index.php");
        exit();
    }

}

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title> Ajouter une nouvelle association </title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Satisfy&display=swap" rel="stylesheet">
</head>

<body>

<?php include("header.php"); ?>


<form action="" method="POST" class="background" id="form">

    <h2>Ajouter une nouvelle association</h2>

    <ul>

        <li>
            <label for="name">Nom de l'association *</label>
            <input type="text" id="name" name="name" required>
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
            <input type="text" id="adress" name="adress">
        </li>


        <li>
            <label for="hours">Horaires</label>
            <input type="text" id="hours" name="hours">
        </li>


        <li>
            <label for="tel">Téléphone</label>
            <input type="tel" id="tel" name="tel">
        </li>

        <li>
            <label for="image">Nom de l'image</label>
            <input type="text" id="image" name="image">
        </li>


        <li>
            <label for="description">Description *</label>
            <textarea id="description" name="description" required></textarea>
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
            <button>Ajouter</button>
        </li>

    </ul>

</form>

<?php include("footer.php"); ?>

</body>
</html>