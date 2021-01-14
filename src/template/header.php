<!DOCTYPE html>
<html lang="fr">

<head>
  <title><?= $title ?> - NetworkDays</title>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <link href="https://fonts.googleapis.com/css2?family=Merienda&display=swap" rel="stylesheet">
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css" rel="stylesheet">
  <link href="asset/css/style.css" rel="stylesheet">


<body>

  <!--====================== début du header  ================================-->
  <header>
    <!---------------------------- MENU BURGER --------------------------->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
      <div class="container">
     
        <!------------- Début Logo  ----------->
        <img src="asset/img/logo-rose.png" alt="logo-rose">
        <!------------ Fin de logo  ----------->

        <!-------------------------------- Début Navbar --------------------------->
        <!-- Lien ves l'accueil en cliquant sur titre -->
        <a class="navbar-brand text-white" href="./">Network Days</a>
        <!-- Fin de lien  -->

        <!-- Bouton du menu burger en mode responsive -->
        <button aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"
          class="navbar-toggler" data-target="#navbarSupportedContent" data-toggle="collapse" type="button"><span
            class="navbar-toggler-icon "></span></button>
        <!------------- Fin du bouton menu burger  ------->
        <!-- éléments de la navbar  -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link text-white" href="./">Accueil</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="aboutus.php">Qui sommes-nous ?</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="faq.php">F.A.Q</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="contact.php/">Nous contacter</a>
            </li>
          </ul>
        </div>
        <!--fin de la div container  -->
      </div>
      <!-- fin de la navbar -->
  </header>
  </nav>
  <!--==================== Fin du header  ====================================-->
