<?php
/**
 * Created by PhpStorm.
 * User: damien
 * Date: 13/03/2019
 * Time: 22:55
 */

?>
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

<div class="form">
    <button class="group">
        <a href="index.php?requete=inscription">Pas encore inscrit ? </a>
    </button>
</div>