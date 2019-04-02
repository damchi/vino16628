<?php
/**
 * Created by PhpStorm.
 * User: Damien / Julien
 * Date: 13/03/2019
 * Time: 22:55
 */
?>
<script src="./js/login.js"></script>
<div class="encadré">
    <div class="containeurBlanc">
        <h2 class="btnToggle" id="1">Connectez-vous</h2>
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

        <h2 class="btnToggle" id="2">Pas encore inscrit(e)?</h2>
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
                <div class="erreur" id="errorPrenom"></div>
                <div class="group">
                    <label class="icon_form"><i class="fas fa-user"></i></label>
                    <input type="text" id="nomInscription" name="nom" placeholder="Nom">
                </div>
                <div class="erreur" id="errorNom"></div>
                <div class="group">
                    <label class="icon_form"><i class="far fa-envelope"></i></label>
                    <input type="email" id="emailInscription" name="mail" placeholder="Mail">
                </div>
                <div class="erreur" id="errorMail"></div>
                <div class="group">
                    <label class="icon_form"><i class="fas fa-lock"></i></label>
                    <input type="password" id="passInscription" name="password" placeholder="Mot de passe">
                </div>
                <div id="errorPass"></div>
                <div class="group">
                    <label class="icon_form"><i class="fas fa-signature"></i></label>
                    <input  type="text" id="pseudoInscription" name="pseudo" placeholder="Nom usager">
                </div>
                <div class="erreur" id="errorPseudo"></div>
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
    </div>
</div>
