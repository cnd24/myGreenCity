<?php

require_once '../src/connec.php';

$pdo = new \PDO(DSN, USER, PASS);

$id = $_GET['id'];
$statement = $pdo->prepare("SELECT * FROM association WHERE id=:id");
$statement->bindValue(':id', $id, PDO::PARAM_INT);
$statement->execute();
$association = $statement->fetch(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title> <?= htmlentities($association['name']) ?> </title>
  <link rel="stylesheet" href="style.css">
  <link href="https://fonts.googleapis.com/css?family=Satisfy&display=swap" rel="stylesheet">
</head>

<body>

<?php include("header.php"); ?>

    <?php if(!empty($_GET['success'])): ?>
        <div class="errorIndication">Les informations ont bien été modifiées.</div>
    <?php endif; ?>

    <h2> <?= htmlentities($association['name']) ?></h2>

        <h3> Informations </h3>

    <img class="imageMobileAsso" src="<?= $association['image']; ?>" alt="">

    <section class="informations">
      <div class="horaires">
        <h3> Horaires </h3>
          <p class="adresse"> <?= htmlentities($association['hours']) ?></p>
      </div>

      <div class="horaires">
        <h3> Adresse </h3>
          <p class="adresse"> <?= htmlentities($association['adress']) ?></p>
      </div>

      <div class="horaires">
        <h3> Téléphone </h3>
          <p class="adresse"> <?= htmlentities($association['tel']) ?></p>
      </div>



      <img class="imageDesktopAsso" src="<?= htmlentities($association['image']) ?>" alt="">

    </section>

      <section class="bg">
        <h3> Description </h3>

          <div class="description">
            <p><?= htmlentities($association['description']) ?></p>
          </div>
      </section>

    <button class="btn-add"><a href="updateAssociation.php?id=<?= $association['id']?>" link="Modifier une association">Modifier les informations</a></button>
    <form action="deleteAssociation.php" method="POST">
        <input name="id" type="hidden" value="<?= $association['id'] ?> "/>
        <button class="btn-delete">Supprimer une association</button>
    </form>



<?php include("footer.php"); ?>

</body>
</html>
