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
        <img src="images/logo.png" id="logo" alt="Logo Vino" title="Logo Vino">
    </div>
    
    <nav class="topnav" id="topnav">
        <?php
        if (!isset($_SESSION['user_pseudo'])) {
            /* Aucune session ouverte */
            ?>
            <a href="?requete=login">Accueil<span class="sr-only">(current)</span></a>
            <?php
        }
        else if (isset($_SESSION['admin'])) {
            /* Menu administrateur */
            ?>
            <a href="?requete=adminAccueil"><i class="fas fa-tachometer-alt"></i><span>Tableau de bord</span></a>
            <a href="?requete=gererBouteillesSaq"><i class="fas fa-wine-bottle"></i><span>Gérer les bouteilles</span></a>
            <a href="?requete=logout"><i class="fas fa-sign-out-alt"></i><span>Déconnexion</span></a>
            <?php
        }
        else {
            /* Menu usager régulier */
            ?>
            <a href="?requete=accueil">Mes celliers</a>
            <a href="?requete=logout"><i class="fas fa-sign-out-alt"></i><span>Déconnexion</span></a>
            <?php
        }
        ?>
        
        <a href="javascript:void(0);" class="burger"><i class="fas fa-bars"></i></a>
    </nav>
</header>
