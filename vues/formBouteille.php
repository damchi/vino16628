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

<div class="container formBouteille">

    <!-- Recherche-->
    <div id="recherche_bouteille ml">
        <label class="icon_form ml"><i class="fas fa-search"></i></label>&nbsp; <input type="text" name="recherche" placeholder="Recherche">
        <ul class="listeAutoComplete"></ul>
    </div>

    <!--Formulaire-->

    <form class="form" method="post">
        <input type="hidden" name="id_bouteille" value="<?= $idBouteille ?>">
        <input type="hidden" name="id_cellier" value="<?= $idCellier ?>">
        <input type="hidden" name="url_img" value="<?= $urlImg ?>">
        <input type="hidden" name="url_saq" value="<?= $urlSaq ?>">

        <div class="group ml">
            <h3 class="vin_text"><i class="fas fa-wine-bottle"></i>&nbsp; Ajouter Bouteille</h3>
        </div>

        <!-- Image de la bouteille -->
        <div class="group ml">
            <img src="<?= $urlImg ?>" class="image" alt="bouteille">
        </div>

        <!-- Nom -->
        <div class="group">
            <label class="icon_form"><i class="fas fa-ribbon"></i></label>
            <input type="text" class="input" id="" name="nom" placeholder="Nom" required value="<?= $nom ?>">
        </div>

        <!-- Code SAQ -->
        <div class="group">
                <label class="icon_form"><i class="fas fa-code"></i></label>
                <input type="text" class="input" id="" name="code_saq" placeholder="Code SAQ" value="<?= $codeSaq ?>">
        </div>

        <!-- Pays -->
        <div class="group">
            <div >
                <label class="icon_form"><i class="fas fa-id-card"></i></label>
                <input type="text"  id="pays" name="pays" placeholder="Pays" value="<?= $pays ?>">
            </div>
        </div>

        <!-- Prix -->
        <div class="group">
            <div>
                <label class="icon_form"><i class="fas fa-dollar-sign"></i></label>
                <input type="number" step="0.01" class="input" id="prix" name="prix" placeholder="Prix" value="<?= $prix ?>">
            </div>
        </div>

        <!-- Format -->
        <div class="group">
            <label class="icon_form"><i class="fas fa-id-card"></i></label>
            <input type="text" class="input" id="format" name="format" placeholder="Format" value="<?= $format ?>">
        </div>

        <!-- Type -->
        <div class="group">

            <label class="icon_form"><i class="fas fa-id-card"></i></label>
                <select class="select_form" name="type">
                    <option selected disabled>Type</option>
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
            <input type="number" class="input" id="millsime" name="millesime" placeholder="Millésime" value="<?= $millesime ?>">
        </div>

        <!-- Quantité -->
        <div class="group">
            <label class="icon_form"><i class="fas fa-cash-register"></i></label>
            <input type="number" class="input" id="quantite" name="quantite" placeholder="Quantité+" required value="<?= $quantite ?>">
        </div>

        <!-- Date d'achat -->
        <div class="group">
            <label class="icon_form"><i class="fas fa-calendar-alt"></i></label>
            <input type="date" class="input" id="date_achat" name="date_achat" placeholder="Date d'achat" value="<?= $dateAchat ?>">
        </div>

        <!-- Garder jusqu'à... -->
        <div class="group">
            <label class="icon_form"><i class="fas fa-calendar-alt"></i></label>
            <input type="text" class="input" id="garde_jusqua" name="garde_jusqua" placeholder="Garder jusqu'à ..." value="<?= $gardeJusqua ?>">
        </div>

        <!-- Notes -->
        <div class="group">
            <label class="icon_form"><i class="fa fa-comment"></i></label>
            <input type="text" class="input" placeholder="Notes" id="notes" name="notes"><?= $notes ?>
        </div>

        <!-- Bouton enregistrer -->
        <div class="group">
            <button type="submit">Enregistrer</button>
        </div>
    </form>

</div>

