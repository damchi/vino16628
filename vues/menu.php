<?php
/**
 * Created by PhpStorm.
 * User: Max Germain / Julien Granero
 * Date: 2019-03-16
 * Time: 03:39
 */
?>
<header>
    <div id="colLogo">
        <a href="">
            <img src="images/logo.png" id="logo" alt="Logo Vino" title="Logo Vino">
        </a>
    </div>
    
    <nav class="topnav colNav" id="topnav">
        <?php
        if (!isset($_SESSION['user_pseudo'])) {
            /* Aucune session ouverte */
        }
        else if (isset($_SESSION['admin'])) {
            /* Menu administrateur */
            ?>
            <a href="?requete=adminAccueil"><i class="fas fa-tachometer-alt"></i><span class="titreNav">TABLEAU DE BORD</span></a>
            <a href="?requete=gererUsagers"><i class="fas fa-users"></i><span class="titreNav">USAGERS</span></a>
            <a href="?requete=gererCatalogueSaq"><i class="fas fa-wine-bottle"></i><span class="titreNav">CATALOGUE SAQ</span></a>
            <a href="?requete=logout"><i class="fas fa-sign-out-alt"></i><span class="titreNav">DÉCONNEXION</span></a>
            <?php
        }
        else {
            /* Menu usager régulier */
            ?>
            <a href="?requete=accueil"><span class="titreNav">MES CELLIERS</span></a>
            <a href="?requete=logout"><i class="fas fa-sign-out-alt"></i><span class="titreNav">DÉCONNEXION</span></a>
            <?php
        }
        ?>
        
        <a href="javascript:void(0);" class="burger"><i class="fas fa-bars"></i></a>
    </nav>
</header>
