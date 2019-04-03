<!-- SHARE FACEBOOK-->
<div id="fb-root"></div>
<!--<script async defer crossorigin="anonymous" src="https://connect.facebook.net/fr_CA/sdk.js#xfbml=1&version=v3.2&appId=268127564108299&autoLogAppEvents=1"></script>-->
<script>
    window.fbAsyncInit = function() {
        FB.init({
            appId      : '268127564108299',
            xfbml      : true,
            version    : 'v3.2'
        });
    };

    (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/fr_CA/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

    window.addEventListener('load',()=>{
        let fbShare = document.getElementById('fb-share-button');

        console.log(fbShare);
        fbShare.addEventListener('click',()=>{
            FB.ui({
                    method: 'feed',
                    //link: "http://localhost:63342/projet_Web/vino16628/index.php?requete=listeBouteilleCellier&idCellier=<?//=$_SESSION['idCellier']?>//",
                    link: "http://localhost:8889/projet_Web/vino16628/index.php",
                    // picture: 'http://localhost:63342/projet_Web/vino16628/images/bouteille_vin.png',
                    // picture: 'http://localhost:63342/projet_Web/vino16628/images/bouteille_vin.png',
                    name: "cellier",
                    description: "The description who will be displayed"
                }, function(response){
                    console.log(response.link);
                }
            );

        });
    })




    // $('#fb-share-button').click(function() {
    //
    // });
</script>


<!--FIN sahre FACEBOOK-->
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
?>

<div class="container formBouteille" style="background-color: #ffffff">

    <!--            <!-- Your share button code -->
                <div class="fb-share-button" data-href="http://localhost:8889/projet_Web/vino16628/index.php?requete=listeBouteilleCellier&idCellier=<?= $_SESSION['idCellier']?>" data-layout="button" data-size="small">
                    <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Partager</a>
                </div>
<!--                </div>-->
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

