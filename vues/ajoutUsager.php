<?php
/**
 * Created by PhpStorm.
 * User: damien
 * Date: 13/03/2019
 * Time: 10:28
 */
?>

<div class ="formLogin">
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
</div>