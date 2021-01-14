<?php
require('./src/inc/pdo.php');
require('./src/inc/functions.php');

$errors = [];

session_start();


$title = 'Inscription';
include('src/template/header.php');

?>


     <!-- Bouton execution modal -->
<button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
S'inscrire
</button>

<!-- Modal inscription-->
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h4 class="modal-title" id="myModalLabel">Modal title</h4>
</div>
<div class="modal-body">
Exemple de modal
</div>
</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="popup_name" class="popup_block">
     <a class="close" href="#" title="Fermeture" ><img src="img/close.png"/></a>
    <form method="post" action="trait_inscription.php" enctype="multipart/form-data">
    <table width="485" cellspacing="0" cellpadding="0">
     <tr>
      <td width="150">
       <img src="img/leftinsc.jpg"/>
      </td>
      <td width="335">
      <table>
       <tr><td height="75" align="center" style="color:blue;font-size:40px;font-weight:bold">Inscription</td></tr>
       <tr><td>Pseudo:&nbsp;&nbsp;<input type="text" name="pseudo" /></td></tr>
       <tr><td>Mot de passe:&nbsp;&nbsp;<input type="password" name="mdp"/></td></tr>
       <tr><td>confirmation Mdp:&nbsp;&nbsp;<input type="password" name="mdp2"/></td></tr>
       <tr><td>Adresse mail:&nbsp;&nbsp;<input type="text" name="mail" /></td></tr>
       <tr><td align="center"><input type="submit" name="" value="envoyer"/></td></tr>
      </table>
      </td>
     </tr>
    </table>
   </form>   
</div>



<?php include('src/template/footer.php');




