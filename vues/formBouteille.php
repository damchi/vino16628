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
<div class="container ajouter">



    <div id="recherche_bouteille" class="row d-flex justify-content-start purple darken-3 text-white text-center py-2 m-0">
        <label for="recherche" class="d-flex align-self-end"> Recherche</label>&nbsp; <input type="text" name="recherche">
        <ul class="listeAutoComplete"></ul>
    </div>

    <!--Form with header-->

    <form class="border border-secondary border-0" method="post">
        <input type="hidden" name="id_bouteille" value="<?= $idBouteille ?>">
        <input type="hidden" name="id_cellier" value="<?= $idCellier ?>">
        <input type="hidden" name="url_img" value="<?= $urlImg ?>">
        <input type="hidden" name="url_saq" value="<?= $urlSaq ?>">

        <div>
            <div>
                <div data-id="" class="nom_bouteille">
                    <h3><i class="fas fa-wine-bottle"></i>&nbsp; Ajouter Bouteille</h3>
                </div>
            </div>
            <div>
                <!-- Image de la bouteille -->
                <div class="form-group">
                    <img src="<?= $urlImg ?>" alt="bouteille">
                </div>
                <!-- Nom -->
                <div class="form-group">
                    <div>
                            <span><i class="fas fa-id-card purple text-secondary"></i></span>
                        <input type="text" class="form-control" id="" name="nom" placeholder="Nom" required value="<?= $nom ?>">
                    </div>
                </div>

                <!-- Code SAQ -->
                <div class="form-group">
                    <div class="input-group mb-2">
                            <div class="input-group-text"><i class="fas fa-id-card purple text-secondary"></i></i></div>
                        <input type="text" class="form-control" id="" name="code_saq" placeholder="Code SAQ" value="<?= $codeSaq ?>">
                    </div>
                </div>
                <!-- Pays -->
                <div class="form-group">
                    <div>
                        <span><i class="fas fa-id-card"></i></span>
                        <input type="text" class="form-control" id="" name="pays" placeholder="Pays" value="<?= $pays ?>">
                    </div>
                </div>


                <!-- Prix -->
                <div class="form-group">
                    <div>
                        <span><i class="fas fa-dollar-sign"></i></span>
                        <input type="number" step="0.01" class="form-control" id="" name="prix" placeholder="Prix" value="<?= $prix ?>">
                    </div>
                </div>

                <!-- Format -->
                <div class="form-group">
                    <div>
                        <span><i class="fas fa-id-card"></i></span>
                        <input type="text" class="form-control" id="" name="format" placeholder="Format" value="<?= $format ?>">
                    </div>
                </div>

                <!-- Type -->
                <div class="form-group">
                    <div>
                        <span><i class="fas fa-id-card"></i></span>
                        <select class="form-control" name="type">
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
                </div>

                <!-- Millésime -->
                <div class="form-group">
                    <div>
                        <span><i class="fas fa-wine-bottle"></i></span>
                        <input type="number" class="form-control" id="" name="millesime" placeholder="Millésime" value="<?= $millesime ?>">
                    </div>
                </div>

                <!-- Quantité -->
                <div class="form-group">
                    <div>
                        <span><i class="fas fa-cash-register"></i></span>
                        <input type="number" class="form-control" id="quantite" name="quantite" placeholder="Quantité" required value="<?= $quantite ?>">
                    </div>
                </div>

                <!-- Date d'achat -->
                <div class="form-group">
                    <div>
                        <span><i class="fas fa-calendar-alt"></i></span>
                        <input type="date" class="form-control" id="date_achat" name="date_achat" placeholder="Date d'achat" value="<?= $dateAchat ?>">
                    </div>
                </div>

                <!-- Garder jusqu'à... -->
                <div class="form-group">
                    <div>
                        <span><i class="fas fa-calendar-alt"></i></span>
                        <input type="text" class="form-control" id="garde_jusqua" name="garde_jusqua" placeholder="Garder jusqu'à ..." value="<?= $gardeJusqua ?>">
                    </div>
                </div>

                <!-- Notes -->
                <div class="form-group">
                    <div>
                        <span><i class="fa fa-comment"></i></span>
                        <textarea class="form-control" placeholder="Notes" id="notes" name="notes"><?= $notes ?></textarea>
                    </div>
                </div>

                <!-- Bouton enregistrer -->
                <div class="text-center">
                    <button type="submit">Enregistrer</button>
                </div>
            </div>
        </div>
    </form>



</div>

