<?php
/**
 * Created by PhpStorm.
 * User: damien
 * Date: 13/03/2019
 * Time: 22:55
 */

?>

<form method="POST" action="index.php?requete=logedin">
    <p>Nom utilisateur ou email : <input type="text" name="identifiant"></p>
    <p>Mot de passe : <input type="password" name="password"></p>
    <input type="submit" name="btnLogin" value="Se connecter">

    <!--    <div class="" vertical layout>-->
<!--        <div >-->
<!--            <p>Nom utilisateur ou email<input type="text" name="identifiant"></p>-->
<!--            <p>Mot de passe : <input type="password" name="mdp"></p>-->
<!--        </div>-->
<!--        <button name="btnLogin">Se connecter</button>-->
<!--    </div>-->
<!--</div>-->
</form>


<div>
<a href="index.php?requete=inscription">Pas encore inscrit ? </a>
</div>

