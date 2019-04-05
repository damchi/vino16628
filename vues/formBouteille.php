<!--
        @abbr: Nouvelle interface du formulaire Ajout de bouteille
        Modifier par Max Germain
        date: 13-03-2019
-->
<?php
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
<div class="encadré">
    <div class="containeurBlanc">
<div class="formBouteille">
    <h2> Formulaire d'ajout de bouteille</h2>

    <!-- Recherche-->
    <div class="form">
        <div id="recherche_bouteille" class="group">
            <label class="icon_form"><i class="fas fa-search"></i></label>
            <input type="text" name="recherche" placeholder="Recherche SAQ" autocomplete="off">
        </div>
    </div>
    
    <ul class="listeAutoComplete"></ul>

    <!--Formulaire-->

    <form class="form" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id_bouteille" value="<?= $idBouteille ?>">
        <input type="hidden" name="id_cellier" value="<?= $idCellier ?>">
        <input type="hidden" name="url_img" value="<?= $urlImg ?>">
        <input type="hidden" name="url_saq" value="<?= $urlSaq ?>">

        <!-- Image de la bouteille -->
        <img id="usagerImage" src="<?= $urlImg ?>" class="image" alt="bouteille" style="display: <?= $urlImg ? 'inline' : 'none' ?>">

        <div>
            <!-- Image usager-->
            <label for="imageBouteille" class="icon_form labelImg">Choisir image</label>
            <input type="file" class="input" name="image" id="imageBouteille" accept="image/*">
            <div name="nomImage"></div>
        </div>

        <!-- Nom -->
        <div class="group">
            <label class="icon_form"><i class="fas fa-ribbon"></i></label>
            <input type="text" class="input" name="nom" placeholder="Nom" required value="<?= $nom ?>">
        </div>

        <!-- Code SAQ -->
        <div class="group">
            <label class="icon_form"><i class="fas fa-code"></i></label>
            <input type="text" class="input" name="code_saq" placeholder="Code SAQ" value="<?= $codeSaq ?>">
        </div>

        <!-- Pays -->
        <div class="group">
            <label class="icon_form"><i class="fas fa-id-card"></i></label>
            <input type="text" name="pays" placeholder="Pays" value="<?= $pays ?>">
        </div>

        <!-- Prix -->
        <div class="group">
            <label class="icon_form"><i class="fas fa-dollar-sign"></i></label>
            <input type="number" step="0.01" class="input" name="prix" placeholder="Prix" value="<?= $prix ?>">
        </div>

        <!-- Format -->
        <div class="group">
            <label class="icon_form"><i class="fas fa-id-card"></i></label>
            <input type="text" class="input" name="format" placeholder="Format" value="<?= $format ?>">
        </div>

        <!-- Type -->
        <div class="group">
            <label class="icon_form"><i class="fas fa-id-card"></i></label>
            <select class="select_form" name="type" required>
                <option value="" selected disabled>Type</option>
                <?php
                foreach ($data['types'] as $t) {
                    $value = $t['id_type'];
                    $texte = $t['type'];
                    $selected = ($t['id_type'] == $type) ? ' selected' : '';
                    ?>
                    <option value="<?= $value ?>"<?= $selected ?>><?= $texte ?></option>
                    <?php
                }
                ?>
            </select>
        </div>

        <!-- Millésime -->
        <div class="group">
            <label class="icon_form" ><i class="fas fa-wine-bottle"></i></label>
            <input type="number" class="input" name="millesime" placeholder="Millésime" value="<?= $millesime ?>" required>
        </div>

        <!-- Quantité -->
        <div class="group">
            <label class="icon_form"><i class="fas fa-cash-register"></i></label>
            <input type="number" class="input" name="quantite" placeholder="Quantité+" required value="<?= $quantite ?>">
        </div>

        <!-- Date d'achat -->
        <div class="group">
            <label class="icon_form"><i class="fas fa-calendar-alt"></i></label>
            <input type="date" class="input" name="date_achat" value="<?= $dateAchat ?>" required>
<!--            <input type="text" class="input" id="date_achat" name="date_achat" placeholder="Date d'achat (aaaa-mm-jj)" value="--><?//= $dateAchat ?><!--" pattern="\d\d\d\d-\d\d-\d\d">-->
        </div>

        <!-- Garder jusqu'à... -->
        <div class="group">
            <label class="icon_form"><i class="fas fa-calendar-alt"></i></label>
            <input type="text" class="input" name="garde_jusqua" placeholder="Garder jusqu'à ..." value="<?= $gardeJusqua ?>">
        </div>

        <!-- Notes -->
        <div class="group">
            <label class="icon_form"><i class="fa fa-comment"></i></label>
            <textarea name="notes" placeholder="Notes"><?= $notes ?></textarea>
        </div>

        <!-- Bouton enregistrer -->
        <div class="group">
            <input type="submit" value="Enregistrer" name="submitForm">
        </div>
    </form>

</div>
</div>
</div>

