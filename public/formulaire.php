<form action="index.php#form" method="POST" class="background" id="form">

    <h2>Contact</h2>

    <ul>

    <li>
        <label for="firstname">Prénom *</label>
        <input type="text" id="firstname" name="firstname" placeholder="Jean" value="<?php if(isset($_POST['firstname'])) { echo $_POST['firstname'];} ?>">
    </li>
    <span class="errorIndication">
        <?php
            if(!empty($errors['firstname'])){
                foreach ($errors['firstname'] as $error) {
                    echo $error;
                }
            }
        ?>
    </span>


    <li>
        <label for="lastname">Nom *</label>
        <input type="text" id="lastname" name="lastname" placeholder="Dupont" value="<?php if(isset($_POST['lastname'])) { echo $_POST['lastname'];} ?>">
    </li>
    <span class="errorIndication">
        <?php
        if(!empty($errors['lastname'])){
            foreach ($errors['lastname'] as $error) {
                echo $error;
            }
        }
        ?>
    </span>


    <li>
        <label for="mail">Email *</label>
        <input type="email" id="mail" name="user_mail" placeholder="jean@dupont.fr" value="<?php if(isset($_POST['user_mail'])) { echo $_POST['user_mail'];} ?>">
    </li>
    <span class="errorIndication">
        <?php
        if(!empty($errors['user_mail'])){
            foreach ($errors['user_mail'] as $error) {
                echo $error;
            }
        }
        ?>
    </span>


    <li>
        <label for="message">Message</label>
        <textarea id="message" name="user_message"></textarea>
    </li>

    <li class="button">
        <button>Envoyer</button>
    </li>

    </ul>

</form>
