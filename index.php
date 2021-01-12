<?php include('src/template/header.php'); ?>

<!-- carousel -->
<div class="carousel slide" data-ride="carousel" id="carouselExampleIndicators">
  <ol class="carousel-indicators">
    <li class="active" data-slide-to="0" data-target="#carouselExampleIndicators"></li>
    <li data-slide-to="1" data-target="#carouselExampleIndicators"></li>
    <!-- <li data-slide-to="2" data-target="#carouselExampleIndicators"></li> -->
  </ol>
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

  <div class="jumbotron" style="background-color:lime">
         <div class="container">
            <h1 align="center">Login Using Modal </h1>
         </div>
      </div>
      <div class="container" align='center'>
         <?php
if (ISSET($_SESSION['network_days']['nd_users'])) 
{
    
?>
        hello <?php
     $_SESSION['firstname'];
?><br>
         <button type="button" class="btn btn-danger btn-lg" id="logout">Logout</button>    
         <?php
} else {
?>
        <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#myModal" >Login</button>
         <?php
}
?>
        <!-- Modal -->
         <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
               <!-- Modal content-->
               <div class="modal-content">
                  <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal">&times;</button>
                     <h4 class="modal-title">Modal Header</h4>
                  </div>
                  <div class="modal-body">
                     <form id="credentials">
                        <input type="text" placeholder="Insert User Name" class="form-control" id="user" name="unames">
                        <input type="text" placeholder="Insert Password" class="form-control" id="pass" name="passwords">
                        <button type="submit" class="btn btn-success">Login</button>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>


  <?php include('src/template/footer.php');
