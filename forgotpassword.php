<?php
require('src/inc/pdo.php');
require('src/inc/functions.php');

session_start();

$errors = [];

if (!empty($_GET['mail']) && !empty($_GET['token']) && filter_var($_GET['mail'], FILTER_VALIDATE_EMAIL)) {
    $mail = checkXss($_GET['mail']);
    $token = checkXss($_GET['token']);

    $user = select($pdo, 'nd_users', '*', 'mail', $mail);
    if (!empty($user) && $user['token'] == $token) {
        if (!empty($_POST['submit'])) {
            $password = checkXss($_POST['password']);
            $passwordConfirm = checkXss($_POST['password-confirm']);

            $errors = checkField($errors, $password, 'password', 6, 200);
            $errors = checkField($errors, $passwordConfirm, 'password-confirm', 6, 200);

            if ($password != $passwordConfirm) $errors['password-confirm'] == 'Les mots de passes ne sont pas identiques';

            if (count($errors) == 0) {
                $passwordHashed = password_hash($password, PASSWORD_BCRYPT);
                $token = generateRandomString(200);

                update($pdo, 'nd_users', [
                    'password = "' . $passwordHashed . '"',
                    'token = "' . $token . '"'
                ], 'id', $user['id']);
                $user = select($pdo, 'nd_users', '*', 'id', $user['id']);
                header('Location: ./index.php');
                die();
            }
        }
    } else {
        header('Location: ./error.php');
        die();
    }
} else {
    header('Location: ./error.php');
    die();
}

$title = 'Changement de mot de passe';
include('src/template/header.php');
?>

<section id="recovery_password">
    <div class="wrap-fluid">
        <div class="recovery-form" id="recovery-form">
            <form action="" method="POST">
                <input type="password" name="password" placeholder="Nouveau mot de passe" value="<?= (!empty($_POST['password'])) ? $_POST['password'] : '' ?>">
                <input type="password" name="password-confirm" placeholder="Confirmation du mot de passe" value="<?= (!empty($_POST['password-confirm'])) ? $_POST['password-confirm'] : '' ?>">
                <input type="submit" name="submit" class="btn btn-purple" value="Envoyer">
            </form>
        </div>
</section>

<?php include('src/template/footer.php');