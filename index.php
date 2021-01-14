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
            delete($pdo, 'nd_logs', 'user_id', $user['id']);
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
         header('Location: ./faq.php');
         die();
      }
   }
}


if (!empty($_POST['submit'])) {
   $firstname = checkXss($_POST['firstname']);
   $lastname = checkXss($_POST['lastname']);
   $mail = checkXss($_POST['mail']);
   $password = checkXss($_POST['password']);
   $passwordConfirm = checkXss($_POST['password-confirm']);

   $errors = checkField($errors, $firstname, 'firstname', 2, 150);
   $errors = checkField($errors, $lastname, 'lastname', 2, 150);
   $errors = checkEmail($errors, $mail, 'mail');
   $errors = checkField($errors, $mail, 'mail', 6, 200);
   $errors = checkField($errors, $password, 'password', 6, 250);
   $errors = checkField($errors, $passwordConfirm, 'password-confirm', 6, 250);

   if ($password != $passwordConfirm) $errors['password-confirm'] == 'Les mots de passes ne sont pas identiques';

   if (count($errors) == 0) {
       $passwordHashed = password_hash($password, PASSWORD_BCRYPT);
       $token = generateRandomString(200);

       $checkUsedToken = select($pdo, 'nd_users', 'token', 'token', $token);
       if ($token == $checkUsedToken) {
           while ($token == $checkUsedToken) {
               $token = generateRandomString(200);
               $checkUsedToken = select($pdo, 'nd_users', 'token', 'token', $token);
           }
       }

       $checkUsedEmail = select($pdo, 'nd_users', 'mail', 'mail', $mail);
       if (empty($checkUsedEmail)) {
           insert(
               $pdo,
               'nd_users',
               [
                   'mail',
                   'firstname',
                   'lastname',
                   'password',
                   'token',
                   'created_at',
                   'updated_at',
                   'role'
               ],
               [
                   $mail,
                   $firstname,
                   $lastname,
                   $passwordHashed,
                   $token,
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
           header('Location: ./index.php');
           // TODO: Auto Login
       }
       die();
   }
}




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
         <button id="btnclick" type="submit"  class="btn btn-success btn-lg" data-toggle="modal" data-target="#myModal">Se connecter</button>
      <?php endif; ?>
      <!-- Modal connexion -->
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
                     <input  type="email" onclick="getValue('mail')" name="mail" placeholder="Votre email" value="<?= (!empty($_POST['mail'])) ? $_POST['mail'] : '' ?>">
                     <br>
                     <label> Votre mot de passe</label>
                     <input type="password" onclick="getValue('password')" name="password" placeholder="Votre mot de passe" value="<?= (!empty($_POST['password'])) ? $_POST['password'] : '' ?>">
                     <br>
                     <input  type="submit" id="boutton" class="btn btn-success" name="submit" value="Se connecter"  onclick="controle('connecter')">
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>

<!-- buttons login -->
<div class="container" align='center'>
   <?php if (isLogged()) : ?>
      <br>
      <form action="" method="POST">
         <button type="submit" name="logout" value="1" class="btn btn-danger">Se déconnecter</button>
         <a href="./dashboard.php" class="btn btn-primary">Dashboard</a>
      </form>
   <?php else : ?>
      <button type="button" class="connectt btn btn-success btn-lg" data-toggle="modal" data-target="#myModal">Débuter l'aventure avec nous !</button>
   <?php endif; ?>

   <!-- Modal connexion -->

   <div class="modal fade" id="myModal" role="dialog">
      <div class="modal-dialog">
         <!-- Modal content-->
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
               <form id="credentials" method="POST" action="">
                  <label> Votre email</label>
                  <input type="email" name="mail" placeholder="Votre email" value="<?= (!empty($_POST['mail'])) ? $_POST['mail'] : '' ?>">
                  <br>
                  <br>
                  <label> Votre mot de passe</label>
                  <input type="password" name="password" placeholder="Votre mot de passe" value="<?= (!empty($_POST['password'])) ? $_POST['password'] : '' ?>">
                  <br>
                  <br>
                  <input type="submit" class="connect1 btn btn-success" name="submit" value="Se connecter">
               </form>
            </div>
            <div class="forgotpw">
               <a href="./forgotpassword.php" class="forgot-password">Mot de passe oublié ? Cliquez ici<br><br></a>
            </div>
            <div id="popup_name" class="popup_block">
     <div align="center">
        <h2></h2>
        <br /><br />

<hr>
     
        <form class="forminscr" method="POST" action="">
            <table>
                <tr>
                    <td align="right">
                        <label for="nom">Nom </label>
                    </td>
                    <td>
                        <input type="text" placeholder="Votre nom" id="nom" name="lastname" value="<?php if(isset($nom)) {echo $nom; } ?>">
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        <label for="prénom">Prénom </label>
                    </td>
                    <td>
                        <input type="text" placeholder="Votre prénom" id="prénom" name="firstname" value="<?php if(isset($prénom)) {echo $prénom; } ?>">
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        <label for="mail">Mail </label>
                    </td>
                    <td align="right">
                        <input type="email" placeholder="Votre Mail" id="mail" name="mail"  value="<?php if(isset($mail)) {echo $mail; } ?>">
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        <label for="mail2">Confirmartion Mail </label>
                    </td>
                    <td>
                        <input type="email" placeholder="Confirmer adresse Mail" id="mail2" name="mail2" value="<?php if(isset($mail2)) {echo $mail2; } ?>" >
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        <label for="mdp">Mot de passe </label>
                    </td>
                    <td>
                        <input type="password" placeholder="Votre mot de passe" id="mdp" name="password">
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        <label for="mdp2">Confirmer votre mot de passe             </label>
                    </td>
                    <td>
                        <input type="password" placeholder="Votre mot de passe" id="mdp2" name="password-confirm">
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td align="center">
                        <br />
                        <input type="submit" class="connect2 btn btn-success" name="submit" value="S'inscrire">

                    </td>
                </tr>
            </table>
        </form>
        <hr>
        <?php 
        if(isset($erreur))
        {
            echo '<font color="red">'.$erreur."</font>";
        }
        ?>
    </div>
</div>
         </div>
      </div>
   </div>
</div>


<!-- Bouton execution modal -->
<!-- <div class="registerbutton">
   <button class="connect btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
      S'inscrire
   </button>
</div> -->



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

   <?php include('src/template/footer.php');
