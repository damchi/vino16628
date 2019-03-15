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

            <form class="border border-secondary border-0">
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
                                <textarea class="form-control" placeholder="Notes" id="notes" name="notes"></textarea>
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