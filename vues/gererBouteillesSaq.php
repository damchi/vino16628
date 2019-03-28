<!--
    Vue du catalogue des bouteilles de la SAQ (admin)
-->

<script src="./js/gererBouteillesSaq.js"></script>

<div class="gererBouteillesSaq">
    <h1>Gestion du catalogue de bouteilles</h1>

    <div class="form">
        <div>Recherche dans le catalogue</div>
        
        <div class="group">
            <label class="icon_form"><i class="fas fa-magic"></i></label>
            <input name="rechercheCatalogue">
        </div>
    </div>
    
    <ul id="ulBouteillesSaq"></ul>
</div>

<template id="templateLiBouteilleSaq">
    <li class="bouteilleSaq" data-id="(id_bouteille_saq)">
        <span class="nom"></span>

        <div class="boutons">
            <button class='btnModifier'><a href="index.php?requete=modifierBouteilleSaq&idBouteilleSaq=(id_bouteille_saq)"><i class="fas fa-edit"></i></a></button>
            <button class='btnSupprimer'><i class="fas fa-trash-alt"></i></button>                
        </div>
    </li>
</template>
