<?php
require('/src/inc/functions.php');
require('/src/inc/pdo.php');

$title = 'Tableau de bord';
session_start();
if (isLogged()) {
    $user = $_SESSION['network_days']['user'];
} else {
    // header('Location: ./../error.php?e=403');
    die();
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> - network_days</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;1,100;1,300;1,400;1,500;1,700&display=swap">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css">
    <link rel="stylesheet" href="./../assets/css/style.css">
    <link rel="stylesheet" href="./../assets/css/dashboard.css">
</head>

<body style="color: var(--white);background-color: var(--blue-primary);">
    <div class="grid-wrapper">
        <div class="container grid">
            <div class="grid-line"></div>
            <div class="grid-line"></div>
        </div>
    </div>
    <header id="header">
        <nav class="navbar">
            <div class="container">
                <a href="./../"><img class="nav-logo" src="../assets/img/logo/logo-white-bg-none.png" alt="Logo Netron"></a>
                <p>Bonjour, <b><span role="firstname"><?= $user['firstname'] ?></span> <span role="lastname"><?= $user['lastname'] ?></span> <a href="#" title="Se déconnecter" style="vertical-align: middle;" role="btn-logout"></b><i class="ri-logout-circle-r-fill"></i></a></p>
            </div>
        </nav>
    </header>
    <section id="dashboard">
        <div class="container">
            <div class=" cards-container">
                <div class="cards-row">
                    <div class="cards-item cards-charts">
                        <canvas id="charts" width="400" height="150"></canvas>
                    </div>
                    <div class="cards-item cards-profile">
                        <form class="form-profile" action="./../api/users/edit.php" method="POST">
                            <input type="text" name="firstname" placeholder="Votre prénom" value="<?= $user['firstname'] ?>" onkeyup="firstnameInputHandler(this.value)" onkeypress="firstnameInputHandler(this.value)">
                            <input type="text" name="lastname" placeholder="Votre nom" value="<?= $user['lastname'] ?>" onkeyup="lastnameInputHandler(this.value)" onkeypress="lastnameInputHandler(this.value)">
                            <input type="email" name="mail" placeholder="Votre email" value="<?= $user['mail'] ?>">
                            <a class="profile-edit-password" href="./../forgot_password.php">Modifier le mot de passe</a>
                            <button type="submit" class="btn btn-blue-primary" role="btn-profile-save">Sauvegarder
                                <svg class="btn-arrow" width="10" height="10" viewBox="0 0 10 10" aria-hidden="true">
                                    <g fill-rule="evenodd">
                                        <path class="btn-arrow-line" d="M0 5h7"></path>
                                        <path class="btn-arrow-tip" d="M1 1l4 4-4 4"></path>
                                    </g>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="cards-item cards-logs">
                    <table id="table-logs">
                        <tr>
                            <th>#</th>
                            <th>user mail</th>
                            <th>date</th>
                            <th>version</th>
                            <th colspan="2">header</th>
                            <th>service</th>
                            <th>identification</th>
                            <th>flags code</th>
                            <th>ttl</th>
                            <th colspan="5">protocol</th>
                            <th colspan="2">ip</th>
                        </tr>
                        <tr>
                            <th colspan="4"></th>
                            <th>length</th>
                            <th>checksum</th>
                            <th colspan="4"></th>
                            <th>name</th>
                            <th colspan="2">checksum</th>
                            <th colspan="2">ports</th>
                            <th>from</th>
                            <th>dest</th>
                        </tr>
                        <tr>
                            <th colspan="11"></th>
                            <th>code</th>
                            <th>status</th>
                            <th>from</th>
                            <th>dest</th>
                            <th colspan="2"></th>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
    <script src="./../asset/js/dashboard.js"></script>
</body>