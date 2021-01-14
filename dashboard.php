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

// Informations de la session en cours
// print_r($_SESSION['user'])
// 
?>

<form action="" method="POST">
    <div class="text-center">
        <button class="btn btn-danger" type="submit" name="logout" value="1">Se déconnecter</button>
    </div>
</form>
<br><br><hr>

<table class="trame-tableau">
    <th>
        <tr>
            <div class="data text-dark "></div>

        </tr>
    </th>
</table>

<br><br>


<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="./asset/js/dashboard.js"></script>
<?php include('src/template/footer.php');
