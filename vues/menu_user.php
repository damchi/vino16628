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
        <img src="images/logo.png" id="logo" alt="Logo Vino"
        title="Logo Vino">
        <!--<img src="images/bottle-50573_1280.jpg" alt="enteteImage">-->
    </div>
    <nav class="topnav" id="topnav">
    <?php
    if(!isset($_SESSION['user_pseudo'])){
    ?>
        <a href="?requete=login">Accueil<span class="sr-only">(current)</span></a>
    <?php
    }
    else{
    ?>
        <a href="?requete=accueil">Mes celliers<span class="sr-only">(current)</span></a>
        <a href="?requete=logout"> <i class="fas fa-sign-out-alt"></i> &nbsp; Déconnexion </a>
    <?php
    }
    ?>
        <a href="javascript:void(0);" class="icon">
        <i class="fas fa-bars"></i>
        </a>
    </nav>
</header>
