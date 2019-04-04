<!--
    Page de gestion des usagers (admin)
-->

<script src="./js/gererUsagers.js"></script>

<div class="encadré">
    <div class="containeurBlanc">
        <div class="form">
            <div>Recherche</div>

            <div class="group">
                <label class="icon_form"><i class="fas fa-search"></i></label>
                <input name="rechercheUsager">
            </div>
        </div>

        <div id="listeUsagers">
            <!-- templateUsager -->
        </div>
    </div>
</div>

<template id="templateUsager">
    <div class="usager" data-id="">
        <span class="description"></span>
        <button class='btnSupprimer'><i class="fas fa-trash-alt"></i></button> 
    </div>
</template>