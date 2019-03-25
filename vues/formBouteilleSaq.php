<!--
    Formulaire de modification d'une bouteille du catalogue SAQ
-->
<?php
$codeSaq = isset($data['bouteille']['code_saq']) ? $data['bouteille']['code_saq'] : '';
$format = isset($data['bouteille']['format']) ? $data['bouteille']['format'] : '';
$idBouteilleSaq = isset($data['bouteille']['id_bouteille_saq']) ? $data['bouteille']['id_bouteille_saq'] : '';
$nom = isset($data['bouteille']['nom']) ? $data['bouteille']['nom'] : '';
$pays = isset($data['bouteille']['pays']) ? $data['bouteille']['pays'] : '';
$prix = isset($data['bouteille']['prix']) ? $data['bouteille']['prix'] : '';
$type = isset($data['bouteille']['type']) ? $data['bouteille']['type'] : '';
$urlImg = isset($data['bouteille']['url_img']) ? $data['bouteille']['url_img'] : '';
$urlSaq = isset($data['bouteille']['url_saq']) ? $data['bouteille']['url_saq'] : '';
?>

<div class="container formBouteille">
    <form class="form" method="post">
        <input type="hidden" name="id_bouteille" value="<?= $idBouteilleSaq ?>">
        <input type="hidden" name="url_img" value="<?= $urlImg ?>">
        <input type="hidden" name="url_saq" value="<?= $urlSaq ?>">

        <!-- Image de la bouteille -->
        <div class="group ml">
            <img src="<?= $urlImg ?>" class="image" alt="bouteille" style="display: <?= $urlImg ? 'inline' : 'none' ?>">
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
            <label class="icon_form"><i class="fas fa-id-card"></i></label>
            <input type="text"  id="pays" name="pays" placeholder="Pays" value="<?= $pays ?>">
        </div>

        <!-- Prix -->
        <div class="group">
            <label class="icon_form"><i class="fas fa-dollar-sign"></i></label>
            <input type="number" step="0.01" class="input" id="prix" name="prix" placeholder="Prix" value="<?= $prix ?>">
        </div>

        <!-- Format -->
        <div class="group">
            <label class="icon_form"><i class="fas fa-id-card"></i></label>
            <input type="text" class="input" id="format" name="format" placeholder="Format" value="<?= $format ?>">
        </div>

        <!-- Type -->
        <div class="group">
            <label class="icon_form"><i class="fas fa-id-card"></i></label>
            <select class="select_form" name="type" required>
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

        <!-- Bouton enregistrer -->
        <div class="group">
            <input type="submit" value="Enregistrer">
        </div>
    </form>
</div>

