<?php
/**
 * Created by PhpStorm.
 * User: damien
 * Date: 13/03/2019
 * Time: 22:55
 */

?>
<div class="formlogin">
    <form class="form" method="POST" action="index.php?requete=logedin">
        <div class="group">
            <label class="icon_form"><i class="fas fa-user"></i></label>
            <input type="text" id="identifiantLogin" name="identifiant" placeholder="Nom utilisateur ou email">
        </div>
        <div class="group">
            <label class="icon_form"><i class="fas fa-lock"></i></label>
            <input type="password" id="passwordLogin" name="password" placeholder="mot de passe">
        </div>
        <div class="group">
            <input type="submit" class="btn" id="btnLogin" name="btnLogin" value="Se connecter">
        </div>
        <!--    <div class="" vertical layout>-->
    <!--        <div >-->
    <!--            <p>Nom utilisateur ou email<input type="text" name="identifiant"></p>-->
    <!--            <p>Mot de passe : <input type="password" name="mdp"></p>-->
    <!--        </div>-->
    <!--        <button name="btnLogin">Se connecter</button>-->
    <!--    </div>-->
    <!--</div>-->
        <div id="errorLogin">
            <?php
            if (isset($dataMessage)){
                echo "<p id='message'>". $dataMessage."</p>";
            }
            ?>

        </div>
    </form>

    <div>
    <a href="index.php?requete=inscription">Pas encore inscrit ? </a>
    </div>

</div>