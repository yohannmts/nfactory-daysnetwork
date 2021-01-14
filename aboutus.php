<?php 
$title = 'A propos';
include('src/template/header.php');?>

    <div class="container-fluid" style="background-color: grey;">
        <div id="shad" class=" container h-100 border border-light rounded" style="background-color: #17202A;">
            <div class="row">
                <div class="col-5 mx-auto mt-3">
                    <h1 class="titrepage">Qu'est-ce que Network DAYS ?</h1>
                </div>

            </div>
            <div class="row">
                <div class="col-12 p-3 mt-3 mb-1" id="presentation">
                    <p>Fondé en 2020 dans l'agglomération de Rouen, Network DAYS s'attèle à vous apporter des solutions informatiques adaptées à vos besoins.</p>
                    <p>Nos collaborateurs placent le client au cœur de leurs préoccupations pour faire de leur projet une réussite. Passionnés de technologies, nous sommes en veille permanente pour apporter les innovations qui sauront transformer votre business pour plus de performance. Nous avons pour ambition de développer des partenariats de proximité afin de développer des relations durables et de qualités. En s’appuyant sur les compétences et les expériences de chacun de nos collaborateurs, notre organisation à taille humaine nous permet d’être à votre écoute au quotidien.</p>
                </div>
            </div>
            <!-- CARROUSSEL IMAGE  -->
            <div id="carouselExampleIndicators" class="carousel slide mb-3" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="asset/img/img-about-3.png" style="height: 500px;"
                            alt="First slide">
                        <div class="txtflex">
                            <p id="futur"class="text-center flex-caption"> Nous sommes une entreprise spécialisée dans le réseau informatique, nous réglons les soucis que vous pouvez être amener à avoir dans le futur</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="asset/img/img-about-4.png" style="height: 500px;"
                            alt="Second slide">
                        <p id="futur" class="text-center flex-caption">Nous tentons de régler les différents problèmes de communication entre votre PC et internet pour que vous puissiez naviguer sur le Web sans problème et que vos recherches soit plus fluides</p>
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="asset/img/img-about-1.png" style="height: 500px;"
                            alt="Third slide">
                        <p id="futur" class="text-center flex-caption">Au niveau de l'installation et du branchement des différents câbles sur votre PC. Si vous avez besoin, nous nous occupons de cela en sachant que les câbles n'ont pas la même signification.</p>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                </a>
            </div>

            <!-- NOS VALEURS -->
            <div class="big-bigvaleurs2">
                <div class="valeurs">
                    <h1>Nos Valeurs</h1><br>
                </div>
                <div class="row mb-5">
                    <div class="col">
                        <div class="flip">
                            <div class="flip-container" ontouchstart="this.classList.toggle('hover');">
                                <div class="flipper">
                                    <div class="front">
                                        <!-- front content -->
                                        <i class="fas fa-users"></i>
                                    </div>
                                    <div class="back">
                                        <!-- back content -->
                                        <div class="back1">
                                            <h3> Nous plaçons le client au centre. </h3><br>
                                            <p>Nous sommes nous-mêmes des professionnels de
                                                l’informatique. Le client est au cœur de tout ce
                                                que nous entreprenons.</p><br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="flip-container" ontouchstart="this.classList.toggle('hover');">
                            <div class="flipper">
                                <div class="front">
                                    <!-- front content -->
                                    <i class="fas fa-hands-helping"></i>
                                </div>
                                <div class="back">
                                    <!-- back content -->
                                    <div class="back1">
                                        <h3>Nous cultivons l'esprit d'équipe</h3><br>
                                        <p>Nous sommes heureux de transmettre nos connaissances entre collègues et
                                            toujours prêts à
                                            accueillir de nouveaux membres dans notre équipe.</p><br>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="flip-container" ontouchstart="this.classList.toggle('hover');">
                            <div class="flipper">
                                <div class="front">
                                    <!-- front content -->
                                    <i class="fas fa-hand-holding-heart"></i>
                                </div>
                                <div class="back">
                                    <!-- back content -->
                                    <div class="back1">
                                        <h3> Nous dépassons les attentes des clients</h3><br>
                                        <p>Nous aspirons à surprendre et impressionner tous ceux qui ont affaire à nous.
                                        </p><br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="flip-container" ontouchstart="this.classList.toggle('hover');">
                            <div class="flipper">
                                <div class="front">
                                    <!-- front content -->
                                    <i class="far fa-grin"></i>
                                </div>
                                <div class="back">
                                    <!-- back content -->
                                    <div class="back1">
                                        <h3> Nous dépassons les attentes des clients</h3><br>
                                        <p>Nous aspirons à surprendre et impressionner tous ceux qui ont affaire à nous.
                                        </p><br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- PRESENTATION DE L'EQUIPE -->
            <div class="row">
                <div class="col border rounded ml-3 mr-3 mb-3">
                    <h2 id="namedev" class="text-center mt-2">Yohann MATSIONA</h2><br>
                    <h3 class="text-center mb-2 ">Chef de projet - développeur web</h3>
                    <img src="asset/img/yohann.jpg" alt="" class="img-fluid border rounded-circle mb-2">

                    <p class="text-center">"Yohann, 25 ans. Tout simplement passionné par le développement web et l'architecture réseau."</p>
                </div>
                <div class="col border rounded mr-3 mb-3">

                    <h2 id="namedev" class="text-center mt-2"> Steven RAKOTOARISOA</h2><br>
                    <h3 class="text-center mb-2">Développeur web</h3>
                    <img src="asset/img/steven.png" alt="" class="img-fluid border rounded-circle mb-2">
                    <p class="text-center"> "Je me prénomme Steven Rakotoarisoa, 18 ans, ayant une forte passion pour l'informatique, plus particulièrement pour le développement web." </p>
                </div>
                <div class="col border rounded mr-3 mb-3">
                    <h2 id="namedev" class="text-center mt-2">Aurore FOURNIER</h2><br>
                    <h3 class="text-center mb-2">Développeuse web</h3>
                    <img src="asset/img/aurore.jpg" alt="" class="img-fluid border rounded-circle mb-2">
                    <p class="text-center">"Moi c'est Aurore ! J'ai 31 ans, développeuse web et architecte réseau. L'informatique et le développement web sont devenus une vraie passion lors de ma reconversion."
                    </p>
                </div>
                <div class="col border rounded mr-3 mb-3">
                    <h2 id="namedev" class="text-center mt-2">Demba MBOW</h2><br>
                    <h3 class="text-center mb-2">Développeur web</h3>
                    <img src="asset/img/IMG_8840.JPG" class="img-fluid border rounded-circle mb-2" alt="">
                    <p class="text-center">"Je suis Demba MBOW, j'ai 20 ans, et je suis architecte de réseaux et Développeur web et passioné par l'informatique plus précisement dans le domaine du developpement Web."</p>
                </div>
            </div>
        </div>
    </div>


<?php include('src/template/footer.php');