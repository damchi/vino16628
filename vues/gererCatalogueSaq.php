<!--
    Vue du catalogue des bouteilles de la SAQ (admin)
-->

<script src="./js/gererCatalogueSaq.js"></script>

<div class="encadré">
    <div class="containeurBlanc divAdmin">
        <div class="hautDePage">
            <button id="reinitialiserCatalogue"><i class="fas fa-exclamation"></i>  Réinitialiser le catalogue</button>
        </div>
        
        <div class="form">
            <div>Recherche dans le catalogue</div>

            <div class="group">
                <label class="icon_form"><i class="fas fa-search"></i></label>
                <input name="rechercheCatalogue">
            </div>
        </div>

        <div id="listeBouteilles">
            <!-- templateBouteille -->
        </div>
    </div>
</div>

<template id="templateBouteille">
    <div class="bouteille" data-id="">
        <span class="nom"></span>

        <div>
            <button class='btnModifier'><a href="index.php?requete=modifierBouteilleSaq&idBouteilleSaq=%id_bouteille_saq%"><i class="fas fa-edit"></i></a></button>
            <button class='btnSupprimer'><i class="fas fa-trash-alt"></i></button> 
        </div>
    </div>
</template>