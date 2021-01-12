<?php

$pdo = new PDO('mysql:host=localhost;dbname=reseaux', "root", "",);

if (isset($_POST['forminscription'])) {
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $mail = htmlspecialchars($_POST['mail']);
    $mail2 = htmlspecialchars($_POST['mail2']);
    $mdp = sha1($_POST['mdp']);
    $mdp2 = sha1($_POST['mdp2']);

    if (!empty($_POST['pseudo']) and !empty($_POST['mail']) and !empty($_POST['mail2']) and !empty($_POST['mdp']) and !empty($_POST['mdp2'])) {
        $pseudolength = strlen($pseudo);
        if ($pseudolength <=  255) {
            if ($mail == $mail2) {
                if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                    $requetemail = $pdo->prepare("SELECT * FROM nd_users WHERE mail = ?");
                    $requetemail->execute(array($mail));
                    $mailexist = $requetemail->rowCount();
                    if ($mailexist == 0) {
                        if ($mdp == $mdp2) {
                            $insertmbr = $pdo->prepare("INSERT INTO membres(pseudo, mail, mdp, avatar) VALUES(?, ?, ?, ?)");
                            $insertmbr->execute(array($pseudo, $mail, $mdp, "default.jpg"));
                            $erreur = "Votre compte a bien été créé!  <a href=\"connexion.php\">Me connecter</a>";
                        } else {
                            $erreur = "Vos mots de passe ne sont pas identiques";
                        }
                    } else {
                        $erreur = "Cette adresse est déjà utilisée";
                    }
                } else {
                    $erreur = "Votre adresse mail n'est pas valide";
                }
            } else {
                $erreur = "Vos adresses mails ne correspondent pas";
            }
        } else {
            $erreur = "Votre pseudo ne doit pas dépasser 255 caractères";
        }
    } else {
        $erreur = "Tous les champs doivent être complétés";
    }
}

?>

<html>

<head>
    <meta charset="UTF-8">
</head>

<body>

    <!-- formulaire inscription -->
    <div class="register-form" id="register-form">
        <form action="" method="POST">
            <div class="inputs-container">
                <input type="text" name="lastname" placeholder="Votre nom" value="<?= (!empty($_POST['lastname'])) ? $_POST['lastname'] : '' ?>">
                <input type="text" name="firstname" placeholder="Votre prénom" value="<?= (!empty($_POST['firstname'])) ? $_POST['firstname'] : '' ?>">
            </div>
            <div class="inputs-container">
                <select name="gender">
                    <option value="" disabled <?= (!empty($_POST['gender'])) ? '' : 'selected' ?> hidden>Votre genre</option>
                    <option value="femme" <?= (!empty($_POST['gender']) && $_POST['gender'] == 'femme') ? 'selected' : '' ?>>Femme</option>
                    <option value="homme" <?= (!empty($_POST['gender']) && $_POST['gender'] == 'homme') ? 'selected' : '' ?>>Homme</option>
                    <option value="non-binaire" <?= (!empty($_POST['gender']) && $_POST['gender'] == 'non-binaire') ? 'selected' : '' ?>>Non-binaire</option>
                    <option value="non-specifie" <?= (!empty($_POST['gender']) && $_POST['gender'] == 'non-specifie') ? 'selected' : '' ?>>Non-specifié</option>
                </select>
                <input type="date" name="birthdate" value="<?= (!empty($_POST['birthdate'])) ? $_POST['birthdate'] : '' ?>">
            </div>
            <input type="email" name="mail" placeholder="Votre email" value="<?php if (!empty($_POST['mail'])) echo $_POST['mail'];
                                                                                elseif (!empty($_SESSION['visitor']['mail'])) echo $_SESSION['visitor']['mail']; ?>">
            <div class="inputs-container">
                <input type="password" name="password" placeholder="Votre mot de passe" value="<?= (!empty($_POST['password'])) ? $_POST['password'] : '' ?>">
                <input type="password" name="password-confirm" placeholder="Confirmation du mot de passe" value="<?= (!empty($_POST['password-confirm'])) ? $_POST['password-confirm'] : '' ?>">
            </div>
            <input type="submit" name="submit" class="btn btn-purple" value="S'inscrire">
        </form>
    </div>
    <?php
    if (isset($erreur)) {
        echo '<font color="red">' . $erreur . "</font>";
    }
    ?>
    </div>
</body>

</html>