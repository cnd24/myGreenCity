<?php
require_once '../src/connec.php';

$pdo = new \PDO(DSN, USER, PASS);
$statement = $pdo->query('SELECT * FROM association');
$associations = $statement->fetchAll(PDO::FETCH_ASSOC);


$firstname = $lastname = $mail = $message = '';
$errors = [];

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    foreach ($_POST as $key => $value){
        $data[$key] = trim($value);
    }

    if(empty($data['firstname'])){
        $errors['firstname'][] = 'Merci de renseigner votre prénom';
    }

    if(empty($data['lastname'])){
        $errors['lastname'][] = 'Merci de renseigner votre nom';
    }

    if(empty($data['user_mail'])){
        $errors['user_mail'][] = 'Merci de renseigner votre e-mail';
    }
    elseif (!filter_var($data['user_mail'], FILTER_VALIDATE_EMAIL)) {
        $errors['user_mail'][] = "Format d'email invalide";
    }

    if(empty($errors)){
        $firstname = htmlentities($data['firstname']);
        $lastname = htmlentities($data['lastname']);
        $mail = htmlentities($data['user_mail']);
        $message = htmlentities($data['user_message']);
        header('Location: success.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0' />
        <title>My green city</title>
        <link href="https://fonts.googleapis.com/css?family=Satisfy&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="style.css">
    </head>

    <body>

    <?php include("header.php"); ?>

    <?php include("actions.php"); ?>

    <div class="background">
        <h2 id="associations">Associations</h2>

        <?php if(!empty($_GET['delete'])): ?>
            <div class="errorIndication">L'association a bien été supprimée.</div>
        <?php endif;  ?>

        <section class="actions">
            <?php foreach ($associations as $association): ?>
                <figure>
                    <a href="associations.php?id= <?= $association['id'] ?>">
                        <img class="imageVignette" src=" <?= $association['image']; ?> " alt=" <?= htmlentities($association['imageDescription']); ?> ">
                    </a>
                    <figcaption><a href="associations.php?id= <?= $association['id'] ?>"> <?= htmlentities($association['name']) ?> </a></figcaption>
                </figure>
            <?php endforeach ?>
        </section>
        <button class="btn-add"><a href="addAssociation.php" link="Ajouter une association">Ajouter une association</a></button>
    </div>


        <section class="gestion">

            <h2 id="gestion">Gestion des déchets</h2>

                <h3>Conseils</h3>

                <div class="conseils">

                    <article><img src="img/imgConseil.jpg" alt="dechets" class="imgConseil"></article>

                    <article class="textConseil" >
                        <p class="textSizeMore"><strong>522 kg jetés, 47 kg triés</strong></p>
                        <p class="textSizeMore">Afin de réduire les déchets que nous produisons et leur impact sur notre environnement,
                            Orléans Métropole propose des gestes simples pour recycler davantage et consommer autrement.</p>
                        <p>Choisir des produits peu ou pas emballés, choisir des produits avec des labels environnement,
                            adopter les sacs réutilisables (cabas, paniers) et refuser les sacs jetables,
                            coller un autocollant STOP PUB sur sa boîte aux lettres, limiter ses impressions,
                            limiter sa consommation de piles et utiliser des piles rechargeables ... </p>

                    </article>

                </div>

                <h3>Points de collecte</h3>
                <div class="collecte">

                    <article class="textCollecte" >
                        <details>
                            <summary>Déchetterie Est</summary>
                            Chécy : Parc d’activités de la Guignardière, rue Pierre et Marie Curie.
                        </details> 

                        <details> 
                            <summary>Déchetterie Ouest</summary>
                            Ingré : Chemin de la Vallée de l’Azin.
                        </details>

                        <details>
                            <summary>Déchetterie Sud Ouest</summary>
                            Orléans : Chemin du Clos de l’Alouette, 33 rue Hatton.
                        </details>

                        <details>
                            <summary>Déchetterie Sud Est</summary>
                            Saint Cyr en Val : Avenue du parc Floral.
                        </details>

                        <details>
                            <summary>Déchetterie Nord Est</summary>
                            Saint Jean de Braye - Parc Archimède, rue de la Burelle.
                        </details>

                        <details>
                            <summary>Déchetterie Nord</summary>
                            Saran - Zone d’activités de Montaran, rue Marcel Paul.
                        </details>
                    </article>

                    <article><img src="img/mapscollecte.png" class="mapsCollecte" alt="localiser un point de collecte"></article>

                 </div>

        </section>

<?php include("formulaire.php"); ?>
<?php include("footer.php"); ?>

      </body>
</html>
