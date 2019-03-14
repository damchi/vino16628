<!--
        @abbr: Nouvelle interface du formulaire Ajout de bouteille
        Modifier par Max Germain
        date: 13-03-2019
-->
<div class="container ajouter">
    <div class="nouvelleBouteille" vertical layout>
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6 pb-5">

                <div id="recherche_bouteille" class="row d-flex justify-content-start purple darken-3 text-white text-center py-2 m-0" ">
                <label for="nom_bouteille class="d-flex align-self-end"> Recherche</label> &nbsp; <input type="text" name="recherche">
                <ul class="listeAutoComplete">
                </ul>
            </div>

            <!--Form with header-->

            <form action="ajouter.php" method="post" class="border border-secondary border-0">
                <input type="hidden" name="image">
                <input type="hidden" name="description">
                <input type="hidden" name="url_saq">
                <input type="hidden" name="url_img">
                
                <div class="card border-primary rounded-0">
                    <div class="card-header p-0">
                        <div data-id="" class="nom_bouteille purple darken-3 text-white text-center py-2 ">
                            <h3><i class="fas fa-wine-bottle"></i>&nbsp; Ajouter Bouteille<span data-id="" class="nom_bouteille"></span></h3>
                            <p class="m-0"></p>
                        </div>
                    </div>
                    <div class="card-body p-3">

                        <!--Body-->
                        <div class="form-group">
                            <img src="" alt="bouteille">
                        </div>
                        <div class="form-group">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend purple">
                                    <div class="input-group-text"><i class="fas fa-id-card purple text-secondary"></i></i></div>
                                </div>
                                <input type="text" class="form-control" id="" name="nom_bouteille" placeholder="Nom" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend purple">
                                    <div class="input-group-text"><i class="fas fa-id-card purple text-secondary"></i></i></div>
                                </div>
                                <input type="text" class="form-control" id="" name="code_saq" placeholder="Code SAQ">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend purple">
                                    <div class="input-group-text"><i class="fas fa-id-card purple text-secondary"></i></i></div>
                                </div>
                                <input type="text" class="form-control" id="" name="pays" placeholder="Pays">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fas fa-dollar-sign purple text-secondary"></i></i></div>
                                </div>
                                <input type="text" class="form-control" id="" name="prix_saq" placeholder="Prix SAQ">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend purple">
                                    <div class="input-group-text"><i class="fas fa-id-card purple text-secondary"></i></i></div>
                                </div>
                                <input type="text" class="form-control" id="" name="format" placeholder="Format">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend purple">
                                    <div class="input-group-text"><i class="fas fa-id-card purple text-secondary"></i></i></div>
                                </div>
                                <input type="text" class="form-control" id="" name="type" placeholder="Type">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fas fa-wine-bottle text-secondary"></i></div>
                                </div>
                                <input type="number" class="form-control" id="" name="millesime" placeholder="Millésime">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fas fa-cash-register text-secondary"></i></div>
                                </div>
                                <input type="number" class="form-control" id="quantite" name="quantite" placeholder="Quantité">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fas fa-dollar-sign text-secondary"></i></div>
                                </div>
                                <input type="number" class="form-control" id="prix" name="prix" placeholder="Prix">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fas fa-calendar-alt text-secondary"></i></div>
                                </div>
                                <input type="text" class="form-control" id="date_achat" name="date_achat" placeholder="Date d'achat">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fas fa-calendar-alt text-secondary"></i></div>
                                </div>
                                <input type="text" class="form-control" id="garde_jusqua" name="garde_jusqua" placeholder="Garder jusqu'à ...">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-comment text-secondary"></i></div>
                                </div>
                                <textarea class="form-control" placeholder="Notes" id="notes" name="notes" required></textarea>
                            </div>
                        </div>

                        <div class="text-center">
                            <button name="ajouterBouteilleCellier" class="btn purple darken-3 text-white btn-block rounded-0 py-2">Ajouter la bouteille</button>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
</div>

<!--
                    @abbr: Changer l'interface du formulaire Ajout de bouteille
                    Modifier par Max Germain
                    date: 13-03-2019
-->
<!--
<div class="ajouter">

    <div class="nouvelleBouteille" vertical layout>
        Recherche : <input type="text" name="nom_bouteille">
        <ul class="listeAutoComplete">

        </ul>
            <div >
                <p>Nom : <span data-id="" class="nom_bouteille"></span></p>
                <p>Millesime : <input name="millesime"></p>
                <p>Quantite : <input name="quantite" value="1"></p>
                <p>Date achat : <input name="date_achat"></p>
                <p>Prix : <input name="prix"></p>
                <p>Garde : <input name="garde_jusqua"></p>
                <p>Notes <input name="notes"></p>
            </div>
            <button name="ajouterBouteilleCellier">Ajouter la bouteille</button>
        </div>
    </div>
</div>
-->


<!--
<div class="ajouter">
    <p>Recherche : <input name="recherche"></p>
    <ul class="listeAutoComplete"></ul>
    
    <form class="nouvelleBouteille" vertical layout>
        <input type="hidden" name="image">
        <input type="hidden" name="description">
        <input type="hidden" name="url_img">
        
        <p><img src="" alt="bouteille"></p>
        
        <p>Nom : <input name="nom"></p>
        <p>Code SAQ : <input name="code_saq"></p>
        <p>Pays : <input name="pays"></p>
        <p>Prix SAQ : <input name="prix_saq"></p>
        <p>URL SAQ : <input name="url_saq"></p>
        <p>Format : <input name="format"></p>
        <p>Type : <input name="type"></p>
        <p>Millesime : <input name="millesime"></p>
        <p>Quantite : <input name="quantite" value="1"></p>
        <p>Date achat : <input name="date_achat"></p>
        <p>Prix : <input name="prix"></p>
        <p>Garde : <input name="garde_jusqua"></p>
        <p>Notes <input name="notes"></p>
        
        <button type="submit" name="ajouterBouteilleCellier">Ajouter la bouteille</button>
    </form>
</div>
<<<<<<< HEAD

<p>asd</p>
<p>asd</p>
=======
-->
>>>>>>> a0e15dc4f73a7864df645765f741e4ba59f29fec
