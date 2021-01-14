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

<form action="" method="POST">
    <div class="text-center">
        <button type="submit" name="logout" value="1" class="btn btn-danger">Se déconnecter</button>
    </div>
</form>
    <canvas id="chart-area" height="90%" class="color-graphique" style="background-color: white"></canvas><br>
    



<div class="data text-dark bg-secondary
"></div>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>

<script src="./asset/js/dashboard.js"></script>
<?php include('src/template/footer.php');
