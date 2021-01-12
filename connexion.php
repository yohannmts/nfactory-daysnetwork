<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=network_days', "root", "",);
require('../src/inc/functions.php');

if (isLogged()) {
  header('Location: ./dashboard.php');
  die('ok');
}


// CODE RECUPERER DE BOOKINATION

if (!empty($_POST['submit'])) {

  $mail = checkXss($_POST['mail']);
  $password = checkXss($_POST['password']);

  $errors = checkEmail($errors, $mail, 'mail');
  $errors = checkField($errors, $mail, 'mail', 6, 160);
  $errors = checkField($errors, $password, 'password', 6, 200);

  $user = select($pdo, 'membres', '*', 'mail', $mail);

  if (count($errors) == 0) {
      if (!empty($user)) {
          if (password_verify($password, $user['password'])) {
              $_SESSION['user'] = [
                  'id'     => $user['id'],
                  'mail' => $user['mail'],
                  'firstname' => $user['firstname'],
                  'lastname' => $user['lastname'],
                  'birthdate' => $user['birthdate'],
                  'gender' => $user['gender'],
                  'role'   => $user['role'],
                  'ip'     => $_SERVER['REMOTE_ADDR']
              ];
              header('Location: ./dashboard.php');
              die();
          } else {
              $errors['password'] = 'Mot de passe incorrect';
          }
      } else {
          $_SESSION['visitor'] = [
              'mail' => $mail
          ];
          header('Location: ./connexion.php');
          die();
      }
  }
}
// FIN DE CODE RR DE BOOKINATION


if(isset($_POST['formconnexion']))
{
  $mailconnect = htmlspecialchars($_POST['mailconnect']);
  $mdpconnect = sha1($_POST['mdpconnect']);
  if(!empty($mailconnect) AND !empty($mdpconnect))
  {
    $requser = $pdo->prepare("SELECT * FROM nd_users WHERE mail = ? AND mdp = ? ");
    $requser ->execute(array($mailconnect, $mdpconnect));
    $userexist = $requser -> rowCount();
    if($userexist == 1)
    {
      $userinfo = $requser->fetch();
      $_SESSION['id'] = $userinfo['id'];
      $_SESSION['pseudo'] = $userinfo['pseudo'];
      $_SESSION['mail'] = $userinfo['mail'];
      header("Location: profile.php?id=".$_SESSION['id']);
    }
    else
    {
      $erreur = "Mauvais mail ou mot de passe";
    }
  }
    else
  {
    $erreur = "Tous les champs doivent être complétés";
  }
}

?>


<html>

<head>
    <meta charset="UTF-8">
</head>

<body>
    <div align="center">
        <h2>Connexion</h2>
        <br /><br />

        <form method="POST" action="">
           <input type="email" name="mailconnect" placeholder="Mail">
           <input type="password" name="mdpconnect" placeholder="Mot de passe">
           <input type="submit" name="formconnexion" value="Se connecter">
           <input type="submit" name="mdp-oublié" value="Mot de passe oublier">
          </form>
        <?php 
        if(isset($erreur))
        {
            echo '<font color="red">'.$erreur."</font>";
        }
        
        ?>
    </div>
</body>

</html>