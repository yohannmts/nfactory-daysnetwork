<?php
require('./src/inc/pdo.php');
require('./src/inc/functions.php');

session_start();

if (isLogged()) {
    header('Location: ./dashboard.php');
    die();
}

$errors = [];

if (!empty($_POST['submit'])) {

    $firstname = checkXss($_POST['firstname']);
    $lastname = checkXss($_POST['lastname']);
    $mail = checkXss($_POST['mail']);
    $password = checkXss($_POST['password']);
    $passwordConfirm = checkXss($_POST['password-confirm']);

    $errors = checkField($errors, $firstname, 'firstname', 2, 80);
    $errors = checkField($errors, $lastname, 'lastname', 2, 80);
    $errors = checkEmail($errors, $mail, 'mail');
    $errors = checkField($errors, $mail, 'mail', 6, 160);
    $errors = checkField($errors, $password, 'password', 6, 200);
    $errors = checkField($errors, $passwordConfirm, 'password-confirm', 6, 200);

    if ($password != $passwordConfirm) $errors['password-confirm'] == 'Les mots de passes ne sont pas identiques';

    if (count($errors) == 0) {
        $passwordHashed = password_hash($password, PASSWORD_BCRYPT);
        $token = generateRandomString(200);

        $checkUsedEmail = select($pdo, 'nd_users', 'mail', 'mail', $mail);
        if (empty($checkUsedEmail)) {
            insert(
                $pdo,
                'nd_users',
                [
                    'mail',
                    'password',
                    'token',
                    'firstname',
                    'lastname',
                    'created_at',
                    'updated_at',
                    'role'
                ],
                [
                    $mail,
                    $passwordHashed,
                    $token,
                    $firstname,
                    $lastname,
                    now(),
                    now(),
                    'user'
                ]
            );
            $user = select($pdo, 'nd_users', '*', 'mail', $mail);
            if (!empty($user)) {
                $_SESSION['user'] = [
                    'id'     => $user['id'],
                    'mail' => $user['mail'],
                    'firstname' => $user['firstname'],
                    'lastname' => $user['lastname'],
                    'role'   => $user['role'],
                    'ip'     => $_SERVER['REMOTE_ADDR']
                ];
            }
            header('Location: ./dashboard.php');
        } else {
            header('Location: ./login.php');
            // TODO: Auto Login
        }
        die();
    }
}
$title = 'Inscription';
include('src/template/header.php');

print_r($errors);
?>
<!-- formulaire inscription -->
<div class="register-form" id="register-form">
    <form action="" method="POST">
        <div class="inputs-container">
            <input type="text" name="lastname" placeholder="Votre nom" value="<?= (!empty($_POST['lastname'])) ? $_POST['lastname'] : '' ?>">
            <input type="text" name="firstname" placeholder="Votre prénom" value="<?= (!empty($_POST['firstname'])) ? $_POST['firstname'] : '' ?>">
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
<?php include('src/template/footer.php');
