<?php
require('./src/inc/pdo.php');
require('./src/inc/functions.php');

$errors = [];

session_start();

if (!empty($_POST['submit'])) {
   $mail = checkXss($_POST['mail']);
   $password = checkXss($_POST['password']);

   $errors = checkEmail($errors, $mail, 'mail');
   $errors = checkField($errors, $mail, 'mail', 6, 160);
   $errors = checkField($errors, $password, 'password', 6, 200);

   $user = select($pdo, 'nd_users', '*', 'mail', $mail);
   if (count($errors) == 0) {
      if (!empty($user)) {
         if (password_verify($password, $user['password'])) {
            $file = file_get_contents('https://floriandoyen.fr/resources/frames.php');
            $json = json_decode($file, true);
            $_SESSION['user'] = [
               'id'     => $user['id'],
               'mail' => $user['mail'],
               'firstname' => $user['firstname'],
               'lastname' => $user['lastname'],
               'role'   => $user['role'],
               'ip'     => $_SERVER['REMOTE_ADDR']
            ];
            insert(
               $pdo,
               'nd_logs',
               [
                  'user_id',
                  'data',
                  'created_at',
                  'updated_at'
               ],
               [
                  $user['id'],
                  json_encode($json),
                  now(),
                  now()
               ]
            );
            header('Location: ./dashboard.php');
            die();
         } else {
            $errors['password'] = 'Mot de passe incorrect';
         }
      } else {
         header('Location: ./inscription.php');
         die();
      }
   }
}

if (!empty($_POST['logout'])) logout();

$title = 'Accueil';
include('src/template/header.php');
?>

<!-- carousel -->
<div class="carousel slide" data-ride="carousel" id="carouselExampleIndicators">
   
   <div class="carousel-inner">
      <div class="carousel-item active">
         <img alt="First slide" class="d-block w-100" style="width: 1000px;height: 500px;" src="asset/img/font-reseaux.jpg">
         <div class="carousel-caption d-none d-md-block">
         </div>
      </div>
      <div class="carousel-item">
         <img alt="Second slide" class="d-block w-100" style="width: 1000px;height: 500px;" src="asset/img/base-bleu.png">
         <div class="carousel-caption d-none d-md-block">
         </div>
      </div>

      <a class="carousel-control-next" data-slide="next" href="#carouselExampleIndicators" role="button"><span aria-hidden="true" class="carousel-control-next-icon"></span> <span class="sr-only">Next</span></a>
   </div>
   <div class="container" align='center'>
      <?php if (isLogged()) : ?>
         <br>
         <form action="" method="POST">
            <button type="submit" name="logout" value="1" class="btn btn-danger">Se déconnecter</button>
            <a href="./dashboard.php" class="btn btn-primary">Dashboard</a>
         </form>
      <?php else : ?>
         <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#myModal">Se connecter</button>
      <?php endif; ?>
      <!-- Modal -->
      <div class="modal fade" id="myModal" role="dialog">
         <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Connexion</h4>
               </div>
               <div class="modal-body">
                  <form id="credentials" method="POST" action="">
                     <label> Votre email</label>
                     <input type="email" name="mail" placeholder="Votre email" value="<?= (!empty($_POST['mail'])) ? $_POST['mail'] : '' ?>">
                     <br>
                     <label> Votre mot de passe</label>
                     <input type="password" name="password" placeholder="Votre mot de passe" value="<?= (!empty($_POST['password'])) ? $_POST['password'] : '' ?>">
                     <br>
                     <input type="submit" class="btn btn-success" name="submit" value="Login">
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>


   <?php include('src/template/footer.php');
