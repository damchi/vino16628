<?php
/**
 * Created by PhpStorm.
 * User: Max Germain
 * Date: 2019-03-16
 * Time: 03:39
 */
?>

<header class="entete">
    <div class="enteteImage">
        <img src="images/bottle-50573_1280.jpg" alt="enteteImage">
    </div>
    <nav>

        <ul class="topnav">


    <?php
     if( !isset($_SESSION['user_pseudo'])){
    ?>
            <li>
                <a href="?requete=login">Acceuil<span class="sr-only">(current)</span></a>
            </li>
            <?php
            }
            else{
//         var_dump($_SESSION['user_pseudo']);
         ?>
         <li>
             <a href="?requete=accueil">Mon cellier<span class="sr-only">(current)</span></a>
         </li>
<!--                 <li>-->
<!--                     <a href="?requete=ajouterNouvelleBouteilleCellier">Ajouter une bouteille au cellier</a>-->
<!--                 </li>-->
         <li>
             <a href="?requete=logout">Se deconnecter</a>
         </li>
         <?php
     }
    ?>
        </ul>
    </nav>

</header>

