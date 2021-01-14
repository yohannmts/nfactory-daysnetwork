<?php
require('src/inc/pdo.php');
require('src/inc/functions.php');

session_start();

$error = 404;
if (!empty($_GET['e']) && is_numeric($_GET['e']) && $_GET['e'] >= 400 && $_GET['e'] <= 527) $error = $_GET['e'];
$message;
switch ($error) {
    case 403:
        $message = 'Accès refusé';
        break;
    case 400:
        $message = 'Syntaxe erronnée';
        break;
    default:
        $message = 'Ressource non trouvée';
        break;
}
$title = ' Erreur ' . $error . ' - NetworkDays';
include('src/template/header.php');
?>
<section id="error">
    <div class="wrap-fluid">
        <div class="error-text">
            <h1>Erreur <?= $error ?></h1>
            <p><?= $message ?></p>
        </div>
<<<<<<< HEAD
        <!-- <div class="error-image">
            <img src="asset/img/errors.gif" alt="erreur">
        </div> -->
=======
        <div class="error-image">
            <img src="asset/img/errors.gif" alt="erreur">
        </div>
>>>>>>> 1d4bebb343a486c6f272523ec692f8e5e60f630f
    </div>
</section>
<?php
include('src/template/footer.php');