<?php
/**
 * Created by PhpStorm.
 * User: damien
 * Date: 13/03/2019
 * Time: 10:28
 */
?>
<div  class ="formLogin">
    <div class="ajouter">
    <!---->
    <!--    <div class="" vertical layout>-->
    <!--            <div >-->
    <!--                <p>Nom : <input type="text" name="nom"></p>-->
    <!--                <p>Prénom : <input type="text" name="prenom"></p>-->
    <!--                <p>Mail : <input type="email" name="mail" ></p>-->
    <!--                <p>Mot de passe : <input type="password" name="mdp"></p>-->
    <!--                <p>Nom usager : <input  type="text" name="pseudo"></p>-->
    <!--            </div>-->
    <!--            <button name="ajouterUsager">S'inscrire</button>-->
    <!--        </div>-->
    <!--    </div>-->

        <form class="form" method="post" action="index.php?requete=ajoutUsager">
            <div>
                
                <label class="icon_form"><i class="fas fa-user"></i></label><input type="text" id="prenomInscription" name="prenom" placeholder="Prenom"></p>
                <div id="errorPrenom"></div>
                <label class="icon_form"><i class="fas fa-user"></i></label><input type="text" id="nomInscription" name="nom" placeholder="Nom"></p>
                <div id="errorNom"></div>
                <label class="icon_form"><i class="far fa-envelope"></i></label><input type="email" id="emailInscription" name="mail" placeholder="Mail"></p>
                <div id="errorMail"></div>
                <label class="icon_form"><i class="fas fa-lock"></i></label><input type="password" id="passInscription" name="password" placeholder="Mot de passe"></p>
                <div id="errorPass"></div>
                <label class="icon_form"><i class="fas fa-signature"></i></i></label><input  type="text" id="pseudoInscription" name="pseudo" placeholder="Nom usager"></p>
                <div id="errorPseudo"></div>
            </div>
            <input type="submit" id="ajouterUsager" name="ajouterUsager" value="S'inscrire">
        </form>
    </div>
</div>