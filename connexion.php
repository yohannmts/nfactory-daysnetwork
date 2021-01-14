<?php
require('./src/inc/pdo.php');
require('./src/inc/functions.php');

$errors = [];

session_start();
 
 
 $title = 'Accueil';
include('src/template/header.php');

?>
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
                     <input type="submit" class="connect btn btn-success" name="submit" value="Se connecter">
                  </form>
               </div>
               <div class="forgotpw">
                  <a href="./forgotpassword.php" class="forgot-password">Mot de passe oublié ? Cliquez ici<br><br></a>
               </div>
            </div>
         </div>
      </div>