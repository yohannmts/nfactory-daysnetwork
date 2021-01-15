<?php
require('src/inc/pdo.php');
require('src/inc/functions.php');

$title = 'Faq';

include('src/template/header.php');

?>


<div class="container-fluid">

    <div id="faqgradient">
        <div id="faq" class="ml-2 text-center">
            <h1 class="mt-2 mb-2">Ici vous trouverez les réponses aux questions les plus fréquemment posées</h1>
            <h2>Qu'est-ce que l'architecture réseau ?</h2>
            <p class="mb-2">Si l'on s'appuie sur une définition concrète, c'est un édifice fonctionnel composé d'équipements de transmission, de logiciels et protocoles de communication et d'une d'infrastructure filaire ou radioélectrique permettant la transmission des données entre les différents composants.</p>
            <h2>Qu'est-ce sont les différents composants de votre ordinateur ?</h2>
            <p class="mb-2">Il y a le processeur, La mémoire vive (RAM), La carte graphique, Le disque dur, La carte mère, Le lecteur/graveur, et l'alimentation.</p>
            <h2>A quoi servent-ils ?</h2>
            <h3 class="class33 mt-2"> Le processeur</h3>
            <p class="mb-2"> Le processeur est la tête pensante de votre ordinateur. Plus il est puissant, plus les informations sont traitées rapidement.</p>
            <h3 class="class33 mt-2">La mémoire vive (RAM) </h3>
            <p class="mb-2">La mémoire vive (RAM) Il s'agit d'un espace de stockage réservé à votre ordinateur Plus la mémoire RAM est importante, plus votre PC est réactif. Elle se mesure en gigaoctets (Go).</p>
            <h3 class="class33 mt-2"> La carte graphique </h3>
            <p class="mb-2">La carte graphique Elle est responsable de l'affichage de tous les éléments graphiques : jeux, mais aussi photos, vidéos et logiciels.</p>
            <h3 class="class33 mt-2"> Le disque dur</h3>
            <p class="mb-2"> Le disque dur est l'espace de stockage réservé à l'utilisateur : il accueille vos documents, programmes, données… Sa contenance est exprimée en gigaoctets (Go), ou téraoctets (To, 1To = 1000 Go). De 300 Go à 2 To, il en existe de toutes les taillesLe disque dur est l'espace de stockage réservé à l'utilisateur : il accueille vos documents, programmes, données… Sa contenance est exprimée en gigaoctets (Go), ou téraoctets (To, 1To = 1000 Go). De 300 Go à 2 To, il en existe de toutes les tailles</p>
            <h3 class="class33 mt-2"> La carte mère</h3>
            <p class="mb-2"> La carte mère est le socle sur lequel tous les éléments viennent s'emboîter. Elle accueille tous les composants de votre ordinateur, et conditionne ses possibilités d'évolution</p>
            <h3 class="class33 mt-2"> Le lecteur/graveur</h3>
            <p class="mb-2"> il est de fait quasiment indispensable! Vissé au boîtier et connecté à la carte mère, il peut lire différents formats. Ses performances sont définies par ses vitesses de lecture et d'écriture, ainsi que par les formats qu'il supporte (CD, DVD, Blu-ray…).</p>
            <h3 class="class33 mt-2"> L'alimentation </h3>
            <p>L'alimentation Elle va souvent de pair avec le boîtier du PC. Responsable de l'arrivée du courant électrique, elle se mesure en watts. Elle se présente sous la forme d'un boîtier, et intègre des ventilateurs.</p>
        </div>
    </div>
</div>

</div>
<?php
include('src/template/footer.php');
