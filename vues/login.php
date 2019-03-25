<?php
/**
 * Created by PhpStorm.
 * User: damien
 * Date: 13/03/2019
 * Time: 22:55
 */

?>
<h2 class="mouvante" id="1">Connectez-vous</h2>
<div class="sectionMobileVisible">
    <form class="form" id="login" method="POST" action="index.php?requete=logedin">
        <div class="group">
            <label class="icon_form"><i class="fas fa-user"></i></label>
            <input type="text" id="identifiantLogin" name="identifiant" placeholder="Nom utilisateur ou email">
        </div>
        <div class="group">
            <label class="icon_form"><i class="fas fa-lock"></i></label>
            <input type="password" id="passwordLogin" name="password" placeholder="mot de passe">
        </div>
        <div class="group">
            <input type="submit" id="btnLogin" name="btnLogin" value="Se connecter">
        </div>
    </form>

    <div id="errorLogin">
        <?php
        if (isset($dataMessage)){
            echo "<div id='message'>". $dataMessage."</div>";
        }
        ?>
    </div>
</div>

<h2 class="mouvante" id="2">Pas encore enregistré(e)?<br>Cliquez ici</h2>
<!--<div class="form">
    <button class="group">
        <a href="index.php?requete=inscription">Pas encore inscrit ? </a>
    </button>
</div>-->
<div class ="sectionMobile">
    <form class="form" method="post" action="index.php?requete=ajoutUsager">
        <div class="group">
            <label class="icon_form"><i class="fas fa-user"></i></label>
            <input type="text" id="prenomInscription" name="prenom" placeholder="Prenom">
        </div>
        <div id="errorPrenom"></div>
        <div class="group">
            <label class="icon_form"><i class="fas fa-user"></i></label>
            <input type="text" id="nomInscription" name="nom" placeholder="Nom">
        </div>
        <div id="errorNom"></div>
        <div class="group">
            <label class="icon_form"><i class="far fa-envelope"></i></label>
            <input type="email" id="emailInscription" name="mail" placeholder="Mail">
        </div>
        <div id="errorMail"></div>
        <div class="group">
            <label class="icon_form"><i class="fas fa-lock"></i></label>
            <input type="password" id="passInscription" name="password" placeholder="Mot de passe">
        </div>
        <div id="errorPass"></div>
        <div class="group">
            <label class="icon_form"><i class="fas fa-signature"></i></label>
            <input  type="text" id="pseudoInscription" name="pseudo" placeholder="Nom usager">
        </div>
        <div id="errorPseudo"></div>
        <div class="group">
            <input type="submit" id="ajouterUsager" name="ajouterUsager" value="S'inscrire">
        </div>
    </form>
    <div id="errorLogin">
        <?php
//        var_dump($dataMessage);
        if (isset($dataMessage)){
            echo "<div id='message'>". $dataMessage."</div>";
        }
        ?>
    </div>
</div>
