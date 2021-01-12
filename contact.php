<?php
require('src/inc/pdo.php');
require('src/inc/functions.php');

session_start();

$errors = [];
$sent = false;

if (!empty($_POST['submit'])) {

    $mail = checkXss($_POST['mail']);
    $firstname = checkXss($_POST['firstname']);
    $lastname = checkXss($_POST['lastname']);
    $subject = checkXss($_POST['subject']);
    $message = checkXss($_POST['message']);

    $errors = checkEmail($errors, $mail, 'mail');
    $errors = checkField($errors, $mail, 'mail', 6, 160);
    $errors = checkField($errors, $firstname, 'firstname', 2, 100);
    $errors = checkField($errors, $lastname, 'lastname', 2, 100);
    $errors = checkField($errors, $subject, 'subject', 10, 250);
    $errors = checkField($errors, $message, 'message', 10, 2000);

    if (count($errors) == 0) {
        insert($pdo, 'nd_contact', ['mail', 'firstname',  'lastname',  'subject', 'message', 'created_at'], [$mail, $firstname, $lastname, $subject, $message, now()]);
        $sent = true;
    }
}

$title = 'Contact - Network Days';
include('src/template/header.php');
?>
<section id="contact">
    <div class="wrap-fluid">
        <div class="contact-form">
            <form action="" method="POST">

                <div class="inputs-container">
                    <input type="mail" name="mail" placeholder="Votre mail" value="<?php if (!empty($_POST['mail'])) echo $_POST['mail'];
                                                                                    elseif (!empty($_SESSION['user']['mail'])) echo $_SESSION['user']['mail'];
                                                                                    elseif (!empty($_SESSION['visitor']['mail'])) echo $_SESSION['visitor']['mail'];
                                                                                     ?>">
                    <input type="text" name="firstname" placeholder="Votre prénom" value="<?php if (!empty($_POST['firstname'])) echo $_POST['firstname'];
                                                                                            elseif (!empty($_SESSION['user']['firstname'])) echo $_SESSION['user']['firstname']; ?>">
                </div>
                <div class="inputs-container">
                    <input type="text" name="lastname" placeholder="Votre nom" value="<?php if (!empty($_POST['lastname'])) echo $_POST['lastname'];
                                                                                        elseif (!empty($_SESSION['user']['lastname'])) echo $_SESSION['user']['lastname']; ?>">
                    <input type="text" name="subject" placeholder="Votre motif" value="<?= (!empty($_POST['subject'])) ? $_POST['subject'] : '' ?>">
                </div>
                <textarea name="message" placeholder="Votre message"><?= (!empty($_POST['message'])) ? $_POST['message'] : '' ?></textarea>
                <?php if ($sent == false) : ?>
                    <input type="submit" name="submit" class="btn btn-purple" value="Envoyer">
                <?php else : ?>
                    <input type="submit" class="btn btn-success" value="Bien reçu !" disabled>
                <?php endif; ?>
            </form>
        </div>
        <!-- <div class="contact-image">
            <img src="" alt="Image de contact">
        </div> -->
    </div>
</section>

<?php include('src/template/footer.php');