<?php include("dataPHP.php"); ?>


<h2 id="actions">Actions</h2>

<section class="actions">


    <?php foreach ($actions as $action => $infoActions){ ?>
        <figure>
            <a href="<?= $infoActions['urlAction'] ?>">
                <img class="imageVignette" src=" <?= $infoActions['imageAction']; ?> " alt=" <?= $infoActions['imageDescription']; ?> ">
            </a>
            <figcaption><a href="<?= $infoActions['urlAction'] ?>"> <?php echo $action ?> </a></figcaption>
        </figure>
    <?php } ?>


</section>