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
    <div class="nouvelleBouteille" vertical layout>
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6 pb-5">
                <div id="recherche_bouteille" class="row d-flex justify-content-start purple darken-3 text-white text-center py-2 m-0">
                    <label for="recherche" class="d-flex align-self-end"> Recherche</label>&nbsp; <input type="text" name="recherche">
                    <ul class="listeAutoComplete"></ul>
                </div>

                <!--Form with header-->

                <form class="border border-secondary border-0" method="post">
                    <input type="hidden" name="id_cellier" value="<?= $data['idCellier'] ?>">
                    <input type="hidden" name="code_saq" value="<?= $codeSaq ?>">
                    <input type="hidden" name="url_img" value="<?= $urlImg ?>">
                    <input type="hidden" name="url_saq" value="<?= $urlSaq ?>">

                    <div class="card border-primary rounded-0">
                        <div class="card-header p-0">
                            <div data-id="" class="nom_bouteille purple darken-3 text-white text-center py-2 ">
                                <h3><i class="fas fa-wine-bottle"></i>&nbsp; Ajouter Bouteille<span data-id="" class="nom_bouteille"></span></h3>
                                <p class="m-0"></p>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <!-- Image de la bouteille -->
                            <div class="form-group">
                                <img src="<?= $urlImg ?>" alt="bouteille">
                            </div>
                            <!-- Nom -->
                            <div class="form-group">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend purple">
                                        <div class="input-group-text"><i class="fas fa-id-card purple text-secondary"></i></div>
                                    </div>
                                    <input type="text" class="form-control" id="" name="nom" placeholder="Nom" required value="<?= $nom ?>">
                                </div>
                            </div>
<!--
                            (Pas besoin de modifier le code SAQ, je crois)
                            <div class="form-group">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend purple">
                                        <div class="input-group-text"><i class="fas fa-id-card purple text-secondary"></i></i></div>
                                    </div>
                                    <input type="text" class="form-control" id="" name="code_saq" placeholder="Code SAQ">
                                </div>
                            </div>
-->
                            <!-- Pays -->
                            <div class="form-group">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend purple">
                                        <div class="input-group-text"><i class="fas fa-id-card purple text-secondary"></i></div>
                                    </div>
                                    <input type="text" class="form-control" id="" name="pays" placeholder="Pays" value="<?= $pays ?>">
                                </div>
                            </div>
                            <!-- Prix -->
                            <div class="form-group">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-dollar-sign purple text-secondary"></i></div>
                                    </div>
                                    <input type="number" step="0.01" class="form-control" id="" name="prix" placeholder="Prix" value="<?= $prix ?>">
                                </div>
                            </div>
                            <!-- Format -->
                            <div class="form-group">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend purple">
                                        <div class="input-group-text"><i class="fas fa-id-card purple text-secondary"></i></div>
                                    </div>
                                    <input type="text" class="form-control" id="" name="format" placeholder="Format" value="<?= $format ?>">
                                </div>
                            </div>
                            <!-- Type -->
                            <div class="form-group">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend purple">
                                        <div class="input-group-text"><i class="fas fa-id-card purple text-secondary"></i></div>
                                    </div>
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
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-wine-bottle text-secondary"></i></div>
                                    </div>
                                    <input type="number" class="form-control" id="" name="millesime" placeholder="Millésime" value="<?= $millesime ?>">
                                </div>
                            </div>
                            <!-- Quantité -->
                            <div class="form-group">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-cash-register text-secondary"></i></div>
                                    </div>
                                    <input type="number" class="form-control" id="quantite" name="quantite" placeholder="Quantité" required value="<?= $quantite ?>">
                                </div>
                            </div>
                            <!-- Date d'achat -->
                            <div class="form-group">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-calendar-alt text-secondary"></i></div>
                                    </div>
                                    <input type="date" class="form-control" id="date_achat" name="date_achat" placeholder="Date d'achat" value="<?= $dateAchat ?>">
                                </div>
                            </div>
                            <!-- Garder jusqu'à... -->
                            <div class="form-group">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-calendar-alt text-secondary"></i></div>
                                    </div>
                                    <input type="text" class="form-control" id="garde_jusqua" name="garde_jusqua" placeholder="Garder jusqu'à ..." value="<?= $gardeJusqua ?>">
                                </div>
                            </div>
                            <!-- Notes -->
                            <div class="form-group">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fa fa-comment text-secondary"></i></div>
                                    </div>
                                    <textarea class="form-control" placeholder="Notes" id="notes" name="notes"><?= $notes ?></textarea>
                                </div>
                            </div>
                            <!-- Bouton enregistrer -->
                            <div class="text-center">
                                <button name="ajouterBouteilleCellier" class="btn purple darken-3 text-white btn-block rounded-0 py-2">Enregistrer</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>