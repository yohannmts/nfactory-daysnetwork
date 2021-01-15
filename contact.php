<?php
require('src/inc/pdo.php');
require('src/inc/functions.php');

session_start();

$errors = [];
$sent = false;


if (!empty($_POST['submit'])) {

    $firstname = checkXss($_POST['firstname']);
    $lastname = checkXss($_POST['lastname']);
    $mail = checkXss($_POST['mail']);
    $subject = checkXss($_POST['subject']);
    $message = checkXss($_POST['message']);


    $errors = checkField($errors, $firstname, 'firstname', 2, 150);
    $errors = checkField($errors, $lastname, 'lastname', 2, 150);
    $errors = checkEmail($errors, $mail, 'mail');
    $errors = checkField($errors, $mail, 'mail', 6, 200);
    $errors = checkField($errors, $subject, 'subject', 2, 200);
    $errors = checkField($errors, $message, 'message', 5, 2000);


    if (count($errors) == 0) {
        insert($pdo, 'nd_contact', ['firstname',  'lastname',  'mail', 'subject', 'message', 'created_at'], [$mail, $firstname, $lastname, $subject, $message, now()]);
        $sent = true;
        redirectTempo(5, 'index.php');
    }

}

$title = 'Contact';

include('src/template/header.php'); ?>

<div class="fond_gradient">
    <div class="container">
        <div class="row">
            <div id="contact_page" class="col-sm-6 fond_dark_blue blanc aos-init aos-animate" data-aos="fade-right" data-aos-once="true" data-aos-offset="300" data-aos-easing="ease-in-sine">
                <div id="contactp" class="padding-05v"></div>
                <h1>Network Days, partenaire de proximité des entreprises et collectivités en Seine-Maritime pour leurs solutions informatiques.<br>
                    Contactez-nous !</h1><br><br><br>
                <div class="field field-name-body field-type-text-with-summary field-label-hidden">
                    <div class="field-items">
                        <div class="contactnum field-item even" property="content:encoded">
                            <h2>
                                Support technique<br>
                                un numéro unique pour nous joindre : </h2>
                            <a href="tel:+33123456789">01 23 45 67 89</a><br>
                            Du lundi au dimanche, 24h/24h<br>
                            <br>
                        </div>
                    </div>
                </div> <br>
            </div>


            <!-- formulaire de contact -->
            <div id="contact_form" class="col-sm-6 fond_gris aos-init aos-animate" data-aos="fade-left" data-aos-once="true" data-aos-offset="300" data-aos-easing="ease-in-sine">
                <form class="webform-client-form webform-client-form-5" action="" method="post" id="webform-client-form-5" accept-charset="UTF-8">
                    <div>
                        <div id="requis" class="formcontact row no-padding text-center">
                            <div class="col-sm-12 no-padding">
                                <div  class="champsrequis padding-03">
                                  Les champs marqués d'une * sont requis.
                                </div>
                            </div>
                        </div>

                        <div class="row no-padding">
                            <div class="col-xs-12 no-padding">
                                <div class="padding-03">
                                    <div class="form-item webform-component webform-component-textfield webform-component--nom form-group form-item form-item-submitted-nom form-type-textfield form-group"> <label class="control-label" for="edit-submitted-nom">Nom<span class="form-required" title="Ce champ est requis.">*</span></label>
                                        <input required="" class="form-control form-text required" type="text" id="edit-submitted-nom" name="lastname" size="128" maxlength="128" value="<?php if (!empty($_POST['lastname'])) echo $_POST['lastname'];
                                                                                                                                                                                            elseif (!empty($_SESSION['user']['lastname'])) echo $_SESSION['user']['lastname']; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 no-padding">
                                <div class="padding-03">
                                    <div class="form-item webform-component webform-component-textfield webform-component--prenom form-group form-item form-item-submitted-prenom form-type-textfield form-group"> <label class="control-label" for="edit-submitted-prenom">Prénom* </label>
                                        <input class="form-control form-text" type="text" id="edit-submitted-prenom" name="firstname" size="60" maxlength="128" value="<?php if (!empty($_POST['firstname'])) echo $_POST['firstname'];
                                                                                                                                                                        elseif (!empty($_SESSION['user']['firstname'])) echo $_SESSION['user']['firstname']; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 no-padding">
                                <div class="padding-03">
                                    <div class="form-item webform-component webform-component-textfield webform-component--mail form-group form-item form-item-submitted-mail form-type-textfield form-group"> <label class="control-label" for="edit-submitted-mail">Mail*</label>
                                        <input class="form-control form-text" type="text" id="edit-submitted-mail" name="mail" size="60" maxlength="150" value="<?php if (!empty($_POST['mail'])) echo $_POST['mail'];
                                                                                                                                                                elseif (!empty($_SESSION['user']['mail'])) echo $_SESSION['user']['mail'];
                                                                                                                                                                elseif (!empty($_SESSION['visitor']['mail'])) echo $_SESSION['visitor']['mail']                                                                                                                                            ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 no-padding">
                                <div class="padding-03">
                                    <div class="form-item webform-component webform-component-sujet webform-component--sujet form-group form-item form-item-submitted-sujet form-type-webform-sujet form-group"> <label class="control-label" for="edit-submitted-sujet">Le sujet de votre demande<span class="form-required" title="Ce champ est requis.">*</span></label>
                                        <input required="" class="sujet form-control form-text form-sujet required" type="text" id="edit-submitted-sujet" name="subject" size="100" value="<?= (!empty($_POST['subject'])) ? $_POST['subject'] : '' ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 no-padding">
                                <div class="padding-03">
                                    <div class="form-item webform-component webform-component-textarea webform-component--message form-group form-item form-item-submitted-message form-type-textarea form-group"> <label class="control-label" for="edit-submitted-message">Votre message<span class="form-required" title="Ce champ est requis.">*</span></label>
                                        <div class="form-textarea-wrapper"><textarea required="required" class="form-control form-textarea required" id="edit-submitted-message" name="message" cols="60" rows="5"><?= (!empty($_POST['message'])) ? $_POST['message'] : '' ?></textarea></div>
                                    </div>
                                </div>
                            </div>
                            <div>

                            </div>
                        </div>

                        <div class="row no-padding text-justify">
                            <div class="col-sm-12 no-padding">
                                <div class="legaldata" padding-03">
                                    <!-- Informations légales -->
                                    <small>
                                        Les informations recueillies sur ce formulaire sont enregistrées et transmises à <strong>Network Days</strong>.

                                        <p>
                                            Elles sont conservées pendant 120 jours sur le site web en cas de problèmes techniques et sont destinées aux ressources humaines.
                                        </p>

                                        <p>
                                            Conformément à la <a href="https://www.cnil.fr/fr/loi-78-17-du-6-janvier-1978-modifiee" target="_blank">loi « informatique et libertés »</a>, vous pouvez exercer votre droit d'accès aux données vous concernant et les faire rectifier en contactant :<br><br>
                                            <strong>Network Days</strong><br>
                                            76 boulevard Jeanne d'Arc la pucelle<br>
                                            76000 ROUEN
                                        </p>
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if ($sent == false ) : ?>
                        <input type="submit" name="submit" class="submitcontact btn btn-purple" value="Envoyer">
                    <?php else :   ?>
                        <input style="background-color: var(--pink); border-radius: 6px; padding: 10px 15px;
" type="submit" class="submitsuccess btn btn-success" value="Bien reçu ! Vous allez être redirigé vers la page d'accueil" disabled>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
include('src/template/footer.php');
