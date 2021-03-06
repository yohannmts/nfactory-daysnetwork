<?php
require('./src/inc/pdo.php');
require('./src/inc/functions.php');

$title = 'Accueil';
include('src/template/header.php');

session_start();

if (isLogged()) {
    $user = $_SESSION['user'];
} else {
    header('Location: ./error.php?e=403');
    die();
}
if (!empty($_POST['logout'])) logout();

//Informations de la session en cours
// print_r($_SESSION['user'])
?>

<h3 class="text-center mt-3 mb-3">Bienvenue dans votre espace administration <?php echo $_SESSION['user']['firstname'] ?> </h3>
<p class="text-center text-dark mb-3"> Aide : Cliquez sur le bouton voir les graphiques pour les afficher ou les cacher</p>
<p class="text-center text-dark mb-3"> Aide : Cliquez sur le bouton voir les trames pour les afficher ou les cacher</p>
<form action="" method="POST">
    <div class="text-center">

        <button type="submit" name="logout" value="1" class="btn btn-danger mt-2 mb-2">Se déconnecter</button>
    </div>
</form>
<center>
    <button id="b1" class="btn btn-primary btnrose" href="#">Voir les graphiques</button>
</center>
<center>
    <button id="b2" class="btn btn-primary btnrose mt-2 mb-2" href="#">Voir les trames</button>
</center>
<div class="container-fluid">
    <div class="acacher" id="acacher">
        <div class="row" style="background-color:#17202A;">
            <div class="col mt-3">
                <h3 class="titrepage"> Les graphiques </h3>
            </div>
            <canvas id="graph1" width="400" height="100" class="">
            </canvas>
            <canvas id="graph2" width="400" height="100">
            </canvas>
            <canvas id="graph3" width="400" height="100">
            </canvas>
        </div>
    </div>
    <div class="row mt-3"><span></span></div>

    <div class="acacher" id="acacher2">
        <div class="row data d-flex flex-column text-center" style="background-color:#17202A;">
            <div class="col mt-3">
                <h3 class="titrepage"> Les trames </h3>
            </div>
        </div>
    </div>
</div>

<div class="row mt-3"><span></span></div>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>

<script src="./asset/js/dashboard.js"></script>
<?php include('src/template/footer.php');
