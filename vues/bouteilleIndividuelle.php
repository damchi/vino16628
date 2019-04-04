<?php
/**
 * Created by PhpStorm.
 * User: damien
 * Date: 29/03/2019
 * Time: 15:30
 */


$codeSaq = isset($data['bouteille']['code_saq']) ? $data['bouteille']['code_saq'] : '';
$dateAchat = isset($data['bouteille']['date_achat']) ? $data['bouteille']['date_achat'] : '';
$format = isset($data['bouteille']['format']) ? $data['bouteille']['format'] : '';
$gardeJusqua = isset($data['bouteille']['garde_jusqua']) ? $data['bouteille']['garde_jusqua'] : '';
$idBouteille = isset($data['bouteille']['id_bouteille']) ? $data['bouteille']['id_bouteille'] : '';
$idCellier = isset($data['bouteille']['id_cellier']) ? $data['bouteille']['id_cellier'] : $data['idCellier'];
$millesime = isset($data['bouteille']['millesime']) ? $data['bouteille']['millesime'] : '';
$nom = isset($data['bouteille']['nom']) ? $data['bouteille']['nom'] : '';
$notes = isset($data['bouteille']['notes']) ? $data['bouteille']['notes'] : '';
$pays = isset($data['bouteille']['pays']) ? $data['bouteille']['pays'] : '';
$prix = isset($data['bouteille']['prix']) ? $data['bouteille']['prix'] : '';
$quantite = isset($data['bouteille']['quantite']) ? $data['bouteille']['quantite'] : 1;
$type = isset($data['bouteille']['type']) ? $data['bouteille']['type'] : '';
$urlImg = isset($data['bouteille']['url_img']) ? $data['bouteille']['url_img'] : '';
$urlSaq = isset($data['bouteille']['url_saq']) ? $data['bouteille']['url_saq'] : '';
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

?>

<!--<meta property="og:url"           content="https://vocomaxc.mywhc.ca/vino16628/" />-->
<!--<meta property="og:type"          content="website" />-->
<!--<meta property="og:title"         content="--><?//= $nom ?><!--" />-->
<!--<meta property="og:description"   content="Test descripttion" />-->
<!--<meta property="og:image"         content="https://www.your-domain.com/path/image.jpg" />-->

<!-- SHARE FACEBOOK-->
<div id="fb-root"></div>
<script>
    window.fbAsyncInit = function () {
        FB.init({
            appId: '268127564108299',
            xfbml: true,
            version: 'v2.8'
        });
    };
    (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {
            return;
        }
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>

<span id="share_button" class="fb-btn">
              <div class="fb_icon"></div>
              <span class="fb-share">
                    <i class="fa fa-facebook"></i>&nbsp;&nbsp;Share
              </span>
        </span>
<script type="text/javascript">
    document.getElementById('share_button').onclick = function () {

        shareOverrideOGMeta(window.location.href,'title', 'description','image');

        FB.ui({
            method: 'share',
            display: 'popup',
            caption: 'Your Title',
            picture: 'Your picture',
            description: 'Your description',
            href: 'Your link',
        }, function (response) {
        });
    }
    }



</script>



<!--FIN share FACEBOOK-->


<div class="container formBouteille" style="background-color: #ffffff">
    <div class="fb-share-button"
         data-href="https://vocomaxc.mywhc.ca/vino16628/"
         data-layout="button_count">
    </div>
<!--    <div class="fb-share-button"-->
<!--         data-href="https://vocomaxc.mywhc.ca/vino16628/"-->
<!--         data-layout="button_count">-->
<!--    </div>-->

    <!--Formulaire-->

<!--    <form class="form" method="post">-->

<!--        <input type="hidden" name="id_bouteille" value="--><?//= $idBouteille ?><!--">-->
<!--        <input type="hidden" name="id_cellier" value="--><?//= $idCellier ?><!--">-->
<!--        <input type="hidden" name="url_img" value="--><?//= $urlImg ?><!--">-->
<!--        <input type="hidden" name="url_saq" value="--><?//= $urlSaq ?><!--">-->

        <!-- Image de la bouteille -->
        <div class="group ml">
            <img src="<?= $urlImg ?>" class="image" alt="bouteille" style="display: <?= $urlImg ? 'inline' : 'none' ?>">
        </div>

        <!-- Nom -->
        <div class="group">
<!--            <label class="icon_form"><i class="fas fa-ribbon"></i></label>-->
            <p>Nom : </p>
            <p name="nom"> <?= $nom ?></p>
        </div>

        <!-- Code SAQ -->
        <div class="group">
<!--            <label class="icon_form"><i class="fas fa-code"></i></label>-->
            <p> Code SAQ : </p>
            <p  name="code_saq"> <?= $codeSaq ?></p>
        </div>

        <!-- Pays -->
        <div class="group">
<!--            <label class="icon_form"><i class="fas fa-id-card"></i></label>-->
            <p>Pays :</p>
            <p name="pays"><?= $pays ?></p>
        </div>

        <!-- Prix -->
        <div class="group">
<!--            <label class="icon_form"><i class="fas fa-dollar-sign"></i></label>-->
            <p>Prix : </p>
            <p name="prix"> <?= $prix ?></p>
        </div>

        <!-- Format -->
        <div class="group">
<!--            <label class="icon_form"><i class="fas fa-id-card"></i></label>-->
            <p >Format : </p>
            <p name="format"> <?= $format ?></p>
        </div>

        <!-- Type -->
        <div class="group">
<!--            <label class="icon_form"><i class="fas fa-id-card"></i></label>-->

            <p>Couleur : </p>
            <p name="type" ><?= $type ?></p>
<!--            <select class="select_form" name="type" required>-->
<!--                <option selected disabled>Type</option>-->
<!--                --><?php
//                foreach ($data['types'] as $t) {
//                    $value = $t['id_type'];
//                    $texte = $t['type'];
//                    $selected = ($t['id_type'] == $type) ? ' selected' : '';
//                    ?>
<!--                    <option value="--><?//= $value ?><!--"--><?//= $selected ?><!--><?//= $texte ?><!--</option>-->
<!--                    --><?php
//                }
//                ?>
<!--            </select>-->
        </div>

        <!-- Millésime -->
        <div class="group">
<!--            <label class="icon_form" ><i class="fas fa-wine-bottle"></i></label>-->
            <p>Millesime : </p>
            <p name="millesime"> <?= $millesime ?></p>
        </div>

        <!-- Quantité -->
        <div class="group">
<!--            <label class="icon_form"><i class="fas fa-cash-register"></i></label>-->
            <p>Quanitté </p>
            <p name="quantite" ><?= $quantite ?></p>
        </div>

        <!-- Date d'achat -->
        <div class="group">
<!--            <label class="icon_form"><i class="fas fa-calendar-alt"></i></label>-->
            <p>Date achat : </p>
            <p  name="date_achat"> <?= $dateAchat ?></p>
        </div>

        <!-- Garder jusqu'à... -->
        <div class="group">
<!--            <label class="icon_form"><i class="fas fa-calendar-alt"></i></label>-->
            <p>Garde : </p>
            <p name="garde_jusqua" <?= $gardeJusqua ?></p>
        </div>

        <!-- Notes -->
        <div class="group">
<!--            <label class="icon_form"><i class="fa fa-comment"></i></label>-->
            <p> Commentaires : </p>
            <p name="notes"> <?= $notes ?></p>
        </div>

<!--        <!-- Bouton enregistrer -->
<!--        <div class="group">-->
<!--            <input type="submit" value="Enregistrer">-->
<!--        </div>-->
<!--    </form>-->

</div>

